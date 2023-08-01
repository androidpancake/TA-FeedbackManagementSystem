@extends('template.templatedetail')

@section('content')
@php
use Illuminate\Support\Str;
@endphp
<!-- breadcrumb -->
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
                <span class="ml-1 text-sm font-base text-gray-600 md:ml-2 dark:text-gray-400">Detail Keluhan</span>
            </div>
        </li>
    </ol>
</nav>

@endsection

<div class="pt-16 bg-gray-100 px-2 w-full space-y-3">
    <!-- layout -->
    <div class="flex flex-col justify-between space-y-2 h-full">
        <!-- tabs < sm -->
        <div id="myTab" data-tabs-toggle="#myTabContent" role="tablist" class="md:hidden flex bg-white rounded-lg border p-3">
            <button id="complaint-tab" data-tabs-target="#complaint" type="button" role="tab" aria-controls="complaint" aria-selected="true" class="grow text-center">Keluhan</button>
            <button id="info-tab" data-tabs-target="#information" type="button" role="tab" aria-controls="information" aria-selected="false" class="grow text-center">Informasi</button>
        </div>
        <div class="flex w-full md:flex justify-between space-x-3 h-full">
            <!-- chat room -->
            <div class="flex flex-col md:flex space-y-2 h-max grow min-h-screen" id="complaint" role="tabpanel" aria-labelledby="complaint-tab">
                <!-- header -->
                <div class="flex flex-col h-72 rounded-lg overflow-y-auto space-y-3 grow max-h-fit md:h-96">
                    <div class="bg-white rounded-lg border-2 border-gray-200">
                        <div class="flex justify-start space-x-2 border-b p-4 items-center">
                            @if($complaint->user->profile_photo)
                            <img src="{{ Storage::url($complaint->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                            @else
                            @endif
                            <h1 class="text-base text-gray-700">{{ $complaint->user->name }}</h1>
                            <p class="text-sm text-gray-400">•</p>
                            <p class="text-sm text-gray-500">{{ $complaint->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="p-4">
                            <p class="font-semibold text-gray-700">{{ $complaint->subject }}</p>
                            <p class="text-gray-700">{{ $complaint->content }}</p>
                        </div>
                        @if($complaint->file)
                        @if (Str::endsWith($complaint->file, '.pdf'))
                        <div class="flex flex-row w-full space-x-2 px-4 pb-4">
                            <a href="{{ Storage::url($complaint->file) }}" class="bg-white rounded-lg border-2 px-2.5 py-2 grow hover:bg-gray-50">
                                <div class="flex space-x-2 items-center">
                                    <!-- icon -->
                                    <span class="bg-gray-200 rounded-md p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-black" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216.49,79.52l-56-56A12,12,0,0,0,152,20H56A20,20,0,0,0,36,40V216a20,20,0,0,0,20,20H200a20,20,0,0,0,20-20V88A12,12,0,0,0,216.49,79.52ZM160,57l23,23H160ZM60,212V44h76V92a12,12,0,0,0,12,12h48V212Z"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <!-- file name -->
                                        <p class="text-sm">{{ basename($complaint->file) }}</p>
                                        <!-- size -->
                                    </div>
                                </div>
                            </a>
                        </div>
                        @elseif (Str::endsWith($complaint->file, ['.jpg', '.jpeg', '.png', '.gif']))
                        <div class="flex flex-row w-full space-x-2 px-4 pb-4">
                            <img src="{{ Storage::url($complaint->file) }}" class="w-1/2 bg-white border rounded-lg px-2.5 py-2">
                        </div>
                        @endif
                        @else
                        @endif
                    </div>
                    @foreach($complaint->complaint_reply as $reply)
                    @if($reply->user)
                    <!-- replies -->
                    <div class="bg-white border-2 rounded-lg">
                        <div class="flex justify-start items-center border-b p-4 space-x-2">
                            <div class="inline-flex space-x-2">
                                @if($reply->user->profile_photo)
                                <img src="{{ Storage::url($reply->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                @else
                                @endif
                                <p>{{ $reply->user->name }}</p>
                            </div>
                            <p class="text-sm text-gray-400">•</p>
                            <p class="font-base text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="p-4 space-y-2 flex flex-col">
                            <p class="font-base text-sm text-gray-700">{{ $reply->reply }}</p>
                            @if($reply->attachment)
                            @if (Str::endsWith($reply->attachment, '.pdf'))
                            <a href="{{ Storage::url($complaint->file) }}" class="bg-white rounded-lg border-2 px-2.5 py-2 grow hover:bg-gray-50">
                                <div class="flex space-x-2 items-center">
                                    <!-- icon -->
                                    <span class="bg-gray-200 rounded-md p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-black" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216.49,79.52l-56-56A12,12,0,0,0,152,20H56A20,20,0,0,0,36,40V216a20,20,0,0,0,20,20H200a20,20,0,0,0,20-20V88A12,12,0,0,0,216.49,79.52ZM160,57l23,23H160ZM60,212V44h76V92a12,12,0,0,0,12,12h48V212Z"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <!-- file name -->
                                        <p class="text-sm">{{ basename($reply->attachment) }}</p>
                                        <!-- size -->
                                    </div>
                                </div>
                            </a>
                            <!-- <a href="{{ Storage::url($reply->attachment) }}" class="text-sm bg-white border-2 rounded-lg px-2.5 py-2">{{ basename($reply->attachment) }}</a> -->
                            @elseif (Str::endsWith($reply->attachment, ['.jpg', '.jpeg', '.png', '.gif']))
                            <img src="{{ Storage::url($reply->attachment) }}" class="w-1/2 bg-white border rounded-lg px-2.5 py-2">
                            @else
                            @endif
                            @else
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="bg-white border-2 rounded-lg">
                        <div class="flex justify-start items-center border-b p-4 space-x-2">
                            <div class="inline-flex space-x-2">
                                @if($reply->admin->profile_photo)
                                <img src="{{ Storage::url($reply->admin->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                @else
                                @endif
                                <p>{{ $reply->admin->name }}</p>
                            </div>
                            <p class="text-sm text-gray-400">•</p>
                            <p class="font-base text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="p-4 space-y-2 flex flex-col">
                            <p class="font-base text-sm text-gray-700">{{ $reply->reply }}</p>
                            @if($reply->attachment)
                            @if (Str::endsWith($reply->attachment, '.pdf'))
                            <a href="{{ Storage::url($complaint->file) }}" class="bg-white rounded-md border-2 px-2.5 py-2 grow hover:bg-gray-50">
                                <div class="flex space-x-2 items-center">
                                    <!-- icon -->
                                    <span class="bg-gray-200 rounded-md p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-black" fill="currentColor" viewBox="0 0 256 256">
                                            <path d="M216.49,79.52l-56-56A12,12,0,0,0,152,20H56A20,20,0,0,0,36,40V216a20,20,0,0,0,20,20H200a20,20,0,0,0,20-20V88A12,12,0,0,0,216.49,79.52ZM160,57l23,23H160ZM60,212V44h76V92a12,12,0,0,0,12,12h48V212Z"></path>
                                        </svg>
                                    </span>
                                    <div>
                                        <!-- file name -->
                                        <p class="text-sm">{{ basename($reply->attachment) }}</p>
                                        <!-- size -->
                                    </div>
                                </div>
                            </a>
                            <!-- <a href="{{ Storage::url($reply->attachment) }}" class="text-sm bg-white border-2 rounded-lg px-2.5 py-2">{{ basename($reply->attachment) }}</a> -->
                            @elseif (Str::endsWith($reply->attachment, ['.jpg', '.jpeg', '.png', '.gif']))
                            <img src="{{ Storage::url($reply->attachment) }}" class="w-1/2 bg-white border rounded-lg px-2.5 py-2">
                            @else
                            @endif
                            @else
                            @endif
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <!-- replies -->
                <!-- <div class="flex flex-col h-72 bg-white border-2 border-gray-200 rounded-lg p-2 space-y-3 overflow-y-auto grow max-h-fit md:h-96">
                    @foreach($complaint->complaint_reply as $reply)
                    @if($reply->user)
                    <div class="bg-white border-2 rounded-lg p-4 text-gray-800 space-y-2">
                        <div class="flex justify-between border-b py-2">
                            <div class="inline-flex space-x-2">
                                @if($reply->user->profile_photo)
                                <img src="{{ Storage::url($complaint->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                @else
                                @endif
                                <p class="font-semibold">{{ $complaint->user->name }}</p>
                            </div>
                            <p class="font-base text-gray-100 text-sm">{{ $reply->created_at->diffForHumans() }}</p>
                        </div>
                        <p>{{ $reply->reply }}</p>
                        @if($reply->attachment)
                        @if (Str::endsWith($reply->attachment, '.pdf'))
                        <a href="{{ Storage::url($reply->attachment) }}" class="bg-white border-2 rounded-lg px-2.5 py-2">{{ $reply->attachment }}</a>
                        @elseif (Str::endsWith($reply->attachment, ['.jpg', '.jpeg', '.png', '.gif']))
                        <img src="{{ Storage::url($reply->attachment) }}" class="bg-white border rounded-lg px-2.5 py-2">
                        @else
                        @endif
                        @else
                        @endif
                    </div>
                    @else
                    <div class="bg-white border rounded-lg p-4 space-y-2">
                        <div class="flex justify-between border-b py-2">
                            <div class="inline-flex space-x-2">
                                <img src="{{ Storage::url($reply->admin->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                <p>{{ $reply->admin->name }}</p>
                            </div>
                            <p class="font-base text-sm text-gray-100">{{ $reply->created_at->diffForHumans() }}</p>
                        </div>
                        <p class="font-base text-sm text-gray-700">{{ $reply->reply }}</p>
                        @if($reply->attachment)
                        @if (Str::endsWith($reply->attachment, '.pdf'))
                        <a href="{{ Storage::url($reply->attachment) }}" class="bg-white border-2 rounded-lg px-2.5 py-2">{{ $reply->attachment }}</a>
                        @elseif (Str::endsWith($reply->attachment, ['.jpg', '.jpeg', '.png', '.gif']))
                        <img src="{{ Storage::url($reply->attachment) }}" class="bg-white border rounded-lg px-2.5 py-2">
                        @else
                        @endif
                        @else
                        @endif
                    </div>
                    @endif
                    @endforeach
                </div> -->
                <!-- chat box -->
                <form action="{{ route('mahasiswa.complaint.m_send_complaint_reply', $complaint->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="flex">
                        @if ($errors->any())
                        <div class="bg-red py-2 px-3">
                            <div>
                                @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        @if($complaint->status != 'done')
                        <div class="border border-gray-200 rounded-lg grow bg-gray-50 shadow-lg">
                            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                <label for="comment" class="sr-only">Your comment</label>
                                <textarea name="reply" id="comment" rows="3" class="w-full px-0 text-sm text-gray-900 bg-white border-0 focus:ring-0" placeholder="Tulis balasan..." required></textarea>
                            </div>
                            <input type="hidden" name="user_id" value="{{ Auth()->id() }}">
                            <input type="hidden" name="complaint_id" value="{{ $complaint->id }}">
                            <div class="flex items-center justify-between px-3 py-2 border-t">

                                <div class="flex pl-0 space-x-1 sm:pl-2">
                                    <input id="file_input" type="file" name="attachment" class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none">
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
            <div id="information" role="tabpanel" aria-labelledby="info-tab" class="flex w-full md:hidden">
                <div class="flex flex-col w-full bg-white p-4">
                    <!-- header -->
                    <div class="flex flex-col space-y-2 w-full">
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Status</p>
                            <div class="bg-gray-200 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1">
                                <p>{{ $complaint->status }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Mahasiswa</p>
                            <div class="px-2 py-1 rounded-lg text-sm font-medium inline-flex items-center space-x-2">
                                @if($complaint->anonymous == 0)
                                <img src="{{ Storage::url($complaint->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                <p>{{ $complaint->user->name }}</p>
                                @else
                                <img src="{{ asset('storage/image/Study.png') }}" class="rounded-full w-6 h-6" alt="">
                                <p>Anonymous</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-500">Admin</p>
                            <div class="text-sm font-medium inline-flex items-center space-x-2">
                                <p class="text-sm font-medium">Prodi</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Kategori</p>
                            <div class="bg-red-100 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1 border border-red-400">
                                <span>
                                    <img src="{{ Storage::url($complaint->category->label) }}" class="w-4 h-4" alt="">
                                </span>
                                <p class="text-red-600">{{ $complaint->category->name }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- timeline -->
                    <div class="mt-2 h-full overflow-y-auto">
                        <h1 class="text-gray-500 font-semibold">Timeline</h1>
                        <ol class="relative border-l border-gray-200 mt-3 ml-2">
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <div class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda mengirim keluhan</div>
                                <time class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($complaint->created_at)) }}
                                </time>
                            </li>
                            @if($complaint->status == 'read')
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Admin membaca keluhan</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($complaint->date)) }}
                                </p>
                            </li>
                            @elseif($complaint->status == 'done')
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Keluhan ditutup</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($complaint->closed_date)) }}
                                </p>
                            </li>
                            @endif
                            @foreach($complaint->complaint_reply as $replies)
                            @if($replies->user)
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda membalas keluhan</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                                </p>
                            </li>

                            @elseif(!$replies->user)
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Admin membalas keluhan</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                                </p>
                            </li>
                            @endif
                            @endforeach

                        </ol>
                    </div>
                    <!-- done -->
                    <div class="border-t py-2 flex flex-col space-y-2">
                        <p class="text-center text-sm text-gray-600">Jika puas dengan respon dan tindakan Admin, klik untuk menyelesaikan proses umpan balik</p>
                        <form action="{{ route('mahasiswa.complaint.done', $complaint->id) }}" method="POST">
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

            <!-- information -->
            <div class="hidden md:flex">
                <div class="flex flex-col bg-white p-4 rounded-md w-72">
                    <!-- header -->
                    <div class="flex flex-col space-y-2 w-full">
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Status</p>
                            @if($complaint->status == 'sent')
                            <div class="bg-gray-100 px-2 p-1 text-gray-700 rounded-md text-xs font-medium inline-flex space-x-1">
                                <p>Menunggu Respon</p>
                            </div>
                            @elseif($complaint->status == 'read')
                            <div class="bg-gray-100 px-2 p-1 text-gray-700 rounded-md text-xs font-medium inline-flex space-x-1">
                                <p>Dibaca</p>
                            </div>
                            @elseif($complaint->status == 'response')
                            <div class="bg-yellow-100 px-2 p-1 text-yellow-500 rounded-md text-xs font-medium inline-flex space-x-1">
                                <p>Dalam Proses</p>
                            </div>
                            @elseif($complaint->status == 'done')
                            <div class="bg-green-100 px-2 p-1 text-green-500 rounded-md text-xs font-medium inline-flex space-x-1">
                                <p>Selesai</p>
                            </div>
                            @endif
                        </div>
                        <!-- <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500 text-right">Mahasiswa</p>
                            <div class="rounded-lg text-sm font-medium flex justify-between items-center space-x-2">
                                <img src="{{ Storage::url($complaint->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                <p>{{ $complaint->user->name }}</p>
                            </div>
                        </div> -->
                        <!-- <div class="flex justify-between">
                        <p class="text-sm text-gray-500">NIM</p>
                        <div class="text-sm font-medium inline-flex items-center space-x-2">
                            <p class="text-sm font-medium text-right">{{ $complaint->user->nim }}</p>
                        </div>
                    </div> -->
                        <!-- <div class="flex justify-between">
                            <p class="text-sm text-gray-500 whitespace-nowrap">Dosen Wali</p>
                            <div class="text-sm font-medium inline-flex items-center space-x-2">
                                <p class="text-sm font-medium text-right">{{ $complaint->user->homeroom }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-500">Kelas Asal</p>
                            <div class="text-sm font-medium inline-flex items-center space-x-2">
                                <p class="text-sm font-medium text-right">{{ $complaint->user->real_class }}</p>
                            </div>
                        </div> -->
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Kategori</p>
                            <div class="{{ $complaint->category->bg }} px-2 py-1 rounded-md text-sm font-medium inline-flex space-x-2">
                                <span>
                                    <img src="{{ Storage::url($complaint->category->label) }}" class="w-4 h-4" alt="">
                                </span>
                                <p class="text-xs">{{ $complaint->category->name }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- timeline -->
                    <div class="mt-2 h-full overflow-y-auto">
                        <p class="text-gray-500 text-sm">Timeline</p>
                        <ol class="relative border-l border-gray-200 mt-3 ml-2">
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <div class="mb-1 text-sm font-semibold leading-none text-gray-800">Keluhan telah dibuat</div>
                                <time class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($complaint->created_at)) }}
                                </time>
                            </li>
                            @if($complaint->status == 'read')
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Admin membaca keluhan</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($complaint->date)) }}
                                </p>
                            </li>
                            @endif
                            @foreach($complaint->complaint_reply as $replies)
                            @if($replies->user)
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Mahasiswa membalas keluhan</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                                </p>
                            </li>

                            @elseif(!$replies->user)
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Admin membalas keluhan</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                                </p>
                            </li>
                            @endif
                            @endforeach
                            @if($complaint->status == 'done')
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Keluhan ditutup</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($complaint->closed_date)) }}
                                </p>
                            </li>
                            @endif
                        </ol>
                    </div>
                    <!-- mark as done -->
                    @if($complaint->status != 'done')
                    <div class="border-t py-2 flex flex-col space-y-2">
                        <p class="text-sm text-gray-600">Jika puas dengan respon dan tindakan admin, klik untuk menyelesaikan proses umpan balik</p>
                        @csrf
                        <button data-modal-target="confirm" data-modal-toggle="confirm" type="submit" class="w-full inline-flex items-center justify-center space-x-2 bg-white border hover:bg-gray-100 hover:shadow-smfocus:ring-2 focus:ring-green-200 font-medium rounded px-5 py-2.5 mr-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M232.49,80.49l-128,128a12,12,0,0,1-17,0l-56-56a12,12,0,1,1,17-17L96,183,215.51,63.51a12,12,0,0,1,17,17Z"></path>
                            </svg>
                            <p class="text-sm text-base disabled:text-gray-500">Selesai</p>
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
                                        <p class="text-md font-semibold text-md text-gray-700">Konfirmasi Penyelesaian</p>
                                        <p class="text-sm pb-4 text-gray-500">Apakah Anda yakin ingin menandai keluhan ini sebagai selesai? Aksi ini akan memberitahu prodi bahwa Anda puas dengan respon dan tindakan yang telah diambil.</p>
                                        <div class="flex flex-row space-x-3">
                                            <button data-modal-hide="confirm" type="button" class="w-full text-center justify-center text-gray-500 bg-white hover:bg-gray-100 focus:ring-2 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                Batal
                                            </button>
                                            <form class="w-full" action="{{ route('mahasiswa.complaint.done', $complaint->id) }}" method="POST">
                                                @csrf
                                                <button data-modal-hide="confirm" type="submit" class="w-full h-full text-center justify-center text-white bg-green-500 hover:bg-green-800 focus:ring-2 focus:outline-none focus:ring-blue-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                    Konfirmasi
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        </form>
                    </div>
                    @else

                    @endif
                </div>
            </div>
            <!-- <div class="hidden md:flex">
                <div class="flex flex-col bg-white p-2 w-72">
                     header 
                    <div class="flex flex-col space-y-2 w-full">
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Status</p>
                            <div class="bg-gray-200 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1">
                                <p>{{ $complaint->status }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Mahasiswa</p>
                            <div class="px-2 py-1 rounded-lg text-sm font-medium inline-flex items-center space-x-2">
                                @if($complaint->user->profile_photo)
                                <img src="{{ Storage::url($complaint->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                @else
                                @endif
                                <p>{{ $complaint->user->name }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-500">Admin</p>
                            <div class="text-sm font-medium inline-flex items-center space-x-2">
                                <p class="text-sm font-medium">Prodi</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Kategori</p>
                            <div class="bg-red-100 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1 border border-red-400">
                                <span>
                                    <img src="{{ Storage::url($complaint->category->label) }}" class="w-4 h-4" alt="">
                                </span>
                                <p class="text-red-600">{{ $complaint->category->name }}</p>
                            </div>
                        </div>
                    </div>
                     timeline 
                    <div class="mt-2 h-full overflow-y-auto">
                        <h1 class="text-gray-500 font-semibold">Timeline</h1>
                        <ol class="relative border-l border-gray-200 mt-3 ml-2">
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <div class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda mengirim keluhan</div>
                                <time class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($complaint->created_at)) }}
                                </time>
                            </li>
                            @if($complaint->status == 'read')
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Admin membaca keluhan</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($complaint->date)) }}
                                </p>
                            </li>
                            @elseif($complaint->status == 'done')
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Keluhan ditutup</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($complaint->closed_date)) }}
                                </p>
                            </li>
                            @endif
                            @foreach($complaint->complaint_reply as $replies)
                            @if($replies->user)
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda membalas keluhan</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                                </p>
                            </li>

                            @elseif(!$replies->user)
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Admin membalas pengaduan</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                                </p>
                            </li>
                            @endif
                            @endforeach

                        </ol>
                    </div>
                     done 
                    <div class="border-t py-2 flex flex-col space-y-2">
                        <p class="text-center text-sm text-gray-600">Jika puas dengan respon dan tindakan Admin, klik untuk menyelesaikan proses umpan balik</p>
                        <form action="{{ route('mahasiswa.complaint.done', $complaint->id) }}" method="POST">
                            @csrf
                            @if($complaint->status == 'done')

                            @else
                            <button type="submit" class="w-full inline-flex justify-center space-x-2 bg-white border hover:bg-gray-200 focus:ring-4 focus:ring-green-300 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256">
                                    <path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path>
                                </svg>
                                <p class="text-base disabled:text-gray-500">Selesai</p>
                            </button>

                            @endif
                        </form>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
@endsection