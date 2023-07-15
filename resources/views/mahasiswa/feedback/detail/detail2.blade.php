@extends('template.template')

@section('content')
@php
    use Illuminate\Support\Str;
@endphp
<!-- breadcrumb -->
@section('breadcrumb')

<nav class="flex" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-3">
    <li class="inline-flex items-center">
      <a href="{{ route('mahasiswa.feedback.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 dark:text-gray-400 dark:hover:text-white">
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

<div class="h-full bg-white rounded-lg p-2 w-full space-y-3">    
    <!-- layout -->
    <div class="flex flex-col justify-between space-y-2 h-full">
        <!-- tabs < sm -->
        <div id="myTab" data-tabs-toggle="#myTabContent" role="tablist" class="md:hidden flex bg-white rounded-lg border p-3">
            <button id="feedback-tab" data-tabs-target="#feedback" type="button" role="tab" aria-controls="feedback" aria-selected="true" class="grow text-center">Feedback</button>
            <button id="info-tab" data-tabs-target="#information" type="button" role="tab" aria-controls="information" aria-selected="false" class="grow text-center">Informasi</button>
        </div>
        <div class="flex w-full md:flex justify-between space-x-3 h-full">
            <!-- chat room -->
            <div class="flex flex-col md:flex space-y-2 h-max grow min-h-screen" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                <!-- header -->
                <div class="bg-white rounded-lg border-2 border-gray-200 p-4">
                    <div class="flex justify-start space-x-2 items-center border-b pb-2">
                        @if($feedback->user->profile_photo)
                            <img src="{{ Storage::url($feedback->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                        @else

                        @endif
                        <h1 class="font-semibold text-base">{{ $feedback->user->name }}</h1>
                        <p class="text-sm text-gray-400">•</p>
                        <p class="text-sm text-gray-500">{{ $feedback->created_at->diffForHumans() }}</p>
                    </div>
                    <p class="font-semibold text-gray-700">{{ $feedback->subject }}</p>
                    <p class="text-gray-700">{{ $feedback->content }}</p>
                </div>
            
                <!-- replies -->
                <div class="flex flex-col h-72 bg-white border-2 border-gray-200 rounded-lg p-2 space-y-3 overflow-y-auto grow max-h-fit md:h-96">
                    @foreach($feedback->reply as $reply)
                        @if($reply->user)
                        <div class="bg-white border-2 rounded-lg p-4 text-gray-800 space-y-2">
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
                            <p>{{ $reply->reply }}</p>
                            @if($reply->attachment)
                            <a href="{{ Storage::url($reply->attachment) }}">{{ $reply->attachment }}</a>
                            @else
                            @endif
                        </div>
                        @else
                        <div class="bg-white border rounded-lg p-4 space-y-2">
                            <div class="flex justify-between border-b py-2">
                                <div class="inline-flex space-x-2">
                                    @if($feedback->class->lecturer)
                                        <img src="{{ Storage::url($feedback->class->lecturer->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                        <p>{{ $feedback->class->lecturer->name }}</p>
                                    @elseif($feedback->class->lab)
                                        <img src="{{ Storage::url($feedback->class->lab->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                        <p>{{ $feedback->class->lab->name }}</p>
                                    @endif
                                </div>
                                <p class="font-base text-sm text-gray-100">{{ $reply->created_at->diffForHumans() }}</p>
                            </div>
                            <p class="font-base text-sm text-gray-700">{{ $reply->reply }}</p>
                            @if($reply->attachment)
                            <a href="{{ Storage::url($reply->attachment) }}">{{ $reply->attachment }}</a>
                            @else
                            @endif
                        </div>
                        @endif
                    @endforeach
                </div>
                <!-- chat box -->
                <form action="{{ route('mahasiswa.reply.m_send', $feedback->id) }}" method="POST" enctype="multipart/form-data">
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
                        @if($feedback->status != 'done')
                        <div class="border border-gray-200 rounded-lg grow bg-gray-50 shadow-lg">
                            <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                                <label for="comment" class="sr-only">Your comment</label>
                                <textarea name="reply" id="comment" rows="3" class="w-full px-0 text-sm text-gray-900 bg-white border-0 focus:ring-0" placeholder="Write a comment..." required></textarea>
                            </div>
                            <input type="hidden" name="user_id" value="{{ $feedback->user->id }}">
                            <input type="hidden" name="feedback_id" value="{{ $feedback->id }}">
                            <div class="flex items-center justify-between px-3 py-2 border-t">
                                
                                <div class="flex pl-0 space-x-1 sm:pl-2">
                                    <input id="file_input" type="file" name="attachment" class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none">
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
                <div class="flex flex-col w-full bg-white p-4 rounded-lg">
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
                                <img src="{{ Storage::url($feedback->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                <p>{{ $feedback->user->name }}</p>
                                @else
                                <img src="{{ asset('storage/image/Study.png') }}" class="rounded-full w-6 h-6" alt="">
                                <p>Anonymous</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-500">Mata Kuliah</p>
                            <p class="text-sm">{{ $feedback->class->course->name }}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-500">Kelas</p>
                            <p class="text-sm">{{ $feedback->class->name }}</p>
                        </div>
                        <div class="flex justify-between">
                            @if($feedback->class->lecturer)
                            <p class="text-sm text-gray-500">Dosen</p>
                            <div class="text-sm font-medium inline-flex items-center space-x-2">
                                <img src="{{ Storage::url($feedback->class->lecturer->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                <p class="text-sm font-medium">{{ $feedback->class->lecturer->name }}</p>
                            </div>
                            @elseif($feedback->class->lab)
                            <p class="text-sm text-gray-500">Lab</p>
                            <div class="text-sm font-medium inline-flex items-center space-x-2">
                                <img src="{{ Storage::url($feedback->class->lab->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                <p class="text-sm font-medium">{{ $feedback->class->lab->name }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Kategori</p>
                            <div class="bg-red-100 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1 border border-red-400">
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
                                <div class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda mengirim feedback</div>
                                <time class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{  date('D, d M Y, H:i', strtotime($feedback->created_at)) }}
                                </time>
                            </li>
                            @if($feedback->status == 'read')
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Dosen membaca feedback</time>
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
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda membalas feedback</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                                </p>
                            </li>
                            
                            @elseif(!$replies->user)
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Dosen membalas feedback</time>
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
                        <p class="text-center text-sm text-gray-600">Jika puas dengan respon dan tindakan dosen, klik untuk menyelesaikan proses umpan balik</p>
                        <form action="{{ route('mahasiswa.feedback.done', $feedback->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            <button type="submit" class="w-full inline-flex justify-center space-x-2 bg-white border hover:bg-gray-200 focus:ring-4 focus:ring-green-300 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>
                                <p class="text-base disabled:text-gray-500">Selesai</p>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- information -->
            <div class="hidden md:flex rounded-lg">
                <div class="flex flex-col bg-white p-2 w-72 rounded">
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
                                <img src="{{ Storage::url($feedback->user->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                <p>{{ $feedback->user->name }}</p>
                                @else
                                <img src="{{ asset('storage/image/Study.png') }}" class="rounded-full w-6 h-6" alt="">
                                <p>Anonymous</p>
                                @endif
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Mata Kuliah</p>
                            <p class="text-sm">{{ $feedback->class->course->name }}</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-sm text-gray-500">Kelas</p>
                            <p class="text-sm">{{ $feedback->class->name }}</p>
                        </div>
                        <div class="flex flex-col lg:flex-row justify-between">
                            @if($feedback->class->lecturer)
                            <p class="text-sm text-gray-500">Dosen</p>
                            <div class="text-sm font-medium inline-flex items-center space-x-2">
                                <img src="{{ Storage::url($feedback->class->lecturer->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                <p class="text-sm font-medium">{{ $feedback->class->lecturer->name }}</p>
                            </div>
                            @elseif($feedback->class->lab)
                            <p class="text-sm text-gray-500">Lab</p>
                            <div class="text-sm font-medium inline-flex items-center space-x-2">
                                <img src="{{ Storage::url($feedback->class->lab->profile_photo) }}" class="rounded-full w-6 h-6" alt="">
                                <p class="text-sm font-medium">{{ $feedback->class->lab->name }}</p>
                            </div>
                            @endif
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Kategori</p>
                            <div class="bg-red-100 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1 border border-red-400">
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
                                <div class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda mengirim feedback</div>
                                <time class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{  date('D, d M Y, H:i', strtotime($feedback->created_at)) }}
                                </time>
                            </li>
                            @if($feedback->status == 'read')
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Dosen membaca feedback</time>
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
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda membalas feedback</time>
                                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                    {{ date('D, d M Y, H:i', strtotime($replies->created_at)) }}
                                </p>
                            </li>
                            
                            @elseif(!$replies->user)
                            <li class="mb-10 ml-4">
                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Dosen membalas feedback</time>
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
                        <p class="text-center text-sm text-gray-600">Jika puas dengan respon dan tindakan dosen, klik untuk menyelesaikan proses umpan balik</p>
                        <form action="{{ route('mahasiswa.feedback.done', $feedback->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            @if($feedback->status == 'done')
                                <button type="submit" class="w-full inline-flex justify-center space-x-2 bg-white border hover:bg-gray-200 focus:ring-4 focus:ring-green-300 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2" disabled>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>
                                    <p class="text-base disabled:text-gray-500">Selesai</p>
                                </button>
                            @else
                                <button type="submit" class="w-full inline-flex justify-center space-x-2 bg-white border hover:bg-gray-200 focus:ring-4 focus:ring-green-300 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>
                                    <p class="text-base disabled:text-gray-500">Selesai</p>
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection