<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Exception;

class SocialAuthController extends Controller
{
    // Solo Google y GitHub
    protected array $allowedProviders = ['google', 'github'];

    public function redirect(string $provider)
    {
        if (!in_array($provider, $this->allowedProviders)) {
            abort(404);
        }

        // Para GitHub pedimos el scope user:email
        if ($provider === 'github') {
            return Socialite::driver($provider)
                ->scopes(['user:email'])
                ->redirect();
        }

        return Socialite::driver($provider)->redirect();
    }

    protected function resolveAvatar(string $provider, $socialUser): string
    {
        $avatar = $socialUser->getAvatar();

        return match ($provider) {
            'google' => preg_replace('/=s\d+-c/', '=s400-c', $avatar),
            default  => $avatar,
        };
    }

    public function callback(string $provider)
    {
        if (!in_array($provider, $this->allowedProviders)) {
            abort(404);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();

            // Validar email
            if (!$socialUser->getEmail()) {
                return redirect()
                    ->route('login')
                    ->with('error', 'Tu cuenta de ' . ucfirst($provider) . ' no tiene email disponible. Activa tu correo en el perfil o revisa los permisos.');
            }

            $avatar = $this->resolveAvatar($provider, $socialUser);

            $user = User::where('provider_id', $socialUser->getId())
                ->where('provider', $provider)
                ->first();

            if (!$user) {
                $user = User::where('email', $socialUser->getEmail())->first();
            }

            if (!$user) {
                $user = DB::transaction(function () use ($socialUser, $provider, $avatar) {
                    $baseUsername = Str::slug(
                        $socialUser->getName() ?? $socialUser->getNickname() ?? 'user'
                    );

                    $baseUsername = $baseUsername ?: 'user';
                    $username     = $baseUsername;
                    $count        = 1;

                    while (User::where('username', $username)->exists()) {
                        $username = $baseUsername . $count++;
                    }

                    return User::create([
                        'name'              => $socialUser->getName() ?? $socialUser->getNickname(),
                        'username'          => $username,
                        'email'             => $socialUser->getEmail(),
                        'email_verified_at' => now(),
                        'password'          => bcrypt(Str::random(16)),
                        'provider'          => $provider,
                        'provider_id'       => $socialUser->getId(),
                        'avatar'            => $avatar,
                        'status'            => 'activo',
                        'role'              => 'user',
                    ]);
                });
            } else {
                $user->update([
                    'provider'    => $provider,
                    'provider_id' => $socialUser->getId(),
                    'avatar'      => $avatar,
                ]);
            }

            // Reactivar usuarios si estaban bloqueados
            if ($user->status === 'pending_deletion') {
                $user->update([
                    'status' => 'activo',
                    'delete_at' => null,
                ]);
            }

            if ($user->status === 'inactivo') {
                $user->update(['status' => 'activo']);
            }

            Auth::login($user, true);
            request()->session()->regenerate();

            return redirect()->route('explore.index');
        } catch (Exception $e) {
            report($e);

            return redirect()
                ->route('login')
                ->with('error', 'Error al autenticar con ' . ucfirst($provider) . ': ' . $e->getMessage());
        }
    }
}
