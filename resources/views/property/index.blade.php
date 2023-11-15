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
                    <div class="flex gap-3">
                        <div class="w-80 flex">
                            <label for="assets" class="flex-shrink-0 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agence :</label>
                            <select id="room" name="room" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="">La Foret</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br />
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(auth()->user()->isAdmin())
                        <div class="flex gap-2">
                            <form action="{{ route('property.create') }}" method="GET">
                                @csrf
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add New Property</button>
                            </form>
                            <form action="{{ route('property.asset.create') }}" method="GET">
                                @csrf
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add New Asset</button>
                            </form>
                        </div>
                    @endif
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                        @foreach($properties as $property)
                            <a href="{{ route('property.show', ['id' => $property->id]) }}">
                                <div class="grid grid-cols-1 grid-rows-7 gap-2 border border-gray-300 px-2 py-1 rounded">
                                    <div>
                                        <img src="{{ asset('storage/' . $property->picture) }}" class="w-64 h-32 object-cover rounded">
                                    </div>
                                    <div >
                                        {{ $property->type }}
                                    </div>
                                    <div >
                                        {{ $property->city }}
                                    </div>
                                    <div >
                                        {{ number_format($property->price, 0, ',',' ') }} £
                                    </div>
                                    <div >
                                        {{ $property->surface }} m²
                                    </div>
                                    <div >
                                        {{ $property->room }} rooms
                                    </div>
                                    <div class="flex gap-1">
                                        @foreach ($property->assets as $asset)
                                            <span class="border border-gray-300 px-2 py-1 rounded bg-blue-100">{{ $asset->nom }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
