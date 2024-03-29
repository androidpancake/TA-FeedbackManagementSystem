@extends('template.dosen.template')

@section('content')
<h1 class="font-bold text-3xl">Profil Saya</h1>

<div class="mt-6 space-y-auto">
    <div class="grid grid-cols-1 border-b border-gray-200 py-5 sm:flex items-start">
        <div class="w-1/2">
            <p class="font-medium text-base text-gray-700">Foto Profil</p>
            <p class="font-medium text-sm text-gray-500">Foto yang akan ditampilkan</p>
        </div>
            
        <div class="flex justify-between w-full mt-4 sm:col-span-2 items-start space-x-5">
            <div>
                @if($dosen->profile_photo)
                <div>
                    <img src="{{ Storage::url($dosen->profile_photo) }}" class="h-12 w-12 rounded-full" alt="">
                </div>
                @else
                <div>
                    <img src="{{ asset('storage/image/Teacher.png') }}" class="h-12 w-12 rounded-full" alt="">
                </div>
                @endif
            </div>
            <div class="inline-flex items-center space-x-3">
                <form action="{{ route('lecturer.profile.update', Auth()->id()) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" name="profile_photo">
                    <button type="submit" class="bg-transparent font-semibold text-green-500">Update</button>
                </form>
                <form action="{{ route('lecturer.profile.delete', Auth()->id()) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="bg-transparent">Delete</button>
                </form>
            </div>
            
        </div>
    </div>
    <div class="grid grid-cols-1 border-b border-gray-200 py-5 sm:flex items-start">
        <div class="w-1/2">
            <p class="font-medium text-base text-gray-700">Nama</p>
        </div>
            
        <div class="w-full mt-4 sm:col-span-2 items-start space-x-5">
            <div>
                <input type="text" class="block w-full p-2 border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-green-500 focus:border-green-500" placeholder="{{ $dosen->name }}">
            </div>
        </div>
    </div>
    <!-- <div class="grid grid-cols-1 border-b border-gray-200 py-5 sm:flex items-start">
        <div class="w-1/2">
            <p class="font-medium text-base text-gray-700">Tipe User</p>
        </div>
            
        <div class="w-full mt-4 sm:col-span-2 items-start space-x-5">
            <div>
                <input type="text" class="block w-full p-2 border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-green-500 focus:border-green-500" placeholder="{{ $dosen->role }}">
            </div>
        </div>
    </div> -->
    <div class="grid grid-cols-1 border-b border-gray-200 py-5 sm:flex items-start">
        <div class="w-1/2">
            <p class="font-medium text-base text-gray-700">NIP</p>
        </div>
            
        <div class="w-full mt-4 sm:col-span-2 space-x-5">
            <div>
                <input type="text" class="block w-full p-2 border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-green-500 focus:border-green-500" placeholder="{{ Auth::user()->nim }}">
            </div>
        </div>
    </div>
</div>
<div class="mt-4 space-y-1">
    <h1 class="font-bold text-xl">Mata kuliah yang diajar</h1>
    <div class="grid grid-cols-4 space-x-2">
        @foreach($class as $data)
        <div class="bg-white border rounded-lg p-4 space-y-2">
            <h1 class="font-bold">{{$data->name}}</h1>
            <!-- <h1 class="font-bold">{{ $data->id }}</h1> -->
            <p class="text-base text-gray-500">{{$data->course->name}}</p>
            <p class="text-base text-gray-500">{{$data->course->code}}</p>

            <p class="text-base text-gray-800">{{ $data->lecturer->name }}</p>
        </div>
        @endforeach
    </div>
</div>
@endsection