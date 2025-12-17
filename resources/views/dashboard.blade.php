<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3>Bienvenido, {{ Auth::user()->name }}!</h3>
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="p-4 bg-gray-100 rounded">
                        <span class="font-bold text-2xl">{{ $totalEstudios }}</span>
                        <p class="text-gray-700">Estudios</p>
                    </div>
                    <div class="p-4 bg-gray-100 rounded">
                        <span class="font-bold text-2xl">{{ $totalFamilias }}</span>
                        <p class="text-gray-700">Familias</p>
                    </div>
                    <div class="p-4 bg-gray-100 rounded">
                        <span class="font-bold text-2xl">{{ $totalUnidades }}</span>
                        <p class="text-gray-700">Unidades</p>
                    </div>
                    <div class="p-4 bg-gray-100 rounded">
                        <span class="font-bold text-2xl">{{ $totalSolicitudes }}</span>
                        <p class="text-gray-700">Solicitudes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
