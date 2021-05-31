<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            User &raquo; {{$item->name}} &raquo; Create
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
                <form action="{{route('users.update', $item->id)}}" class="w-full" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Name</label>
                            <input value="{{ old('name') ?? $item->name }}" name="name" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="User Name">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Email</label>
                            <input value="{{ old('email') ?? $item->email }}" name="email" type="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="User Email">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Image</label>
                            <input name="profile_photo_path" type="file" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="User Image">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Password</label>
                            <input value="{{old('password')}}" name="password" type="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="User Password">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Password Confirmation</label>
                            <input value="{{old('password_confirmation')}}" name="password_confirmation" type="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="User Password Confirmation">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Address</label>
                            <input value="{{ old('address') ?? $item->address }}" name="address" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="User Address">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Roles</label>
                            <select name="roles" id="grid-last-name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option value="{{ $item->roles }}">{{$item->roles}}</option>
                                <option value="USER">User</option>
                                <option value="ADMIN">Admin</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">House Number</label>
                            <input value="{{ old('houseNumber') ?? $item->houseNumber }}" name="houseNumber" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="House Number">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Phone Number</label>
                            <input value="{{ old('phoneNumber') ?? $item->phoneNumber }}" name="phoneNumber" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="Phone Number">
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label for="grid-last-name" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">City</label>
                            <input value="{{ old('city') ?? $item->city }}" name="city" type="text" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" placeholder="User City">
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3 text-right">
                            <button type="submit" class="bg-green-500 hover:bg-gree-700 text-white font-bold py-2 px-4 rounded">Update User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
