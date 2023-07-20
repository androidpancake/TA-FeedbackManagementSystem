@extends('template.admin.template')

@section('content')
<div class="">
    <div class="px-8">
        <h1 class="font-semibold text-gray-700 text-2xl">Keluhan</h1>
        <div class="flex justify-between py-2 mt-2 items-start">
            <div class="hidden lg:flex space-x-2" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                <button id="all-tab" role="tab" data-tabs-target="#all" aria-selected="true" aria-controls="all" type="button" class="py-2 px-2 bg-gray-200 rounded-lg font-semibold text-gray-700 text-sm inline-flex items-center space-x-1">
                    <p>Semua</p>
                    <p>{{ count($complaint) }}</p>
                </button>
                <button id="wait-tab" role="tab" data-tabs-target="#wait" aria-selected="false" aria-controls="wait" type="button" class="py-2 px-2 rounded-lg font-semibold text-gray-700 text-sm inline-flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path>
                    </svg>
                    <p>Menunggu respon</p>
                    <p>{{ count($wait) }}</p>
                </button>
                <button id="read-tab" role="tab" data-tabs-target="#read" aria-selected="false" aria-controls="read" type="button" class="py-2 px-2 rounded-lg font-semibold text-gray-700 text-sm inline-flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path>
                    </svg>
                    <p>Dibaca</p>
                    <p>{{ count($read) }}</p>
                </button>
                <button id="process-tab" role="tab" data-tabs-target="#process" aria-selected="false" aria-controls="process" type="button" class="py-2 px-2 rounded-lg font-semibold text-gray-700 text-sm inline-flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path>
                    </svg>
                    <p>Diproses</p>
                    <p>{{ count($process) }}</p>
                </button>
                <button id="done-tab" role="tab" data-tabs-target="#done" aria-selected="false" aria-controls="done" type="button" class="py-2 px-2 rounded-lg font-semibold text-gray-700 text-sm inline-flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256">
                        <path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path>
                    </svg>
                    <p>Selesai</p>
                    <p>{{ count($done) }}</p>
                </button>
            </div>

            <div class="flex w-64 space-x-2">
                <form action="" method="GET" class="w-full">
                    <select id="by_category" name="category" onchange="this.form.submit()" class="w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-green-500 focus:border-green-500">
                        <option value="">Semua</option>
                        @foreach($category as $data)
                        <option value="{{ $data->id }}" {{ $data->id == request('category') ? 'selected' : '' }}>{{ $data->name }}</option>
                        @endforeach
                    </select>
                </form>
                <form action="{{ route('mahasiswa.complaint.index') }}" method="GET" class="w-full">
                    <select id="small" name="sort" onchange="this.form.submit()" class="w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-green-500 focus:border-green-500">
                        <option value="latest" {{ request()->get('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="oldest" {{ request()->get('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </form>
            </div>
        </div>

    </div>


    <!-- feedback -->
    <div id="#myTabContent" class="h-screen">
        <div class="h-screen border-t overflow-y-auto" id="all" role="tabpanel" aria-labelledby="all-tab">
            <div class="divide-y divide-gray-200">
                @forelse($complaint as $data)
                <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="block">
                    <div class="sm:bg-white py-6 px-8 hover:bg-gray-50">
                        <div class="flex sm:flex justify-between items-center space-x-2">
                            <div class="flex md:flex-row items-center justify-start space-x-2">
                                <p class="text-sm font-semibold text-gray-600">Prodi</p>
                            </div>
                            <div class="inline-flex space-x-2">
                                <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex space-x-2">
                                <h2 class="font-semibold text-gray-800 text-base">{{ $data->subject }}</h2>
                                <span class="{{ $data->category->bg }} text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2">
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
                <p class="p-8">Tidak ada data</p>
                @endforelse
            </div>
        </div>
        <div class="border-t" id="wait" role="tabpanel" aria-labelledby="wait-tab">
            <div class="divide-y divide-gray-400">
                @forelse($wait as $data)
                <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="block">
                    <div class="sm:bg-white py-6 px-8 hover:bg-gray-50">
                        <div class="flex sm:flex justify-between items-center space-x-2">
                            <div class="flex md:flex-row items-center justify-start space-x-2">
                                <p class="text-sm font-semibold text-gray-600">Prodi</p>
                            </div>
                            <div class="inline-flex space-x-2">
                                <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex space-x-2">
                                <h2 class="font-semibold text-gray-800 text-base">{{ $data->subject }}</h2>
                                <span class="{{ $data->category->bg }} text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2">
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
                <div class="bg-white border rounded p-4">
                    <p>Tidak ada data</p>
                </div>
                @endforelse
            </div>
        </div>
        <div class="border-t" id="read" role="tabpanel" aria-labelledby="read-tab">
            <div class="divide-y divide-gray-200">
                @forelse($read as $data)
                <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="block">
                    <div class="sm:bg-white py-6 px-8 hover:bg-gray-50">
                        <div class="flex sm:flex justify-between items-center space-x-2">
                            <div class="flex md:flex-row items-center justify-start space-x-2">
                                <p class="text-sm font-semibold text-gray-600">Prodi</p>
                            </div>
                            <div class="inline-flex space-x-2">
                                <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex space-x-2">
                                <h2 class="font-semibold text-gray-800 text-base">{{ $data->subject }}</h2>
                                <span class="{{ $data->category->bg }} text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2">
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
                <p class="p-8">Tidak ada data</p>
                @endforelse
            </div>
        </div>
        <div class="border-t" id="process" role="tabpanel" aria-labelledby="process-tab">
            <div class="divide-y divide-gray-200">
                @forelse($process as $data)
                <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="block">
                    <div class="sm:bg-white py-6 px-8 hover:bg-gray-50">
                        <div class="flex sm:flex justify-between items-center space-x-2">
                            <div class="flex md:flex-row items-center justify-start space-x-2">
                                <p class="text-sm font-semibold text-gray-600">Prodi</p>
                            </div>
                            <div class="inline-flex space-x-2">
                                <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex space-x-2">
                                <h2 class="font-semibold text-gray-800 text-base">{{ $data->subject }}</h2>
                                <span class="{{ $data->category->bg }} text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2">
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
                <p class="p-8">Tidak ada data</p>
                @endforelse
            </div>
        </div>
        <div class="border-t" id="done" role="tabpanel" aria-labelledby="done-tab">
            <div class="divide-y divide-gray-200">
                @forelse($process as $data)
                <a href="{{ route('mahasiswa.complaint.detail', $data->id) }}" class="block">
                    <div class="sm:bg-white py-6 px-8 hover:bg-gray-50">
                        <div class="flex sm:flex justify-between items-center space-x-2">
                            <div class="flex md:flex-row items-center justify-start space-x-2">
                                <p class="text-sm font-semibold text-gray-600">Prodi</p>
                            </div>
                            <div class="inline-flex space-x-2">
                                <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col">
                            <div class="flex space-x-2">
                                <h2 class="font-semibold text-gray-800 text-base">{{ $data->subject }}</h2>
                                <span class="{{ $data->category->bg }} text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2">
                                    <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                                    {{ $data->category->name }}
                                </span>
                            </div>
                            <p class="text-sm mt-2 text-gray-500">
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
                <p class="p-8">Tidak ada data</p>
                @endforelse
            </div>
        </div>
        @endsection