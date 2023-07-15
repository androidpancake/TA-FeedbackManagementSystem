@extends('template.template')

@section('content')
<h1 class="font-bold text-3xl">Hai, {{ Auth::user()->name }}</h1>
<h1 class="text-lg font-base font-sans sm:text-xl">Selamat Datang di Website Feedback, Pengaduan, dan Survey</h1>

<div class="flex flex-col justify-center mx-auto">

    <div class="flex justify-center">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 h-64 mt-6">
            <a href="{{ route('mahasiswa.feedback.create.dosen') }}" class="p-4 border-2 rounded-lg bg-white hover:bg-green-300">
                <h1 class="font-semibold">Feedback Dosen</h1>
                <p class="text-sm text-gray-500">sampaikan feedback ke Dosen</p>
            </a>
            <a href="{{ route('mahasiswa.feedback.create.dosen') }}" class="text-gray-900 cursor-pointer bg-blue-50 border-2 hover:shadow-2xl font-medium rounded-lg text-sm p-4">
                <h1 class="font-semibold">Feedback lab</h1>
                <p class="text-sm text-gray-500">sampaikan feedback ke Lab</p>
            </a>
            <a href="{{ route('mahasiswa.complaint.create') }}" class="text-gray-900 cursor-pointer bg-green-50 border-2 hover:shadow-2xl font-medium rounded-lg text-sm p-4">
                <h1 class="font-semibold">Pengaduan</h1>
                <p class="text-sm text-gray-500">sampaikan pengaduan ke Prodi</p>
            </a>
            <a href="{{ route('mahasiswa.notification') }}" class="text-gray-900 cursor-pointer bg-yellow-50 border-2 hover:shadow-2xl font-medium rounded-lg text-sm p-4">
                <h1 class="font-semibold">Lihat aktivitas</h1>
                <p class="text-sm text-gray-500">Berikan respon survey dan melihat balasan</p>
            </a>
        </div>
    </div>
</div>
@endsection