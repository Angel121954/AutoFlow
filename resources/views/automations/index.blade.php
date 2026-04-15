<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4">

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Mis Automatizaciones</h1>

            <a href="{{ route('automations.create') }}"
                class="bg-blue-600 text-white px-5 py-2 rounded-xl">
                + Nueva
            </a>
        </div>

        <div class="grid md:grid-cols-3 gap-6">

            @foreach($automations as $item)

            <div class="bg-white shadow rounded-2xl p-5 border">
                <h2 class="text-xl font-bold mb-2">{{ $item->name }}</h2>

                <p class="text-gray-500 mb-4">
                    {{ $item->description }}
                </p>

                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                    {{ $item->trigger_type }}
                </span>

                <div class="mt-4">
                    @if($item->active)
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                        Activa
                    </span>
                    @endif
                </div>
            </div>

            @endforeach

        </div>

    </div>
</x-app-layout>