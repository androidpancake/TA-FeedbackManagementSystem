@extends('template.template')

@section('content')
@php
use Illuminate\Support\Str;
@endphp
@section('breadcrumb')

<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('mahasiswa.complaint.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 dark:text-gray-400 dark:hover:text-white">
                <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                </svg>
                Home
            </a>
        </li>
        <li aria-current="page" class="active">
            <div class="flex items-center">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="ml-1 text-sm font-semibold text-gray-900 md:ml-2 dark:text-gray-400">{{ $complaint->subject }}</span>
            </div>
        </li>
    </ol>
</nav>

@endsection
<!-- tabs -->
<div class="sm:hidden bg-white text-sm font-medium text-center text-gray-500">
    <ul class="flex sticky-top sticky-top text-sm font-medium text-center bg-white" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">

        <li class="mr-2 grow">
            <button class="inline-block p-4 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="feedback-tab" data-tabs-target="#feedback" type="button" role="tab" aria-controls="feedback" aria-selected="true">Feedback</button>
        </li>

        <li class="mr-2 grow">
            <button class="inline-block p-4 rounded-t-lg" id="information-tab" data-tabs-target="#information" type="button" role="tab" aria-controls="information" aria-selected="false">Informasi</button>
        </li>
    </ul>
</div>
<div class="sm:flex justify-between space-x-3">
    <!-- header -->
    <div class="hidden h-screen sm:h-screen flex flex-col justify-between w-full py-2" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
        <div class="mt-4 space-y-2 overflow-y-auto">
            <div class="w-full bg-white rounded-lg border">
                <div class="p-4">
                    <div class="flex space-x-2 items-center border-b pb-3">
                        <img src="../../../icons/Teacher.png" alt="" class="rounded-full">
                        <p>{{ $complaint->id }}</p>
                        <p class="font-semibold">Prodi</p>
                        <p class="text-sm">•</p>
                        <p class="text-sm font-medium">{{ date('D, d M Y, H:i', strtotime($complaint->created_at)) }}</p>
                    </div>
                    <div class="mt-4 space-y-1">
                        <h1 class="font-bold">{{ $complaint->subject }}</h1>
                        <p class="text-sm">{{ $complaint->content }}</p>
                        <div class="pt-3">
                            @if(Str::contains($complaint->file, ['.jpg','.png','.jpeg']))
                            <img src="{{ Storage::url($complaint->file) }}" class="w-8 h-auto rounded-lg" alt="gambar">
                            @elseif(Str::contains($complaint->file, ['.pdf', '.txt']))
                            <a href="{{ Storage::url($complaint->file) }}" target="_blank" class="max-w-sm h-8 bg-gray-100 rounded-lg p-2" alt="file">
                                {{ $complaint->file }}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- replies -->
            @foreach($complaint->complaint_reply as $replies)
            @if($replies->user)
            <div class="flex justify-end">
                <div class="w-64 md:w-1/2 bg-white rounded-lg border">
                    <div class="p-4">
                        <div class="flex space-x-2 items-center border-b pb-3">
                            <img src="{{ Storage::url($complaint->user->profile_photo) }}" alt="" class="w-8 h-8 rounded-full">
                            <h1 class="text-gray-500 font-semibold">{{ $replies->user->name }}</h1>
                            <p>•</p>
                            <p class="text-sm text-gray-500 font-medium">{{ $replies->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="mt-4 space-y-1">
                            <p class="text-gray-600 text-sm">{{ $replies->reply }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($replies->admin)
            <div class="w-64 md:w-1/2 bg-green-100 rounded-lg border">
                <div class="p-4">
                    <div class="flex space-x-2 items-center border-b border-green-300 pb-3">
                        <img src="{{ Storage::url($replies->admin->profile_photo) }}" alt="" class="rounded-full">
                        <h1 class="text-gray-500 font-semibold">Prodi ({{ $replies->admin->name }})</h1>
                        <p>•</p>
                        <p class="text-sm text-gray-500 font-medium">{{ $replies->created_at }}</p>
                    </div>
                    <div class="mt-4 space-y-1">
                        <p class="text-gray-600 text-sm">{{ $replies->reply }}</p>
                    </div>
                </div>
            </div>
            @endif

            @endforeach
        </div>
        <form action="{{ route('mahasiswa.complaint.m_send_complaint_reply', $complaint->id) }}" method="POST" class="block">
            @csrf
            <div class="">
                @if ($errors->any())
                <div class="bg-red py-2 px-3">
                    <div>
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                @endif
                @if($complaint->status == 'done')

                @elseif($complaint->status != 'done')
                <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 shadow-lg">
                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                        <label for="comment" class="sr-only">Your comment</label>
                        <textarea name="reply" id="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>
                    </div>
                    <input type="hidden" name="user_id" value="{{ $complaint->user->id }}">
                    <input type="hidden" name="feedback_id" value="{{ $complaint->id }}">
                    <div class="flex items-center justify-between px-3 py-2 border-t">

                        <div class="flex pl-0 space-x-1 sm:pl-2">
                            <input class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none" id="file_input" type="file">
                        </div>
                        @if($complaint->status == 'done')
                        <button type="submit" class="inline-flex items-center space-x-2 py-2.5 px-4 text-xs font-medium text-center text-white bg-gray-300 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900" disabled>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path>
                            </svg>
                            <p>Kirim</p>
                        </button>
                        @else
                        <button type="submit" class="inline-flex items-center space-x-2 py-2.5 px-4 text-xs font-medium text-center text-white bg-green-600 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path>
                            </svg>
                            <p>Kirim</p>
                        </button>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </form>
    </div>

    <!-- information < sm -->
    <div id="information" role="tabpanel" aria-labelledby="information-tab" class="h-screen sm:hidden">
        <div class="flex flex-col">
            <!-- information -->
            <div>
                <!-- info feedback -->
                <div class="mt-4 border-b pb-3">
                    <div class="flex flex-col">
                        <div class="flex flex-col justify-center space-y-2">
                            <div class="flex justify-between items-center">
                                <p class="text-sm text-gray-500">Status</p>
                                <div class="bg-gray-200 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1">
                                    <p>{{ $complaint->status }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-sm text-gray-500">Mahasiswa</p>
                                <div class="px-2 py-1 rounded-lg text-sm font-medium inline-flex items-center space-x-2">
                                    <img src="{{ Storage::url($complaint->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                    <p>{{ $complaint->user->name }}</p>
                                </div>
                            </div>

                            <div class="flex justify-between items-center">
                                <p class="text-sm text-gray-500">Kategori</p>
                                <div class="bg-green-100 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1 border border-green-400">
                                    <span>
                                        <img src="{{ Storage::url($complaint->category->label) }}" class="w-4 h-4" alt="">
                                    </span>
                                    <p class="text-green-600">{{ $complaint->category->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- timeline -->
                <div class="mt-2 h-96 overflow-y-scroll">
                    <h1 class="text-gray-500 font-semibold">Timeline</h1>
                    <ol class="relative border-l border-gray-200 mt-3 ml-2">
                        <li class="mb-10 ml-4">
                            <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                            <div class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda mengirim pengaduan</div>
                            <time class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                {{ date('D, d M Y, H:i', strtotime($complaint->created_at)) }}
                            </time>
                        </li>
                        @if($complaint->status == 'read')
                        <li class="mb-10 ml-4">
                            <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                            <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Admin membaca pengaduan</time>
                            <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                {{ date('D, d M Y, H:i', strtotime($complaint->date)) }}
                            </p>
                        </li>
                        @endif
                        @forelse($complaint->complaint_reply as $replies)
                        @if($replies->user)
                        <li class="mb-10 ml-4">
                            <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                            <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda membalas pengaduan</time>
                            <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                            </p>
                        </li>

                        @elseif(!$replies->user)
                        <li class="mb-10 ml-4">
                            <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                            <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Admiin membalas pengaduan</time>
                            <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                            </p>
                        </li>
                        @endif
                        @if($complaint->status == 'done')
                        <li class="mb-10 ml-4">
                            <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                            <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Komplain ditutup</time>
                            <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                {{ date('D, d M Y, H:i', strtotime($complaint->date)) }}
                            </p>
                        </li>
                        @endif
                        @empty
                        @endforelse
                    </ol>
                </div>
            </div>
            <!-- satisfied -->
            <div>
                <div class="border-t py-2 flex flex-col space-y-2">
                    <p class="text-center text-sm text-gray-600">Jika puas dengan respon dan tindakan dosen, klik untuk menyelesaikan proses pengaduan</p>
                    <form action="">
                        <button type="button" class="w-full inline-flex justify-center space-x-2 bg-white border hover:bg-gray-200 focus:ring-4 focus:ring-green-300 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256">
                                <path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path>
                            </svg>
                            <p class="text-base disabled:text-gray-500">Selesai</p>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- information -->
    <div class="hidden sm:flex flex-col justify-between h-screen bg-white border-l space-y-2 p-4 top-0 right-0 w-96">
        <div>
            <div class="mt-4 border-b pb-3">
                <div class="flex flex-col">
                    <div class="flex flex-col justify-center space-y-2">
                        <div class="flex flex-wrap lg:flex-col justify-between items-center">
                            <p class="text-sm text-gray-500">Status</p>
                            <div class="bg-gray-200 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1">
                                <p>{{ $complaint->status }}</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap lg:flex-row justify-between items-center">
                            <p class="text-sm text-gray-500">Mahasiswa</p>
                            <div class="text-sm font-medium inline-flex items-center space-x-2">
                                <img src="{{ Storage::url($complaint->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                <p>{{ $complaint->user->name }}</p>
                            </div>
                        </div>


                        <div class="flex flex-col lg:flex-row justify-between">
                            <p class="text-sm text-gray-500">Prodi</p>
                            <p class="text-sm font-medium">Prodi</p>
                        </div>
                        <div class="flex flex-wrap lg:flex-col justify-between items-center">
                            <p class="text-sm text-gray-500">Kategori</p>
                            <div class="bg-red-100 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1 border border-red-400">
                                <span>
                                    <img src="{{ Storage::url($complaint->category->label) }}" class="w-4 h-4" alt="">
                                </span>
                                <p class="text-red-600">{{ $complaint->category->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <h1 class="text-gray-500 font-semibold">Timeline</h1>
                <div class="h-96 overflow-y-auto">
                    <ol class="relative border-l border-gray-200 mt-3 ml-3">
                        <li class="mb-10 ml-4">
                            <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                            <div class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda mengirim komplain</div>
                            <time class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                {{ date('D, d M Y, H:i', strtotime($complaint->created_at)) }}
                            </time>
                        </li>
                        @if($complaint->status == 'read')
                        <li class="mb-10 ml-4">
                            <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                            <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Admin membaca komplain</time>
                            <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                {{ date('D, d M Y, H:i', strtotime($complaint->date)) }}
                            </p>
                        </li>
                        @endif
                        @foreach($complaint->complaint_reply as $replies)
                        @if($replies->user)
                        <li class="mb-10 ml-4">
                            <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                            <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda membalas komplain</time>
                            <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                            </p>
                        </li>

                        @elseif($replies->admin)
                        <li class="mb-10 ml-4">
                            <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                            <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Admin membalas komplain</time>
                            <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                            </p>
                        </li>
                        @endif

                        @endforeach
                        @if($complaint->status == 'done')
                        <li class="mb-10 ml-4">
                            <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                            <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Komplain ditutup</time>
                            <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                {{ date('D, d M Y, H:i', strtotime($complaint->date)) }}
                            </p>
                        </li>
                        @endif
                    </ol>
                </div>
            </div>
        </div>
        <div>
            <div class="border-t py-2 flex flex-col space-y-2">
                <p class="text-center text-sm text-gray-600">Jika puas dengan respon dan tindakan admin, klik untuk menyelesaikan proses pengaduan</p>
                <form action="{{ route('mahasiswa.complaint.done', $complaint->id) }}" method="POST">
                    @csrf
                    @if($complaint->status == 'done')
                    <button data-modal-target="confirm" data-modal-toggle="confirm" data-modal-toggle="confirm" type="button" class="w-full inline-flex justify-center space-x-2 bg-white border hover:bg-gray-200 focus:ring-4 focus:ring-green-300 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256">
                            <path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path>
                        </svg>
                        <p class="text-base disabled:text-gray-500">Selesai</p>
                    </button>
                    <!-- modal -->
                    <div id="confirm" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="z-20 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="confirm">
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
                                            <button data-modal-hide="modalID{{ $data->id }}" type="button" class="w-full text-center justify-center text-gray-500 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                Batal
                                            </button>
                                            <button data-modal-hide="modalID{{ $data->id }}" type="submit" class="w-full text-center justify-center text-white bg-red-500 hover:bg-red-800 focus:ring-2 focus:outline-none focus:ring-blue-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                                Hapus Keluhan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <button data-modal-target="confirm" data-modal-toggle="confirm" type="submit" class="w-full inline-flex justify-center space-x-2 bg-white border hover:bg-gray-200 focus:ring-4 focus:ring-green-300 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256">
                            <path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path>
                        </svg>
                        <p class="text-base disabled:text-gray-500">Selesai</p>
                    </button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection