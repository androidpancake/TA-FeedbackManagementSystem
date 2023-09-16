@extends('template.template')

@section('content')
<div class="p-8 w-full">
    <div class="mx-auto w-2/4">
        <div class="flex flex-col mx-auto pt-8 space-y-3 justify-center">
            <div class="flex space-x-4 justify-center items-center w-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 256 256"><path d="M81.61,247.27a12,12,0,0,1-16.8,2.41A131.23,131.23,0,0,1,29.67,210a12,12,0,1,1,20.79-12,107.45,107.45,0,0,0,28.73,32.48A12,12,0,0,1,81.61,247.27ZM223.66,98A92,92,0,0,1,64.31,190l-38-65.82A32,32,0,0,1,45.46,77.33L45,76.46A32,32,0,0,1,81,29.55,31.7,31.7,0,0,1,90.62,34,32,32,0,0,1,143,38.31L155.52,60a32,32,0,0,1,50.14,6.84Zm-20.78,12-18-31.18a8,8,0,0,0-13.87,8h0l10,17.31a12,12,0,0,1-4.39,16.39,28,28,0,0,0-10.25,38.25,12,12,0,0,1-20.79,12A52.09,52.09,0,0,1,154.93,107L122.24,50.31a8,8,0,0,0-13.86,8l26,45a12,12,0,0,1-20.79,12l-34-58.89a8,8,0,0,0-10.92-2.93,8,8,0,0,0-2.93,10.93l38,65.81a12,12,0,1,1-20.79,12l-22-38.1a8,8,0,1,0-13.85,8L85.1,178a68,68,0,0,0,117.78-68ZM240.3,46.81a71.5,71.5,0,0,0-43.72-33.55,12,12,0,0,0-6.21,23.19,47.65,47.65,0,0,1,29.15,22.36,12,12,0,1,0,20.78-12Z"></path></svg>
                <!-- <img src="{{ Storage::url(Auth::user()->profile_photo) }}" class="w-8 h-8 rounded-full" alt=""> -->
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
@push('lang')

@endpush
@endsection