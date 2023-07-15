@extends('template.template')
@section('content')
<h1 class="font-bold text-2xl">Komplain</h1>
    <div class="flex justify-between py-2 mt-4 items-start">
        <div class="flex space-x-2 w-full overflow-x-auto" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
            <button id="all-tab" role="tab" data-tabs-target="#all" aria-selected="true" aria-controls="all" type="button" class="py-2 px-2 bg-gray-200 rounded-lg font-bold text-gray-700 text-sm inline-flex items-center space-x-1">
                <p>Semua</p>
                <p>{{ count($complaint) }}</p>
            </button>
            <button id="wait-tab" role="tab" data-tabs-target="#wait" aria-selected="false" aria-controls="wait" type="button" class="py-2 px-2 rounded-lg font-bold text-gray-700 text-sm inline-flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256"><path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path></svg>
                <p>Menunggu respon</p>
                <p>{{ count($wait) }}</p>
            </button>
            
            <button id="read-tab" role="tab" data-tabs-target="#read" aria-selected="false" aria-controls="read" type="button" class="py-2 px-2 rounded font-bold text-gray-700 text-sm inline-flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256"><path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path></svg>                        
                <p>Diproses</p>
                <p>{{ count($read) }}</p>
            </button>
            <button id="process-tab" role="tab" data-tabs-target="#process" aria-selected="false" aria-controls="process" type="button" class="py-2 px-2 rounded font-bold text-gray-700 text-sm inline-flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256"><path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path></svg>                        
                <p>Diproses</p>
                <p>{{ count($process) }}</p>
            </button>
            <button id="done-tab" role="tab" data-tabs-target="#done" aria-selected="false" aria-controls="done" type="button" class="py-2 px-2 rounded font-bold text-gray-700 text-sm inline-flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg"class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>                        
                <p>Selesai</p>
                <p>{{ count($done) }}</p>
            </button>
        </div>
        
        <div class="flex w-96 space-x-2">
            <button id="dropdownCategory" data-dropdown-toggle="dropdown" class="bg-white border w-full border-gray-300 hover:bg-gray-100 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex justify-between items-center" type="button">
                Kategori 
                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownCategory">
                    <li>
                        <a href="{{ route('mahasiswa.complaint.index') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Semua</a>
                    </li>
                    @foreach($category as $data)
                    <li>
                        <a href="{{ route('mahasiswa.complaint.category', $data->name) }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $data->name }}</a>
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
    <div id="#myTabContent">
        <div class="border-t" id="all" role="tabpanel" aria-labelledby="all-tab">
            <div class="divide-y divide-gray-400 mt-5">
                @forelse($complaint as $data)
                <div class="sm:bg-white py-6 space-y-3">
                    <div class="flex sm:flex justify-between items-center space-x-2">
                        <div class="flex md:flex-row items-center justify-start space-x-2">
                            <!-- <p>{{ $data->id }}</p> -->
                            <p class="text-lg font-bold text-gray-800">Prodi</p>
                        </div>
                        <div class="inline-flex space-x-2">
                            <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                            <button id="dropdownDelete" data-dropdown-toggle="dropdownID{{ $data->id }}" class="hover:bg-gray-200 rounded-full focus:ring-2 ring-green-600 ring-inset">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256"><path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128Zm56-12a12,12,0,1,0,12,12A12,12,0,0,0,196,116ZM60,116a12,12,0,1,0,12,12A12,12,0,0,0,60,116Z"></path></svg>                            
                            </button>
                            <div id="dropdownID{{ $data->id }}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                <ul aria-labelledby="dropdownDelete" class="py-2 text-sm text-gray-700">
                                    <li>
                                        <button data-modal-target="modalID{{ $data->id }}" data-modal-toggle="modalID{{ $data->id }}" class="w-full px-4 py-2 text-base hover:bg-gray-100">Hapus komplain</button>
                                    </li>
                                </ul>
                            </div>
                            <!-- Delete modal -->
                            <div id="modalID{{ $data->id }}" tabindex="-1" aria-hidden="true" class="fixed top-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-md">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between p-4 rounded-t dark:border-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 bg-gray-200 rounded-full p-2" fill="currentColor" viewBox="0 0 256 256"><path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path></svg>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modalID2">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="p-6 space-y-2">
                                            <p class="text-lg font-bold leading-relaxed text-gray-900 dark:text-gray-400">
                                                Hapus komplain?
                                            </p>
                                            <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                                Apakah Anda yakin ingin menghapus komplain ini? Aksi ini tidak dapat dibatalkan dan semua data terkait komplain ini akan hilang.                                            </p>
                                        </div>
                                        <!-- Modal footer -->
                                        <form action="{{ route('mahasiswa.complaint.delete', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="flex flex-row items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                                <a href="" data-modal-hide="modalID{{ $data->id }}" class="grow text-center bg-white border px-3 py-2 rounded">Batalkan</a>
                                                <button type="submit" class="grow text-center bg-red-600 px-3 py-2 text-white rounded">Hapus</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex space-x-2">
                            <h2 class="font-bold text-gray-800 text-base">{{ $data->subject }}</h2>
                            
                            <span class="bg-green-100 text-green-800 text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2 dark:bg-gray-700 dark:text-gray-400 border border-green-300">
                                <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                                {{ $data->category->name }}
                            </span>
                        </div>
                        <p class="text-sm mt-2 text-gray-500">
                            {{ $data->content }}
                        </p>
                        <div class="flex items-center space-x-2 mt-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path></svg>
                            @if(count($data->complaint_reply) != 0)
                            <p class="text-sm text-blue-500">{{ count($data->complaint_reply) }} balasan</p>
                            @else
                            <p class="text-sm text-blue-500">belum ada balasan</p>
                            @endif
                            <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="text-gray-400 text-sm hover:text-black">Lihat komplain</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white border rounded p-4">
                    <p>Tidak ada data</p>
                </div>
                @endforelse

            </div>
        </div>
        <div class="border-t" id="wait" role="tabpanel" aria-labelledby="wait-tab">
            <div class="divide-y divide-gray-400 mt-5">
                @forelse($wait as $data)
                <div class="sm:bg-white py-6 space-y-3">
                    <div class="flex sm:flex justify-between items-center space-x-2">
                        <div class="flex md:flex-row items-center justify-start space-x-2">
                            <p>{{ $data->id }}</p>
                            <p class="text-lg font-bold text-gray-800">Prodi</p>
                        </div>
                        <div class="inline-flex space-x-2">
                            <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex space-x-2">
                            <h2 class="font-bold text-gray-800 text-base">{{ $data->subject }}</h2>

                            <span class="bg-green-100 text-green-800 text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2 dark:bg-gray-700 dark:text-gray-400 border border-green-300">
                                <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                                {{ $data->category->name }}
                            </span>
                        </div>
                        <p class="text-sm mt-2 text-gray-500">
                            {{ $data->content }}
                        </p>
                        <div class="flex items-center space-x-2 mt-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path></svg>
                            @if(count($data->complaint_reply) != 0)
                            <p class="text-sm text-blue-500">{{ count($data->complaint_reply) }} balasan</p>
                            @else
                            <p class="text-sm text-blue-500">belum ada balasan</p>
                            @endif
                            <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="text-gray-400 text-sm hover:text-black">Lihat komplain</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white border rounded p-4">
                    <p>Tidak ada data</p>
                </div>
                @endforelse
            </div>
        </div>
        <div class="border-t" id="read" role="tabpanel" aria-labelledby="read-tab">
            <div class="divide-y divide-gray-400 mt-6">
                @forelse($read as $data)
                <div class="sm:bg-white py-6 space-y-3">
                    <div class="flex sm:flex justify-between items-center space-x-2">
                        <div class="flex md:flex-row items-center justify-start space-x-2">
                            <p>{{ $data->id }}</p>
                            <p class="text-lg font-bold text-gray-800">Prodi</p>
                        </div>
                        <div class="inline-flex space-x-2">
                            <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex space-x-2">
                            <h2 class="font-bold text-gray-800 text-base">{{ $data->subject }}</h2>

                            <span class="bg-green-100 text-green-800 text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2 dark:bg-gray-700 dark:text-gray-400 border border-green-300">
                                <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                                {{ $data->category->name }}
                            </span>
                        </div>
                        <p class="text-sm mt-2 text-gray-500">
                            {{ $data->content }}
                        </p>
                        <div class="flex items-center space-x-2 mt-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path></svg>
                            @if(count($data->complaint_reply) != 0)
                            <p class="text-sm text-blue-500">{{ count($data->complaint_reply) }} balasan</p>
                            @else
                            <p class="text-sm text-blue-500">belum ada balasan</p>
                            @endif
                            <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="text-gray-400 text-sm hover:text-black">Lihat komplain</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white border rounded p-4">
                    <p>Tidak ada data</p>
                </div>
                @endforelse
            </div>
        </div>
        <div class="border-t" id="process" role="tabpanel" aria-labelledby="process-tab">
            <div class="divide-y divide-gray-400 mt-6">
                @forelse($process as $data)
                <div class="sm:bg-white py-6 space-y-3">
                    <div class="flex sm:flex justify-between items-center space-x-2">
                        <div class="flex md:flex-row items-center justify-start space-x-2">
                            <p>{{ $data->id }}</p>
                            <p class="text-lg font-bold text-gray-800">Prodi</p>
                        </div>
                        <div class="inline-flex space-x-2">
                            <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex space-x-2">
                            <h2 class="font-bold text-gray-800 text-base">{{ $data->subject }}</h2>

                            <span class="bg-green-100 text-green-800 text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2 dark:bg-gray-700 dark:text-gray-400 border border-green-300">
                                <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                                {{ $data->category->name }}
                            </span>
                        </div>
                        <p class="text-sm mt-2 text-gray-500">
                            {{ $data->content }}
                        </p>
                        <div class="flex items-center space-x-2 mt-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path></svg>
                            @if(count($data->complaint_reply) != 0)
                            <p class="text-sm text-blue-500">{{ count($data->complaint_reply) }} balasan</p>
                            @else
                            <p class="text-sm text-blue-500">belum ada balasan</p>
                            @endif
                            <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="text-gray-400 text-sm hover:text-black">Lihat komplain</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white border rounded p-4">
                    <p>Tidak ada data</p>
                </div>
                @endforelse
            </div>
        </div>
        <div class="border-t" id="done" role="tabpanel" aria-labelledby="done-tab">
            <div class="divide-y divide-gray-400 mt-6">
                @forelse($done as $data)
                <div class="sm:bg-white py-6 space-y-3">
                    <div class="flex sm:flex justify-between items-center space-x-2">
                        <div class="flex md:flex-row items-center justify-start space-x-2">
                            <p>{{ $data->id }}</p>
                            <p class="text-lg font-bold text-gray-800">Prodi</p>
                        </div>
                        <div class="inline-flex space-x-2">
                            <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex space-x-2">
                            <h2 class="font-bold text-gray-800 text-base">{{ $data->subject }}</h2>

                            <span class="bg-green-100 text-green-800 text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2 dark:bg-gray-700 dark:text-gray-400 border border-green-300">
                                <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                                {{ $data->category->name }}
                            </span>
                        </div>
                        <p class="text-sm mt-2 text-gray-500">
                            {{ $data->content }}
                        </p>
                        <div class="flex items-center space-x-2 mt-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path></svg>
                            @if(count($data->complaint_reply) != 0)
                            <p class="text-sm text-blue-500">{{ count($data->complaint_reply) }} balasan</p>
                            @else
                            <p class="text-sm text-blue-500">belum ada balasan</p>
                            @endif
                            <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="text-gray-400 text-sm hover:text-black">Lihat komplain</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white border rounded p-4">
                    <p>Tidak ada data</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- add feedback button + modal -->
    <a href="{{ route('mahasiswa.complaint.create') }}" class="fixed bottom-4 right-3 m-6 w-auto p-3 bg-green-600 hover:bg-green-800 py-2 rounded shadow-lg">
        <p class="text-base text-white flex">+ Keluhan Baru</p>
    </a> 
@endsection