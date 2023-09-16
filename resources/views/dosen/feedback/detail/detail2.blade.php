@extends('template.dosen.template')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp
<!-- breadcrumb -->
@section('breadcrumb')

<nav class="flex" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-3">
    <li class="inline-flex items-center">
      <a href="{{ route('lecturer.feedback.index', auth()->id()) }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 dark:text-gray-400 dark:hover:text-white">
        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
        Home
      </a>
    </li>
    <li aria-current="page" class="active">
      <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <span class="ml-1 text-sm font-semibold text-gray-900 md:ml-2 dark:text-gray-400">{{ $feedback->subject }}</span>
      </div>
    </li>
  </ol>
</nav>

@endsection

<div class="h-full bg-gray-100 rounded-lg p-2 w-full space-y-3">    
    <!-- layout -->
    <div class="flex flex-col justify-between space-y-2 h-full">
        <!-- tabs < sm -->
        <div id="myTab" data-tabs-toggle="#myTabContent" role="tablist" class="md:hidden flex bg-white rounded-lg border p-3">
            <button id="feedback-tab" data-tabs-target="#feedback" type="button" role="tab" aria-controls="feedback" aria-selected="true" class="grow text-center">Feedback</button>
            <button id="info-tab" data-tabs-target="#information" type="button" role="tab" aria-controls="information" aria-selected="false" class="grow text-center">Informasi</button>
        </div>
        <div class="flex w-full md:flex justify-between space-x-3 h-screen">
            <!-- chat box & replies  -->
            <div class="flex flex-col md:flex space-y-2 h-max grow min-h-screen" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                <!-- header -->
                <div class="bg-white rounded-lg border border-gray-200 space-y-2 p-6 h-fit overflow-y-auto">
                    <div class="flex justify-start space-x-2 border-b pb-2">
                        @if($feedback->anonymous == 0)
                            @if($feedback->user->profile_photo)
                                <img src="{{ Storage::url($feedback->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                            @else
                            @endif 
                            <h1 class="font-semibold text-base">{{ $feedback->user->name }}</h1>
                        @else
                            <h1 class="font-semibold text-base">Anonymous</h1>
                        @endif
                        <p class="text-sm text-gray-400">•</p>
                        <p class="text-sm text-gray-500">{{ $feedback->created_at->diffForHumans() }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700">{{ $feedback->subject }}</p>
                        <p class="text-gray-700">{{ $feedback->content }}</p>
                    </div>
                    <div class="flex flex-row w-full space-x-2">
                        @if($feedback->file)
                        <div class="bg-white rounded-lg border-2 px-2.5 py-2 grow hover:bg-gray-50">
                            <div class="flex space-x-2 items-center">
                                @if(Str::endsWith($feedback->file, '.pdf'))
                                <!-- icon -->
                                <span class="bg-gray-200 rounded-lg p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-black" fill="currentColor" viewBox="0 0 256 256"><path d="M216.49,79.52l-56-56A12,12,0,0,0,152,20H56A20,20,0,0,0,36,40V216a20,20,0,0,0,20,20H200a20,20,0,0,0,20-20V88A12,12,0,0,0,216.49,79.52ZM160,57l23,23H160ZM60,212V44h76V92a12,12,0,0,0,12,12h48V212Z"></path></svg>
                                </span>
                                <div>
                                    <!-- file name -->
                                    <a href="{{ Storage::url($feedback->file) }}" class="text-sm">{{ \Illuminate\Support\Str::afterLast($feedback->file, '/') }}</a>
                                    
                                </div>
                                @elseif(Str::endsWith($feedback->file, ['.jpg', '.jpeg', '.png', '.gif']))
                                <img src="{{ Storage::url($feedback->file) }}" class="h-96 rounded-lg" alt="">
                                @endif
                            </div>
                        </div>
                        @else
                        @endif
                    </div>
                </div>
            
                <!-- replies -->
                <div class="flex flex-col rounded-lg p-2 space-y-3 overflow-y-auto grow max-h-fit md:h-96">
                    @foreach($feedback->reply as $reply)
                        @if($reply->user)
                        <div class="bg-white border rounded-lg p-4 text-gray-800 space-y-2">
                            <div class="flex justify-between border-b py-2">
                                <div class="inline-flex space-x-2">
                                    @if($feedback->anonymous == 0)
                                        @if($feedback->user->profile_photo)
                                        <img src="{{ Storage::url($feedback->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                        @else
                                        @endif
                                    <p class="font-semibold">{{ $feedback->user->name }}</p>
                                    @else
                                    <p class="font-semibold">Anonymous</p>
                                    @endif
                                </div>
                                <p class="font-base text-gray-100 text-sm">{{ $reply->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex flex-col space-y-2">
                            <p>{{ $reply->reply }}</p>
                            @if($reply->attachment)
                                @if (Str::endsWith($reply->attachment, '.pdf'))
                                <a href="{{ Storage::url($reply->file) }}" class="bg-white rounded-md border-2 px-2.5 py-2 grow hover:bg-gray-50">
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
                                @elseif (Str::endsWith($reply->attachment, ['.jpg', '.jpeg', '.png', '.gif']))
                                <img src="{{ Storage::url($reply->attachment) }}" class="bg-white border rounded-lg px-2.5 py-2">
                                @else
                                @endif
                            @else
                            @endif
                            </div>
                        </div>
                        @else
                        <div class="bg-white border-2 rounded-lg p-4 space-y-2">
                            <div class="flex justify-between border-b py-2">
                                <div class="inline-flex space-x-2">
                                    @if($feedback->class->lecturer->profile_photo)
                                        <img src="{{ Storage::url($feedback->class->lecturer->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                    @else
                                    @endif
                                    <p>{{ $feedback->class->lecturer->name }}</p>
                                </div>
                                <p class="font-base text-sm text-gray-100">{{ $reply->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex flex-col space-y-2">
                                <p class="font-base text-sm text-gray-700">{{ $reply->reply }}</p>
                                @if($reply->attachment)
                                    @if (Str::endsWith($reply->attachment, '.pdf'))
                                    <a href="{{ Storage::url($reply->attachment) }}" class="bg-white rounded-md border-2 px-2.5 py-2 grow hover:bg-gray-50">
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
                                    @elseif (Str::endsWith($reply->attachment, ['.jpg', '.jpeg', '.png', '.gif']))
                                    <img src="{{ Storage::url($reply->attachment) }}" class="bg-white border rounded-lg px-2.5 py-2">
                                    @else
                                    @endif
                                @endif  
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                <!-- chat box -->
                <form action="{{ route('lecturer.reply.l_send', $feedback->id) }}" method="POST" class="block" enctype="multipart/form-data">
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
                        @if($feedback->status == 'done')
                        @elseif($feedback->status != 'done')
                        <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 shadow-lg">
                            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                <label for="comment" class="sr-only">Your comment</label>
                                <textarea name="reply" id="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>
                            </div>
                            <input type="hidden" name="lecturer_id" value="{{ $feedback->class->lecturer->id }}">
                            <input type="hidden" name="feedback_id" value="{{ $feedback->id }}">
                            <div class="flex items-center justify-between px-3 py-2 border-t">
                                
                                <div class="flex pl-0 space-x-1 sm:pl-2">
                                    <input type="file" name="attachment" class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" id="file_input">
                                </div>
                                @if($feedback->status == 'done')
                                <button type="submit" class="inline-flex items-center space-x-2 py-2.5 px-4 text-xs font-medium text-center text-white bg-gray-300 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900" disabled>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 256 256"><path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path></svg>
                                    <p>Kirim</p>
                                </button>
                                @else
                                <button type="submit" class="inline-flex items-center space-x-2 py-2.5 px-4 text-xs font-medium text-center text-white bg-green-600 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 256 256"><path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path></svg>
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
                                <p>{{ $feedback->status }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Mahasiswa</p>
                            <div class="px-2 py-1 rounded-lg text-sm font-medium inline-flex items-center space-x-2">
                                @if($feedback->anonymous == 0)
                                <p>{{ $feedback->user->name }}</p>
                                @else
                                <img src="{{ asset('storage/image/Study.png') }}" class="rounded-full w-6 h-6" alt="">
                                <p>Anonymous</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-500">Mata Kuliah</p>
                            <p class="text-sm text-end whitespace-nowrap">{{ $feedback->class->course->name }}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-500">Kelas</p>
                            <p class="text-sm">{{ $feedback->class->name }}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-500">Dosen</p>
                            <div class="text-sm font-medium inline-flex items-center space-x-2">
                                <img src="{{ Storage::url($feedback->class->lecturer->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                <p class="text-sm font-medium">{{ $feedback->class->lecturer->name }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Kategori</p>
                            <div class="{{ $feedback->category->bg }} px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1">
                                <span>
                                    <img src="{{ Storage::url($feedback->category->label) }}" class="w-4 h-4" alt="">
                                </span>
                                <p class="text-red-600">{{ $feedback->category->name }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- timeline -->
                    <div class="mt-2 h-full overflow-y-auto">
                        <h1 class="text-gray-500 font-semibold">Timeline</h1>                  
                        <ol class="relative border-l border-gray-200 mt-3 ml-2">
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <div class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda menerima feedback</div>
                                <time class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{  date('D, d M Y, H:i', strtotime($feedback->created_at)) }}
                                </time>
                            </li>
                            @if($feedback->status == 'read')
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda membaca feedback</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($feedback->date)) }}
                                </p>
                            </li>
                            @elseif($feedback->status == 'done')
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Feedback ditutup</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($feedback->closed_date)) }}
                                </p>
                            </li>
                            @endif
                            @foreach($feedback->reply as $replies)
                            @if($replies->user)
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Mahasiswa membalas feedback</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                                </p>
                            </li>
                            
                            @elseif(!$replies->user)
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda membalas feedback</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                                </p>
                            </li>
                            @endif
                            @endforeach
                        </ol>
                    </div>
                    <!-- done -->
                </div>
            </div>

            <!-- information -->
            <div class="hidden md:flex">
                <div class="flex flex-col bg-white p-2 rounded-lg w-72">
                    <!-- header -->
                    <div class="flex flex-col space-y-3 w-full">
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Status</p>
                            @if($feedback->status == 'sent')
                            <div class="bg-gray-100 px-2 p-1 text-gray-700 rounded-md text-xs font-medium inline-flex space-x-1">
                                <p>Menunggu Respon</p>
                            </div>
                            @elseif($feedback->status == 'read')
                            <div class="bg-gray-100 px-2 p-1 text-gray-700 rounded-md text-xs font-medium inline-flex space-x-1">
                                <p>Dibaca</p>
                            </div>
                            @elseif($feedback->status == 'response')
                            <div class="bg-yellow-100 px-2 p-1 text-yellow-500 rounded-md text-xs font-medium inline-flex space-x-1">
                                <p>Dalam Proses</p>
                            </div>
                            @elseif($feedback->status == 'done')
                            <div class="bg-green-100 px-2 p-1 text-green-500 rounded-md text-xs font-medium inline-flex space-x-1">
                                <p>Selesai</p>
                            </div>
                            @endif
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Mahasiswa</p>
                            <div class="px-2 py-1 rounded-lg text-sm font-medium inline-flex items-center space-x-2">
                                @if($feedback->anonymous == 0)
                                <p class="whitespace-nowrap">{{ $feedback->user->name }}</p>
                                @else
                                <img src="{{ asset('storage/image/Study.png') }}" class="rounded-full w-6 h-6" alt="">
                                <p>Anonymous</p>
                                @endif
                            </div>
                        </div>
                        @if($feedback->anonymous == 0)
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Wali Dosen</p>
                            <p class="text-sm whitespace-nowrap">{{ $feedback->user->fclass->lecturer->name }}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Kelas Asal</p>
                            <p class="text-sm whitespace-nowrap">{{ $feedback->user->fclass->name }}</p>
                        </div>
                        @else
                        @endif
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Mata Kuliah</p>
                            <p class="text-sm whitespace-nowrap">{{ $feedback->class->course->name }}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-500">Kelas</p>
                            <p class="text-sm">{{ $feedback->class->name }}</p>
                        </div>
                        <div class="flex flex-col lg:flex-row justify-between">
                            <p class="text-sm text-gray-500">Dosen</p>
                            <div class="text-sm font-medium inline-flex items-center space-x-2">
                                @if($feedback->class->lecturer->profile_photo)
                                <img src="{{ Storage::url($feedback->class->lecturer->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                @else
                                @endif
                                <p class="text-sm font-medium">{{ $feedback->class->lecturer->name }}</p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Kategori</p>
                            <div class="{{ $feedback->category->bg }} px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1">
                                <span>
                                    <img src="{{ Storage::url($feedback->category->label) }}" class="w-4 h-4" alt="">
                                </span>
                                <p>{{ $feedback->category->name }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- timeline -->
                    <div class="mt-2 h-full overflow-y-auto">
                        <h1 class="text-gray-500 font-semibold">Timeline</h1>                  
                        <ol class="relative border-l border-gray-200 mt-3 ml-2">
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <div class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda menerima feedback</div>
                                <time class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{  date('D, d M Y, H:i', strtotime($feedback->created_at)) }}
                                </time>
                            </li>
                            @if($feedback->status == 'read')
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda membaca feedback</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($feedback->date)) }}
                                </p>
                            </li>
                            @elseif($feedback->status == 'done')
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Feedback ditutup</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($feedback->closed_date)) }}
                                </p>
                            </li>
                            @endif
                            @foreach($feedback->reply as $replies)
                            @if($replies->user)
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Mahasiswa membalas feedback</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                                </p>
                            </li>
                            
                            @elseif(!$replies->user)
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda membalas feedback</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                                </p>
                            </li>
                            @endif
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection