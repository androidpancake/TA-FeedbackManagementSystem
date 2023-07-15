@extends('template.template')

@section('content')
<div class="grid justify-center">
    <div class="flex items-start gap-2 mt-6">
        <div>
            <div class="relative bg-gray-300 p-6">
                <img src="{{ asset('storage/image/Teacher.png') }}" class="w-8 h-8" alt="">
                <img src="{{ asset('storage/image/Teacher.png') }}" class="w-4 h-4 z-10" alt="">
            </div>
        </div>
        <div class="col-span-2">
            <h2 class="text-2xl font-semibold">Beri umpan balik ke dosen</h2>
            <p class="text-gray-700">Bantu tingkatkan kualitas pengajaran dengan memberikan umpan balik Anda <br> kepada dosen</p>
        </div>
    </div>
    <div class="mt-10">
        @if ($errors->any())
            <div class="bg-red py-2 px-3">
                <div>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif
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
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600"></div>
                        </label>
                    </div>
                </div>
            </div>
            <div>
                <label for="kelas_id" class="block mb-2 text-sm font-medium text-gray-900">Dosen</label>
                <select name="kelas_id" class="w-full bg-white border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-4 text-start inline-flex justify-between items-center">
                    @forelse($class as $data)    
                    <option value="{{ $data->id }}" class="py-2 px-3 ">
                        <div class="flex flex-col space-x-3">
                            <img src="{ url('storage/images/S__14942228.jpg')}" class="rounded-full w-8 h-8" alt="">
                            <div>
                                <p class="font-bold">{{ $data->lecturer->name }}</p>
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
            </div>
            <div>
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                <select name="category_id" class="w-full bg-white border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-4 text-start inline-flex justify-between items-center">
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
            </div>
            <div>
                <label for="large-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subjek</label>
                <input type="text" name="subject" id="large-input" class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan subjek">                            
            </div>
            <div>           
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your message</label>
                <textarea id="message" name="content" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your thoughts here..."></textarea>
                <p class="text-gray-500 text-sm">Ingatlah untuk menjaga komentar dengan sopan</p>
            </div>
            <!-- <div>
                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Media (opsional)</label>    
                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                        </div>
                        <input id="dropzone-file" type="file" name="file" class="hidden" multiple/>
                    </label>
                </div> 
            </div> -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload file pendukung (opsional)</label>
                <input name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="multiple_files" type="file" multiple>
            </div>
            <div class="flex justify-end">
                <button class="bg-green-500 py-2 px-3 rounded text-white font-semibold" type="submit">Kirim umpan balik</button>
            </div>
        </form>
    </div>
</div>
@endsection