<x-app-layout>
    <div class="max-w-3xl mx-auto py-10">

        <h1 class="text-3xl font-bold mb-6">Crear Automatización</h1>

        <form action="{{ route('automations.store') }}" method="POST" class="bg-white p-6 rounded-xl shadow space-y-4">
            @csrf

            <div>
                <label class="block font-semibold">Nombre</label>
                <input type="text" name="name" class="w-full border rounded-lg p-2" required>
            </div>

            <div>
                <label class="block font-semibold">Descripción</label>
                <textarea name="description" class="w-full border rounded-lg p-2"></textarea>
            </div>

            <div>
                <label class="block font-semibold">Tipo Trigger</label>
                <select name="trigger_type" class="w-full border rounded-lg p-2">
                    <option value="email">Email</option>
                    <option value="whatsapp">WhatsApp</option>
                    <option value="registro">Registro</option>
                    <option value="pago">Pago</option>
                </select>
            </div>

            <button class="bg-blue-600 text-white px-5 py-2 rounded-lg">
                Guardar
            </button>
        </form>

    </div>
</x-app-layout>