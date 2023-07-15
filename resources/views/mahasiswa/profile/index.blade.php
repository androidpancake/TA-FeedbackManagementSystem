@extends('template.template')

@section('content')
<h1 class="font-bold text-3xl">Profil Saya</h1>

<div class="mt-6 space-y-auto">
    <div class="grid grid-cols-1 border-b border-gray-200 py-5 sm:flex items-start">
        <div class="w-1/2">
            <p class="font-medium text-base text-gray-700">Foto Profil</p>
            <p class="font-medium text-sm text-gray-500">Foto yang akan ditampilkan</p>
        </div>
            
        <div class="flex justify-between w-full mt-4 sm:col-span-2 items-start space-x-5">
            @if($user->profile_photo)
            <div>
                <img src="{{ Storage::url($user->profile_photo) }}" class="h-12 w-12 max-w-xs rounded-full" alt="">
            </div>
            @else
            <div>
                <img src="{{ asset('storage/image/Teacher.png') }}" class="rounded-full" alt="">
            </div>
            @endif
            <div class="inline-flex items-center space-x-3">
                <form action="{{ route('mahasiswa.profile.update', Auth()->id()) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" name="profile_photo">
                    <button type="submit" class="bg-transparent font-semibold text-green-500">Update</button>
                </form>
                <form action="{{ route('mahasiswa.profile.delete', Auth()->id()) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-transparent font-semibold text-gray-500">Delete</button>
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
                <input type="text" class="block w-full p-2 border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-green-500 focus:border-green-500" placeholder="{{ $user->name }}">
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

</div>
<div class="mt-4 space-y-1">
    <h1 class="font-bold text-xl">Mata kuliah yang diikuti</h1>
    <div class="grid grid-cols-4 space-x-2">
        @foreach($class as $data)
        <div class="bg-white border rounded-lg p-4 space-y-2">
            <h1 class="font-bold">{{$data->name}}</h1>
            <p class="text-base text-gray-500">{{$data->course->name}}</p>
            @if($data->lecturer)
            <p class="text-base text-gray-800">{{ $data->lecturer->name }}</p>
            @elseif($data->lab)
            <p class="text-base text-gray-800">{{ $data->lab->name }}</p>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection