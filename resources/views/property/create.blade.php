<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Property') }}
        </h2>
    </x-slot>
    <form action="{{ route('property.store') }}" method="POST">
        @csrf
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type of property</label>
                    <div class="flex items-center mb-4">
                        <input id="house" type="radio" value="house" name="type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="house" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">House</label>
                    </div>
                    <div class="flex items-center">
                        <input id="appartement" type="radio" value="appartement" name="type" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="appartement" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Appartement</label>
                    </div>
                </div>
                <div class="mb-6">
                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                    <input type="number" id="price" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                </div>
                <div class="mb-6">
                    <label for="surface" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Surface</label>
                    <input type="number" id="surface" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" required>
                </div>
                <div class="mb-6">
                    <label for="assets" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Assets of the property</label>
                    <select id="assets" name="assets[]" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" multiple>
                        @foreach($assets as $asset)
                            <option value="{{ $asset->id }}">{{ $asset->nom }}</option>
                        @endforeach
                    </select>
                </div>
                

                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Register new property</button>
                </div>
            </div>
        </div>
    </div>

    </form>
</x-app-layout>