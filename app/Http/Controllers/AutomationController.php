<?php

namespace App\Http\Controllers;

use App\Models\Automation;
use App\Models\Execution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutomationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $automations = Automation::where('user_id', Auth::id())->latest()->paginate(12);

        return view('automations.index', compact('automations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // La creación se gestiona desde el modal en el index.
        return redirect()->route('automations.index', ['new' => 1]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'         => 'required|string|max:150',
            'description'  => 'nullable|string|max:500',
            'trigger_type' => 'required|string|in:email,whatsapp,registro,pago,webhook,schedule',
        ]);

        Automation::create([
            'name'         => $validated['name'],
            'description'  => $validated['description'] ?? null,
            'trigger_type' => $validated['trigger_type'],
            'active'       => $request->boolean('active', true),
            'user_id'      => Auth::id(),
        ]);

        return redirect()
            ->route('automations.index')
            ->with('success', 'Automatización creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Automation $automation)
    {
        // Asegurarse de que pertenece al usuario autenticado
        abort_if($automation->user_id !== Auth::id(), 403);

        $executions = $automation->executions()->latest()->paginate(10);

        return view('automations.show', compact('automation', 'executions'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Automation $automation)
    {
        abort_if($automation->user_id !== Auth::id(), 403);

        // La edición se gestiona desde el modal en el index.
        return redirect()->route('automations.index', ['edit' => $automation->id]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Automation $automation)
    {
        abort_if($automation->user_id !== Auth::id(), 403);

        $validated = $request->validate([
            'name'         => 'required|string|max:150',
            'description'  => 'nullable|string|max:500',
            'trigger_type' => 'required|string|in:email,whatsapp,registro,pago,webhook,schedule',
        ]);

        $automation->update([
            'name'         => $validated['name'],
            'description'  => $validated['description'] ?? null,
            'trigger_type' => $validated['trigger_type'],
            'active'       => $request->boolean('active'),
        ]);

        return redirect()
            ->route('automations.index')
            ->with('success', 'Automatización actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Automation $automation)
    {
        abort_if($automation->user_id !== Auth::id(), 403);

        $automation->delete();

        return redirect()
            ->route('automations.index')
            ->with('success', 'Automatización eliminada correctamente.');
    }

    /**
     * Toggle the active state of the automation.
     */
    public function toggle(Automation $automation)
    {
        abort_if($automation->user_id !== Auth::id(), 403);

        $automation->update(['active' => ! $automation->active]);

        $estado = $automation->active ? 'activada' : 'pausada';

        return back()->with('success', "Automatización {$estado} correctamente.");
    }
}
