@extends('template.template')
@section('content')
<div class="">
    <div class="flex flex-row items-center space-x-2 px-8">
        <h1 class="font-semibold text-gray-700 text-2xl">Keluhan</h1>
        <span class="flex items-center space-x-1 {{ $categoryName->bg }} text-sm font-medium mr-2 px-2.5 py-0.5 rounded-md">
            <img src="{{ Storage::url($categoryName->label) }}" class="w-4 h-4 mr-1" alt="">
            {{ $categoryName->name }}
        </span>
    </div>
    <div class="flex justify-between py-2 mt-2 items-center px-8">
        <div class="flex space-x-2 overflow-x-auto" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <button id="wait-tab" role="tab" data-tabs-target="#wait" aria-selected="false" aria-controls="wait" type="button" class="hover:bg-gray-100 py-2 px-3 rounded-lg font-semibold text-gray-700 text-sm inline-flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path>
                </svg>
                <p>Menunggu Respon</p>
                <p>{{ count($wait) }}</p>
            </button>
            <button id="read-tab" role="tab" data-tabs-target="#read" aria-selected="false" aria-controls="read" type="button" class="hover:bg-gray-100 y-2 px-3 rounded-lg font-semibold text-gray-700 text-sm inline-flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M228.44,89.34l-96-64a8,8,0,0,0-8.88,0l-96,64A8,8,0,0,0,24,96V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V96A8,8,0,0,0,228.44,89.34ZM96.72,152,40,192V111.53Zm16.37,8h29.82l56.63,40H56.46Zm46.19-8L216,111.53V192ZM128,41.61l81.91,54.61-67,47.78H113.11l-67-47.78Z"></path>
                </svg>
                <p>Dibaca</p>
                <p>{{ count($read) }}</p>
            </button>
            <button id="process-tab" role="tab" data-tabs-target="#process" aria-selected="false" aria-controls="process" type="button" class="hover:bg-gray-100 py-2 px-3 rounded-lg font-semibold text-gray-700 text-sm inline-flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path>
                </svg>
                <p>Diproses</p>
                <p>{{ count($process) }}</p>
            </button>
            <button id="done-tab" role="tab" data-tabs-target="#done" aria-selected="false" aria-controls="done" type="button" class="hover:bg-gray-100 py-2 px-3 rounded-lg font-semibold text-gray-700 text-sm inline-flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path>
                </svg>
                <p>Selesai</p>
                <p>{{ count($done) }}</p>
            </button>
        </div>
        <!-- select < sm screen -->
        <select id="status" class="w-full lg:hidden bg-white border border-gray-300 hover:bg-gray-200 focus:border-green-500 focus:ring-green-300 rounded-lg text-sm px-4 py-2.5 text-center inline-flex justify-start items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3" fill="#000000" viewBox="0 0 256 256">
                <path d="M80,64a8,8,0,0,1,8-8H216a8,8,0,0,1,0,16H88A8,8,0,0,1,80,64Zm136,56H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Zm0,64H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16ZM44,52A12,12,0,1,0,56,64,12,12,0,0,0,44,52Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,116Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,180Z"></path>
            </svg>

            <option selected value="all">Semua</option>
            <option value="wait">Menunggu respon</option>
            <option value="read">Dibaca</option>
            <option value="done">Selesai</option>
        </select>

        <div class="flex sm:w-64 space-x-2">
            <button id="dropdownCategory" data-dropdown-toggle="dropdown" class="grow bg-white border border-gray-300 hover:bg-gray-200 focus:ring-2 focus:outline-none focus:ring-green-500 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center" type="button">Kategori
                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownCategory">
                    <li>
                        <a href="{{ route('mahasiswa.complaint.index') }}" class="block px-4 py-2 hover:bg-gray-100">Semua</a>
                    </li>
                    @foreach($category as $data)
                    <li>
                        <a href="{{ route('mahasiswa.complaint.category', $data->name) }}" class="block space-x-2 px-4 py-2 hover:bg-gray-100">
                            <div class="flex flex-row space-x-3">
                                <img src="{{ Storage::url($data->label) }}" class="w-4 h-4" alt="">
                                <p>{{ $data->name }}</p>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            <form action="{{ route('mahasiswa.complaint.category', ['categoryName' => $categoryName->name]) }}" method="GET" class="w-full">
                <select id="small" name="sort" onchange="this.form.submit()" class="w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-green-500 focus:border-green-500">
                    <option value="latest" {{ request()->get('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                    <option value="oldest" {{ request()->get('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                </select>
            </form>
        </div>
    </div>
    <div id="#myTabContent" class="h-screen">
        <div class="border-t" id="wait" role="tabpanel" aria-labelledby="wait-tab">
            <div class="divide-y divide-gray-200">
                @forelse($wait as $data)
                <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="block">
                    <div class="sm:bg-white py-6 px-8 hover:bg-gray-50">
                        <div class="flex md:flex-row items-center justify-between items-center space-x-2 mb-2">
                            <div class="flex items-center justify-start space-x-2">
                                <p class="text-sm text-gray-600">Prodi</p>
                            </div>
                            <div class="inline-flex space-x-2">
                                <p class="text-sm text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                                <button onclick="event.preventDefault()" id="dropdownDelete" data-dropdown-toggle="dropdownID{{ $data->id }}" class="hover:bg-gray-200 rounded-full focus:ring-2 ring-green-600 ring-inset z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256">
                                        <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128Zm56-12a12,12,0,1,0,12,12A12,12,0,0,0,196,116ZM60,116a12,12,0,1,0,12,12A12,12,0,0,0,60,116Z"></path>
                                    </svg>
                                </button>
                                <div id="dropdownID{{ $data->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                    <ul aria-labelledby="dropdownDelete" class="py-2 text-sm text-gray-700">
                                        <li>
                                            <button onclick="event.preventDefault()" data-modal-target="modalID{{ $data->id }}" data-modal-toggle="modalID{{ $data->id }}" class="w-full px-4 py-2 text-base hover:bg-gray-100">Hapus komplain</button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- modal -->
                                <div id="modalID{{ $data->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="z-20 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="konfirmasi">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6">
                                                <p class="text-md font-semibold text-md text-gray-700">Konfirmasi Penghapusan</p>
                                                <p class="text-sm pb-4 text-gray-500">Apakah Anda yakin ingin menghapus umpan balik ini? <br> Aksi ini tidak dapat dibatalkan dan semua data terkait umpan balik ini akan hilang.</p>
                                                <div class="flex flex-row space-x-3 w-full">
                                                    <form class="flex flex-row space-x-3 w-full" method="POST" action="{{ route('mahasiswa.complaint.delete' , $data->id) }}">
                                                        <button data-modal-hide="modalID{{ $data->id }}" type="button" class="w-full text-center justify-center text-gray-500 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                                            Batal
                                                        </button>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button data-modal-hide="modalID{{ $data->id }}" type="submit" class="w-full text-center justify-center text-white bg-red-500 hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-blue-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Hapus Keluhan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex space-x-2">
                                <h2 class="font-bold text-gray-800 text-base">{{ $data->subject }}</h2>
                                <span class="{{ $data->category->bg }} text-xs font-semibold inline-flex items-center px-1.5 py-0.5 rounded-md mr-2">
                                    <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                                    {{ $data->category->name }}
                                </span>
                            </div>
                            <p class="text-sm mt-1 text-gray-500">
                                {{ $data->content }}
                            </p>
                            <div class="flex items-center mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path>
                                </svg>
                                @if(count($data->complaint_reply) != 0)
                                <p class="text-sm text-blue-500">{{ count($data->complaint_reply) }} balasan</p>
                                @else
                                <p class="text-sm text-blue-500">0</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="p-8">
                    <div class="">
                        <p>Tidak ada data :(</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
        <div class="border-t" id="read" role="tabpanel" aria-labelledby="read-tab">
            <div class="divide-y divide-gray-200">
                @forelse($read as $data)
                <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="block">
                    <div class="sm:bg-white py-6 px-8 hover:bg-gray-50">
                        <div class="flex md:flex-row items-center justify-between items-center space-x-2 mb-2">
                            <div class="flex items-center justify-start space-x-2">
                                <p class="text-sm text-gray-600">Prodi</p>
                            </div>
                            <div class="inline-flex space-x-2">
                                <p class="text-sm text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                                <button onclick="event.preventDefault()" id="dropdownDelete" data-dropdown-toggle="dropdownID{{ $data->id }}" class="hover:bg-gray-200 rounded-full focus:ring-2 ring-green-600 ring-inset z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256">
                                        <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128Zm56-12a12,12,0,1,0,12,12A12,12,0,0,0,196,116ZM60,116a12,12,0,1,0,12,12A12,12,0,0,0,60,116Z"></path>
                                    </svg>
                                </button>
                                <div id="dropdownID{{ $data->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                    <ul aria-labelledby="dropdownDelete" class="py-2 text-sm text-gray-700">
                                        <li>
                                            <button onclick="event.preventDefault()" data-modal-target="modalID{{ $data->id }}" data-modal-toggle="modalID{{ $data->id }}" class="w-full px-4 py-2 text-base hover:bg-gray-100">Hapus komplain</button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- modal -->
                                <div id="modalID{{ $data->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="z-20 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="konfirmasi">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6">
                                                <p class="text-md font-semibold text-md text-gray-700">Konfirmasi Penghapusan</p>
                                                <p class="text-sm pb-4 text-gray-500">Apakah Anda yakin ingin menghapus umpan balik ini? <br> Aksi ini tidak dapat dibatalkan dan semua data terkait umpan balik ini akan hilang.</p>
                                                <div class="flex flex-row space-x-3 w-full">
                                                    <form class="flex flex-row space-x-3 w-full" method="POST" action="{{ route('mahasiswa.complaint.delete' , $data->id) }}">
                                                        <button data-modal-hide="modalID{{ $data->id }}" type="button" class="w-full text-center justify-center text-gray-500 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                                            Batal
                                                        </button>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button data-modal-hide="modalID{{ $data->id }}" type="submit" class="w-full text-center justify-center text-white bg-red-500 hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-blue-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Hapus Keluhan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex space-x-2">
                                <h2 class="font-bold text-gray-800 text-base">{{ $data->subject }}</h2>
                                <span class="{{ $data->category->bg }} text-xs font-semibold inline-flex items-center px-1.5 py-0.5 rounded-md mr-2">
                                    <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                                    {{ $data->category->name }}
                                </span>
                            </div>
                            <p class="text-sm mt-1 text-gray-500">
                                {{ $data->content }}
                            </p>
                            <div class="flex items-center mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path>
                                </svg>
                                @if(count($data->complaint_reply) != 0)
                                <p class="text-sm text-blue-500">{{ count($data->complaint_reply) }} balasan</p>
                                @else
                                <p class="text-sm text-blue-500">0</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="p-8">
                    <div class="">
                        <p>Tidak ada data :(</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
        <div class="border-t" id="process" role="tabpanel" aria-labelledby="process-tab">
            <div class="divide-y divide-gray-200">
                @forelse($process as $data)
                <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="block">
                    <div class="sm:bg-white py-6 px-8 hover:bg-gray-50">
                        <div class="flex md:flex-row items-center justify-between items-center space-x-2 mb-2">
                            <div class="flex items-center justify-start space-x-2">
                                <p class="text-sm text-gray-600">Prodi</p>
                            </div>
                            <div class="inline-flex space-x-2">
                                <p class="text-sm text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                                <button onclick="event.preventDefault()" id="dropdownDelete" data-dropdown-toggle="dropdownID{{ $data->id }}" class="hover:bg-gray-200 rounded-full focus:ring-2 ring-green-600 ring-inset z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256">
                                        <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128Zm56-12a12,12,0,1,0,12,12A12,12,0,0,0,196,116ZM60,116a12,12,0,1,0,12,12A12,12,0,0,0,60,116Z"></path>
                                    </svg>
                                </button>
                                <div id="dropdownID{{ $data->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                    <ul aria-labelledby="dropdownDelete" class="py-2 text-sm text-gray-700">
                                        <li>
                                            <button onclick="event.preventDefault()" data-modal-target="modalID{{ $data->id }}" data-modal-toggle="modalID{{ $data->id }}" class="w-full px-4 py-2 text-base hover:bg-gray-100">Hapus komplain</button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- modal -->
                                <div id="modalID{{ $data->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="z-20 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="konfirmasi">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6">
                                                <p class="text-md font-semibold text-md text-gray-700">Konfirmasi Penghapusan</p>
                                                <p class="text-sm pb-4 text-gray-500">Apakah Anda yakin ingin menghapus umpan balik ini? <br> Aksi ini tidak dapat dibatalkan dan semua data terkait umpan balik ini akan hilang.</p>
                                                <div class="flex flex-row space-x-3 w-full">
                                                    <form class="flex flex-row space-x-3 w-full" method="POST" action="{{ route('mahasiswa.complaint.delete' , $data->id) }}">
                                                        <button data-modal-hide="modalID{{ $data->id }}" type="button" class="w-full text-center justify-center text-gray-500 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                                            Batal
                                                        </button>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button data-modal-hide="modalID{{ $data->id }}" type="submit" class="w-full text-center justify-center text-white bg-red-500 hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-blue-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Hapus Keluhan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex space-x-2">
                                <h2 class="font-bold text-gray-800 text-base">{{ $data->subject }}</h2>
                                <span class="{{ $data->category->bg }} text-xs font-semibold inline-flex items-center px-1.5 py-0.5 rounded-md mr-2">
                                    <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                                    {{ $data->category->name }}
                                </span>
                            </div>
                            <p class="text-sm mt-1 text-gray-500">
                                {{ $data->content }}
                            </p>
                            <div class="flex items-center mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path>
                                </svg>
                                @if(count($data->complaint_reply) != 0)
                                <p class="text-sm text-blue-500">{{ count($data->complaint_reply) }} balasan</p>
                                @else
                                <p class="text-sm text-blue-500">0</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="p-8">
                    <div class="">
                        <p>Tidak ada data :(</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
        <div class="border-t" id="done" role="tabpanel" aria-labelledby="done-tab">
            <div class="divide-y divide-gray-200">
                @forelse($done as $data)
                <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="block">
                    <div class="sm:bg-white py-6 px-8 hover:bg-gray-50">
                        <div class="flex md:flex-row items-center justify-between items-center space-x-2 mb-2">
                            <div class="flex items-center justify-start space-x-2">
                                <p class="text-sm text-gray-600">Prodi</p>
                            </div>
                            <div class="inline-flex space-x-2">
                                <p class="text-sm text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                                <button onclick="event.preventDefault()" id="dropdownDelete" data-dropdown-toggle="dropdownID{{ $data->id }}" class="hover:bg-gray-200 rounded-full focus:ring-2 ring-green-600 ring-inset z-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256">
                                        <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128Zm56-12a12,12,0,1,0,12,12A12,12,0,0,0,196,116ZM60,116a12,12,0,1,0,12,12A12,12,0,0,0,60,116Z"></path>
                                    </svg>
                                </button>
                                <div id="dropdownID{{ $data->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                    <ul aria-labelledby="dropdownDelete" class="py-2 text-sm text-gray-700">
                                        <li>
                                            <button onclick="event.preventDefault()" data-modal-target="modalID{{ $data->id }}" data-modal-toggle="modalID{{ $data->id }}" class="w-full px-4 py-2 text-base hover:bg-gray-100">Hapus komplain</button>
                                        </li>
                                    </ul>
                                </div>
                                <!-- modal -->
                                <div id="modalID{{ $data->id }}" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="z-20 w-full max-w-md max-h-full">
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="konfirmasi">
                                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                            <div class="p-6">
                                                <p class="text-md font-semibold text-md text-gray-700">Konfirmasi Penghapusan</p>
                                                <p class="text-sm pb-4 text-gray-500">Apakah Anda yakin ingin menghapus umpan balik ini? <br> Aksi ini tidak dapat dibatalkan dan semua data terkait umpan balik ini akan hilang.</p>
                                                <div class="flex flex-row space-x-3 w-full">
                                                    <form class="flex flex-row space-x-3 w-full" method="POST" action="{{ route('mahasiswa.complaint.delete' , $data->id) }}">
                                                        <button data-modal-hide="modalID{{ $data->id }}" type="button" class="w-full text-center justify-center text-gray-500 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">
                                                            Batal
                                                        </button>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button data-modal-hide="modalID{{ $data->id }}" type="submit" class="w-full text-center justify-center text-white bg-red-500 hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-blue-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                            Hapus Keluhan
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex space-x-2">
                                <h2 class="font-bold text-gray-800 text-base">{{ $data->subject }}</h2>
                                <span class="{{ $data->category->bg }} text-xs font-semibold inline-flex items-center px-1.5 py-0.5 rounded-md mr-2">
                                    <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                                    {{ $data->category->name }}
                                </span>
                            </div>
                            <p class="text-sm mt-1 text-gray-500">
                                {{ $data->content }}
                            </p>
                            <div class="flex items-center mt-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path>
                                </svg>
                                @if(count($data->complaint_reply) != 0)
                                <p class="text-sm text-blue-500">{{ count($data->complaint_reply) }} balasan</p>
                                @else
                                <p class="text-sm text-blue-500">0</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                @empty
                <div class="p-8">
                    <div class="">
                        <p>Tidak ada data :(</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- add feedback button + modal -->
<a href="{{ route('mahasiswa.complaint.create') }}" class="fixed bottom-4 right-3 m-6 w-auto p-3 bg-green-600 hover:bg-green-800 py-2 rounded shadow-lg">
    <p class="text-base text-white flex">+ Keluhan Baru</p>
</a>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let initButton = document.querySelector('button[aria-selected="true"]');
        if (initButton) {
            initButton.classList.add('selected');
        }
        let buttons = document.querySelectorAll('button[role="tab"]');
        console.log(buttons.length)
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {

                // Remove the 'selected' class from all buttons
                buttons.forEach(function(btn) {
                    btn.classList.remove('selected');
                    btn.setAttribute('aria-selected', 'false');
                });

                // Add the 'selected' class to the clicked button
                this.classList.add('selected');
                this.setAttribute('aria-selected', 'true');
            });
        });

    });
</script>
@endsection