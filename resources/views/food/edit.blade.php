<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Food &raquo; {{$item->name}} &raquo; Edit
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
                <!-- handle error -->
                @if($errors->any())
                <div class="mb-5" role="alert">
                    <div class="bg-red-500 text-white font-bold rounded-t px-4 py-2">
                        There something wrong
                    </div>
                </div>
                <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
                    <p>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </p>
                </div>
                @endif
                <!-- form -->
                <form action="{{route('food.update', $item->id)}}" class="w-full" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name</label>
                            <input value="{{old('name') ?? $item->name}}" name="name" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="Food Name">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Image</label>
                            <input name="picturePath" type="file" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="Food Image">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Description</label>
                            <textarea value="{{old('description') ?? $item->description}}" name="description" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="Food Description"></textarea>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Ingredients</label>
                            <input value="{{old('ingredients') ?? $item->ingredients}}" name="ingredients" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="Food Ingredients">
                            <p class="text-gray-600 text-xs italic">Dipisahkan dengan koma, contoh: Bawang Merah, Paprika, Bawang Bombay, Timun</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Price</label>
                            <input value="{{old('price') ?? $item->price}}" name="price" type="number" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="Food Price">
                            <p class="text-gray-600 text-xs italic">Dipisahkan dengan koma, contoh: Bawang Merah, Paprika, Bawang Bombay, Timun</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Rate</label>
                            <input value="{{old('rate') ?? $item->rate}}" name="rate" type="number" step="0.01" max="5" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="Food Rite">
                            <p class="text-gray-600 text-xs italic">Dipisahkan dengan koma, contoh: Bawang Merah, Paprika, Bawang Bombay, Timun</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Type</label>
                            <input value="{{old('types') ?? $item->types}}" name="types" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="Food Type">
                            <p class="text-gray-600 text-xs italic">Dipisahkan dengan koma, contoh: recomended,popular,new_food</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-gree-700 text-white font-bold py-2 px-4 rounded">Update Food</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
