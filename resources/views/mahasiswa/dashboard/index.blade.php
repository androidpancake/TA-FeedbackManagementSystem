@extends('template.template')

@section('content')
<div class="p-8 w-full">
    <div class="mx-auto w-2/4">
        <div class="flex flex-col mx-auto pt-8 space-y-3 justify-center">
            <div class="flex space-x-4 justify-center items-center w-full">
                <img src="{{ asset('storage/image/Wave.png') }}" class="w-8 h-8" alt="">
                <h1 class="font-semibold text-3xl text-gray-700 w-full">Selamat datang, {{ Auth::user()->name }}</h1>
            </div>
        <h1 class="text-md text-gray-500">Aplikasi ini memberi Anda kesempatan untuk memberikan umpan balik secara langsung terkait perkuliahan, praktikum di lab, dosen, dan prodi Anda. Dengan mengungkapkan pemikiran dan perasaan Anda, Anda membantu kami dalam meningkatkan kualitas pendidikan kami.</h1>
        </div>
        <div class="grid grid-cols-2 gap-6 py-6">
            <a href="{{ route('mahasiswa.feedback.create.dosen') }}" class="border-solid border border-gray-200 bg-white shadow-sm p-4 rounded-lg bg-white hover:bg-gray-50 hover:shadow">
                <div class="relative w-12 h-12 bg-gray-100 rounded-md flex items-center justify-center">
                    <img src="{{ asset('storage/image/Feedback.png') }}" class="absolute z-10 w-4 h-4 top-1 right-0" alt="">
                    <img src="{{ asset('storage/image/Teacher.png') }}" class="w-6 h-6" alt="">
                </div>
                <div class="pt-4">
                    <p class="text-md font-semibold text-gray-700">Beri umpan balik ke dosen</p>
                    <p class="text-sm text-gray-500">Bantu tingkatkan kualitas pengajaran dengan memberikan umpan balik Anda kepada dosen</p>
                </div>
            </a>
            <a href="{{ route('mahasiswa.feedback.create.lab') }}" class="border-solid border border-gray-200 bg-white shadow-sm p-4 rounded-lg bg-white hover:bg-gray-50 hover:shadow">
                <div class="relative w-12 h-12 bg-gray-100 rounded-md flex items-center justify-center">
                    <img src="{{ asset('storage/image/Feedback.png') }}" class="absolute z-10 w-4 h-4 top-1 right-0" alt="">
                    <img src="{{ asset('storage/image/Lab.png') }}" class="w-6 h-6" alt="">
                </div>
                <div class="pt-4">
                    <p class="text-md font-semibold text-gray-700">Beri umpan balik ke lab</p>
                    <p class="text-sm text-gray-500">Bagikan pengalaman dan saran Anda untuk membantu kami meningkatkan kualitas praktikum</p>
                </div>
            </a>
            <a href="{{ route('mahasiswa.complaint.create') }}" class="col-span-2 border-solid border border-gray-200 bg-white shadow-sm p-4 rounded-lg bg-white hover:bg-gray-50 hover:shadow">
                <div class="relative w-12 h-12 bg-gray-100 rounded-md flex items-center justify-center">
                    <img src="{{ asset('storage/image/Feedback.png') }}" class="absolute z-10 w-4 h-4 top-1 right-0" alt="">
                    <img src="{{ asset('storage/image/Keluhan.png') }}" class="w-6 h-6" alt="">
                </div>
                <div class="pt-4">
                    <p class="text-md font-semibold text-gray-700">Sampaikan keluhan ke prodi</p>
                    <p class="text-sm text-gray-500">Ada aspek tertentu di program studi Anda yang membuat Anda tidak nyaman atau frustrasi? Kami ada di sini untuk mendengar dan melakukan apa yang diperlukan untuk memperbaiki masalah tersebut.</p>
                </div>
            </a>

        <!-- <div class="flex flex-col justify-center mx-auto">
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
        </div> -->
    </div>

</div>
@endsection