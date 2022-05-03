<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Showcase &raquo; Create
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                @if ($errors->any())
                    <div class="mb-5" role="alert">
                        <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                            There is something wrong !
                        </div>
                        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                            <p>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                @endif
                <form action="{{ route('dashboard.showcase.store') }}" class="w-full" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Photo</label>
                            <input type="file" name="file" accept="image/*" placeholder="Photos" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-6">
                            <label for="categories_id" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Category Showcase</label>
                            <select name="categories_id" id="categories_id" class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="">Choose Category</option>
                                @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-6">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Description</label>
                            <textarea name="description"  class="block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">{!! old('description') !!}</textarea>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 mb-6">
                            <button type="submit" class=" bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow-lg">
                                Save Showcase
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
