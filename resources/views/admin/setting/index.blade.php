@extends('template.admin.template')

@section('content')
<h1 class="font-bold text-3xl">Pengaturan</h1>
    <div class="space-y-2">
        <div class="mt-6 space-y-auto">
            <a href="{{ route('admin.setting.category') }}" class="bg-white p-4 border rounded-lg flex space-x-2 items-center">
                <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 256 256"><path d="M243.31,136,144,36.69A15.86,15.86,0,0,0,132.69,32H40a8,8,0,0,0-8,8v92.69A15.86,15.86,0,0,0,36.69,144L136,243.31a16,16,0,0,0,22.63,0l84.68-84.68a16,16,0,0,0,0-22.63Zm-96,96L48,132.69V48h84.69L232,147.31ZM96,84A12,12,0,1,1,84,72,12,12,0,0,1,96,84Z"></path></svg>
                </div>
                <div>
                    <h1 class="text-lg font-semibold">Feedback</h1>
                    <p class="text-sm text-gray-800">Atur kategori untuk umpan balik dan pengaduan</p>
                </div>

            </a>
        </div>
        <div class="mt-6 space-y-auto">
            <a href="{{ route('admin.setting.survey') }}" class="bg-white p-4 border rounded-lg flex space-x-2 items-center">
                <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 256 256"><path d="M224,128a8,8,0,0,1-8,8H128a8,8,0,0,1,0-16h88A8,8,0,0,1,224,128ZM128,72h88a8,8,0,0,0,0-16H128a8,8,0,0,0,0,16Zm88,112H128a8,8,0,0,0,0,16h88a8,8,0,0,0,0-16ZM82.34,42.34,56,68.69,45.66,58.34A8,8,0,0,0,34.34,69.66l16,16a8,8,0,0,0,11.32,0l32-32A8,8,0,0,0,82.34,42.34Zm0,64L56,132.69,45.66,122.34a8,8,0,0,0-11.32,11.32l16,16a8,8,0,0,0,11.32,0l32-32a8,8,0,0,0-11.32-11.32Zm0,64L56,196.69,45.66,186.34a8,8,0,0,0-11.32,11.32l16,16a8,8,0,0,0,11.32,0l32-32a8,8,0,0,0-11.32-11.32Z"></path></svg>                </div>
                <div>
                    <h1 class="text-lg font-semibold">Quick Survey</h1>
                    <p class="text-sm text-gray-800">Atur penilaian tambahan untuk quick survey</p>
                </div>

            </a>
        </div>
    </div>
@endsection