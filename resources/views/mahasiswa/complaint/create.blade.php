@extends('template.template')
@section('breadcrumb')

@endsection
@section('content')
<div class="grid justify-center pb-8">
    <div class="flex items-start gap-6 mt-6 justify-center">
        <div class="relative bg-gray-100 rounded-lg p-6">
            <img src="{{ asset('storage/image/Keluhan.png') }}" class="w-6 h-6" alt="">
            <img src="{{ asset('storage/image/Feedback.png') }}" class="absolute top-1 right-0 w-6 h-6 z-10" alt="">
        </div>
        <div class="col-span-2">
            <h2 class="text-xl font-semibold text-gray-700">Sampaikan pengaduan ke Prodi</h2>
            <p class="text-gray-500 text-sm">Sampaikan masalah atau masukan Anda terkait prodi ini untuk perbaikan dan <br>peningkatan kualitas pendidikan</p>
        </div>
    </div>
    <div class="mt-4 pb-10">
        <!-- @if ($errors->any())
            <div class="bg-red py-2 px-3">
                <div>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif -->
        <form action="{{ route('mahasiswa.complaint.store') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="status" value="sent">
            <input type="date" name="date" value="{{ now() }}" hidden>
            <div>
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                <select name="category_id" class="w-full bg-white border {{ $errors->has('category_id') ? 'border-red-400' : 'border-gray-300' }} hover:bg-gray-100 focus:ring-1 focus:outline-none focus:ring-blue-500 rounded-lg text-sm p-3 text-start inline-flex justify-between items-center">
                    <option class="text-gray-500" value="">Pilih kategori</option>
                    @foreach($category as $data)
                    <option value="{{ $data->id }}" class="py-2 px-3 ">
                        <div class="flex flex-col space-x-3">
                            <img src="{{ Storage::url($data->label) }}" class="rounded-full w-8 h-8" alt="">
                            <div>
                                <p class="font-bold">{{ $data->name }}</p>
                            </div>
                        </div>
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <div class="pt-2 text-sm text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <label for="large-input" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Subjek</label>
                <input type="text" name="subject" id="large-input" class="block w-full p-3 text-gray-900 border {{ $errors->has('category_id') ? 'border-red-400' : 'border-gray-300' }} rounded-lg bg-white sm:text-md focus:ring-blue-500 focus:border-blue-500 hover:bg-gray-50 text-sm" placeholder="Tulis subjek">
                @error('subject')
                <div class="pt-2 text-sm text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <label for="message" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Your message</label>
                <textarea id="message" name="content" rows="4" class="block p-3 w-full text-sm text-gray-900 bg-white rounded-lg border {{ $errors->has('category_id') ? 'border-red-400' : 'border-gray-300' }} hover:bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Tulis komentar anda..."></textarea>
                @error('content')
                <div class="pt-2 text-sm text-red-600">
                    {{ $message }}
                </div>
                @enderror
                <p class="pt-3 text-gray-500 text-sm">Ingatlah untuk menjaga komentar dengan sopan</p>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-500 dark:text-white" for="multiple_files">Upload file pendukung</label>
                <input name="file" class="bg-gray-300 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" type="file" multiple>
                @error('file')
                <div class="pt-2 text-sm text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>
    </div>
    <div class="flex justify-end">
        <button data-modal-target="konfirmasi" data-modal-toggle="konfirmasi" class="bg-green-500 hover:bg-green-800 py-2 px-4 rounded text-white" type="button">Kirim umpan balik</button>
    </div>

    <!-- modal -->
    <div id="konfirmasi" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="z-20 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="konfirmasi">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-6">
                    <p class="text-md font-semibold text-md text-gray-700">Konfirmasi Pengiriman</p>
                    <p class="text-sm pb-4 text-gray-500">Apakah Anda yakin ingin mengirim keluhan ini? <br> Keluhan yang sudah dikirim tidak dapat diubah. Mohon pastikan bahwa komentar Anda konstruktif, sopan, dan menghargai keberagaman</p>
                    <div class="flex flex-row space-x-3 w-full">
                        <button data-modal-hide="konfirmasi" type="button" class="w-full text-center justify-center text-gray-500 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            Batal
                        </button>
                        <button data-modal-hide="konfirmasi" type="submit" class="w-full text-center justify-center text-white bg-green-500 hover:bg-green-800 focus:ring-2 focus:outline-none focus:ring-blue-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                            Kirim
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end modal -->
    </form>
</div>
</div>
@endsection