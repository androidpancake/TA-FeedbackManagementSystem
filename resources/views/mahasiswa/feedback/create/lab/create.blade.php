@extends('template.template')

@section('content')
<div class="grid justify-center pb-4">
    <div class="flex items-start gap-2 mt-6">
        <div>
            <div class="relative bg-gray-300 p-6">
                <img src="{{ asset('storage/image/Teacher.png') }}" class="w-8 h-8" alt="">
                <img src="{{ asset('storage/image/Teacher.png') }}" class="w-4 h-4 z-10" alt="">
            </div>
        </div>
        <div class="col-span-2">
            <h2 class="text-2xl font-semibold">Beri umpan balik ke lab</h2>
            <p class="text-gray-700">Bantu tingkatkan kualitas pengajaran dengan memberikan umpan balik Anda <br> kepada lab</p>
        </div>
    </div>
    <div class="mt-10">
        <form action="{{ route('mahasiswa.feedback.store') }}" method="POST" class="space-y-8" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="status" value="sent">
            <div class="border-y p-4">
                <div class="flex justify-between">
                    <div>
                        <h2 class="font-semibold">Sembunyikan Identitas</h2>
                        <p class="font-base text-sm text-gray-600">Aktifkan ini untuk memberikan umpan balik tanpa menampilkan identitas Anda</p>
                    </div>
                    <div>                  
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="anonymous" id="anonymous" value="1" class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
                        </label>
                    </div>
                </div>
            </div>
            <div>
                <label for="kelas_id" class="block mb-2 text-sm font-medium text-gray-900">Lab</label>
                <select name="kelas_id" class="w-full bg-white border border-gray-200 hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-green-500 font-medium rounded-lg text-sm px-5 py-4 text-start inline-flex justify-between items-center">
                    <option value="">Pilih lab</option>
                    @forelse($class as $data)    
                    <option value="{{ $data->id }}" class="py-2 px-3 ">
                        <div class="flex flex-col space-x-3">
                            <img src="{ url('storage/images/S__14942228.jpg')}" class="rounded-full w-8 h-8" alt="">
                            <div>
                                <p class="font-bold">{{ $data->lab->name }}</p>
                                <p>-</p>
                                <p class="text-sm text-gray-600">{{ $data->course->name }}</p>
                                <p>-</p>
                                <p class="text-sm">{{ $data->name }}</p>
                            </div>
                        </div>
                    </option>
                    @empty
                    <option value="" selected>Tidak ada mata kuliah yang diikuti</option>
                    @endforelse
                </select>
                @error('kelas_id')
                <div class="pt-2 text-sm text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                <select name="category_id" class="w-full bg-white border border-gray-200 hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-green-500 font-medium rounded-lg text-sm px-5 py-4 text-start inline-flex justify-between items-center">
                    <option value="">Pilih kategori</option>
                    @foreach($category as $data)    
                    <option value="{{ $data->id }}" class="py-2 px-3 ">
                        <div class="flex flex-col space-x-3">
                            <img src="{ url('storage/images/S__14942228.jpg')}" class="rounded-full w-8 h-8" alt="">
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
                <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subjek</label>
                <input type="text" name="subject" id="large-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-green-500 focus:border-green-300" placeholder="Masukkan subjek">                            
                @error('subject')
                <div class="pt-2 text-sm text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>           
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
                <textarea id="message" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-green-500 focus:border-green-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-green-500 dark:focus:border-green-500" placeholder="Write your thoughts here..."></textarea>
                <p class="text-gray-500 text-sm">Ingatlah untuk menjaga komentar dengan sopan</p>
                @error('content')
                <div class="pt-2 text-sm text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload file pendukung (opsional)</label>
                <input name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" type="file" multiple>
                @error('file')
                <div class="pt-2 text-sm text-red-600">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="flex justify-between">
                <button type="button" class="text-blue-500 text-sm" data-modal-target="defaultModal" data-modal-toggle="defaultModal">tentang umpan balik</button>
                <button class="bg-green-500 py-2 px-3 rounded text-white font-semibold" type="submit">Kirim umpan balik</button>
            </div>
            <!-- modal about -->
            <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Informasi
                            </h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                        <ul class="max-w-lg space-y-1 text-gray-500 list-disc list-inside">
                            <li>
                                Anda hanya dapat mengirimkan umpan balik maksimal 2x sehari
                            </li>
                            <li>
                                Pastikan informasi yang anda berikan kepada lab adalah informasi yang benar
                            </li>
                            <li>
                                Berikan umpan balik dengan tata bahasa yang baik dan sopan
                            </li>
                        </ul>
                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                            </p>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button data-modal-hide="defaultModal" type="button" class="text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Saya mengerti</button>
                            <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal about -->
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
                            <p class="text-sm pb-4 text-gray-500">Apakah Anda yakin ingin mengirim umpan balik ini? <br> Umpan balik yang sudah dikirim tidak dapat diubah. Mohon pastikan bahwa komentar Anda konstruktif, sopan, dan menghargai keberagaman</p>
                            <div class="flex flex-row space-x-3 w-full">
                                <button data-modal-hide="konfirmasi" type="button" class="w-full text-center justify-center text-gray-500 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                    Batal
                                </button>
                                <button data-modal-hide="konfirmasi" type="submit" class="w-full justify-center text-white bg-green-500 hover:bg-green-800 focus:ring-2 focus:outline-none focus:ring-blue-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
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