<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Property') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-3 grid-rows-7 gap-4">
                        <div>
                            <img src="{{ asset('storage/' . $property->picture) }}" class="w-64 h-32 object-cover rounded">
                        </div>
                        <div class="col-start-1 row-start-2">
                            {{ $property->type }}
                        </div>
                        <div class="col-start-1 row-start-3">
                            {{ $property->city }}
                        </div>
                        <div class="col-start-1 row-start-4">
                            {{ number_format($property->price, 0, ',',' ') }} £
                        </div>
                        <div class="col-start-1 row-start-5">
                            {{ $property->surface }} m²
                        </div>
                        <div class="col-start-1 row-start-6">
                            {{ $property->room }} rooms
                        </div>
                        <div class="col-start-1 row-start-7 flex gap-1">
                            @foreach ($property->assets as $asset)
                                <span class="border border-gray-300 px-2 py-1 rounded bg-blue-100">{{ $asset->nom }}</span>
                            @endforeach
                        </div>
                        <div class="col-start-2 row-start-1">4</div>
                        <div class="col-start-3 row-start-1">5</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
