@extends('template.admin.template')

@section('content')
<h1 class="font-bold text-3xl">Profil Saya</h1>
<form action="" method="POST">
    @csrf
    @method('PUT')
    <div class="mt-6 space-y-auto">
        <div class="grid grid-cols-1 border-b border-gray-200 py-5 sm:flex items-start">
            <div class="w-1/2">
                <p class="font-medium text-base text-gray-700">Foto Profil</p>
                <p class="font-medium text-sm text-gray-500">Foto yang akan ditampilkan</p>
            </div>
                
            <div class="flex justify-between w-full mt-4 sm:col-span-2 items-start space-x-5">
                <div>
                    <img src="{{ asset('storage/image/logo.png') }}" class="w-16 h-16 rounded-full" alt="">
                </div>
                <div class="space-x-3">
                    <button class="bg-transparent font-semibold text-blue-500">Update</button>
                        
                    <button class="bg-transparent">Delete</button>
                </div>
                
            </div>
        </div>
        <div class="grid grid-cols-1 border-b border-gray-200 py-5 sm:flex items-start">
            <div class="w-1/2">
                <p class="font-medium text-base text-gray-700">Nama</p>
            </div>
                
            <div class="w-full mt-4 sm:col-span-2 items-start space-x-5">
                <div>
                    <input type="text" class="block w-full p-2 border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-green-500 focus:border-green-500" placeholder="{{ Auth::user()->name }}">
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 border-b border-gray-200 py-5 sm:flex items-start">
            <div class="w-1/2">
                <p class="font-medium text-base text-gray-700">Tipe User</p>
            </div>
                
            <div class="w-full mt-4 sm:col-span-2 items-start space-x-5">
                <div>
                    <input type="text" class="block w-full p-2 border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-green-500 focus:border-green-500" placeholder="...">
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 border-b border-gray-200 py-5 sm:flex items-start">
            <div class="w-1/2">
                <p class="font-medium text-base text-gray-700">NIM</p>
            </div>
                
            <div class="w-full mt-4 sm:col-span-2 space-x-5">
                <div>
                    <input type="text" class="block w-full p-2 border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-green-500 focus:border-green-500" placeholder="{{ Auth::user()->nim }}">
                </div>
            </div>
        </div>
        <div class="flex justify-end py-5">
            <button class="bg-green-500 py-2.5 px-8 rounded text-white font-medium">Simpan</button>
        </div>
    </div>
</form>

@endsection