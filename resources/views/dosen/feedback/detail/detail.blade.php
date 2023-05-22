@extends('template.dosen.template')

@section('content')
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
    <!-- replies -->
    <div class="hidden h-screen sm:h-screen flex flex-col justify-between w-full py-2" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
        <div class="mt-4 space-y-2 overflow-y-auto">
            <div class="w-full bg-blue-500 rounded-lg border">
                <div class="p-4">
                    <div class="flex space-x-2 items-center border-b pb-3">
                        <img src="../../../icons/Teacher.png" alt="" class="rounded-full">
                        <p>{{ $feedback->id }}</p>
                        @if($feedback->anonymous == 0)
                        <h1 class="text-white font-semibold">{{ $feedback->user->name }}</h1>
                        @else
                        <h1 class="text-white font-semibold">Anonymous</h1>
                        @endif
                        <p class="text-white">•</p>
                        <p class="text-sm text-white font-medium">{{ $feedback->date }}</p>
                    </div>
                    <div class="mt-4 space-y-1">
                        <h1 class="font-bold text-white">{{ $feedback->subject }}</h1>
                        <p class="text-white text-sm">{{ $feedback->content }}</p>
                    </div>
                </div>
            </div>
            @foreach($feedback->reply as $replies)
            @if(!$replies->user)
            <div class="flex justify-end">
                <div class="w-96 md:w-96 bg-white rounded-lg border">
                    <div class="p-4">
                        <div class="flex space-x-2 items-center border-b border-green-300 pb-3">
                            <img src="../../../icons/Teacher.png" alt="" class="rounded-full">
                            <h1 class="text-gray-500 font-semibold">{{ $feedback->class->lecturer->name }}</h1>
                            <p>•</p>
                            <p class="text-sm text-gray-500 font-medium">{{ $replies->created_at }}</p>
                        </div>
                        <div class="mt-4 space-y-1">
                            <p class="text-gray-600 text-sm">{{ $replies->reply }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="flex justify-start">
                <div class="w-96 md:w-1/2 bg-green-50 rounded-lg border">
                    <div class="p-4">
                        <div class="flex space-x-2 items-center border-b border-green-300 pb-3">
                            <img src="../../../icons/Teacher.png" alt="" class="rounded-full">
                            <h1 class="text-gray-500 font-semibold">{{ $replies->user->name }}</h1>
                            <p>•</p>
                            <p class="text-sm text-gray-500 font-medium">{{ $replies->created_at }}</p>
                        </div>
                        <div class="mt-4 space-y-1">
                            <p class="text-gray-600 text-sm">{{ $replies->reply }}</p>
                        </div>
                    </div>
                </div>
            </div>            
            @endif
            
            @endforeach
        </div>
        <form action="{{ route('lecturer.reply.l_send', $feedback->id) }}" method="POST" class="block">
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
                <div class="w-full mb-4 border border-gray-200 rounded-lg bg-gray-50 shadow-lg">
                    <div class="px-4 py-2 bg-white rounded-t-lg dark:bg-gray-800">
                        <label for="comment" class="sr-only">Your comment</label>
                        <textarea name="reply" id="comment" rows="4" class="w-full px-0 text-sm text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400" placeholder="Write a comment..." required></textarea>
                    </div>
                    <input type="hidden" name="lecturer_id" value="{{ $feedback->class->lecturer->id }}">
                    <input type="hidden" name="feedback_id" value="{{ $feedback->id }}">
                    <div class="flex items-center justify-between px-3 py-2 border-t">
                        
                        <div class="flex pl-0 space-x-1 sm:pl-2">
                            <input class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none" id="file_input" type="file">
                        </div>
                        <button type="submit" class="inline-flex items-center space-x-2 py-2.5 px-4 text-xs font-medium text-center text-white bg-green-600 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 256 256"><path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path></svg>
                            <p>Kirim</p>
                        </button>
                    </div>
                </div>
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
                                    <span>
                                        <img src="../../../icons/Lab.png" class="w-4 h-4" alt="">
                                    </span>
                                    <p>{{ $feedback->status }}</p>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <p class="text-sm text-gray-500">Mahasiswa</p>
                                <div class="px-2 py-1 rounded-lg text-sm font-medium inline-flex items-center space-x-2">
                                    <img src="../../../images/S__14942228.jpg" class="rounded-full w-6 h-6" alt="">
                                    <p>{{ $feedback->user->name }}</p>
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
                            <div class="flex justify-between items-center">
                                <p class="text-sm text-gray-500">Kategori</p>
                                <div class="bg-red-100 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1 border border-red-400">
                                    <span>
                                        <img src="../../../icons/Lab.png" class="w-4 h-4" alt="">
                                    </span>
                                    <p class="text-red-600">{{ $feedback->category->name }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- timeline -->
                <div class="mt-2 h-96 overflow-y-scroll">
                    <h1 class="text-gray-500 font-semibold">Timeline</h1>                  
                    <ol class="relative border-l border-gray-200 mt-3">
                        <li class="mb-10 ml-4">
                            <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                            <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda mengirim feedback</time>
                            <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                                10 Mei 2023 • 14:00
                            </p>
                        </li>
                    </ol>
                </div>
            </div>
            <!-- satisfied -->
            <div>
                <div class="border-t py-2 flex flex-col space-y-2">
                    <p class="text-center text-sm text-gray-600">Jika puas dengan respon dan tindakan dosen, klik untuk menyelesaikan proses umpan balik</p>
                    <form action="">
                        <button type="button" class="w-full inline-flex justify-center space-x-2 bg-white border hover:bg-gray-200 focus:ring-4 focus:ring-green-300 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>
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
                                <span>
                                    <img src="../../../icons/Lab.png" class="w-4 h-4" alt="">
                                </span>
                                <p>{{ $feedback->status }}</p>
                            </div>
                        </div>
                        <div class="flex flex-wrap lg:flex-row justify-between items-center">
                            <p class="text-sm text-gray-500">Mahasiswa</p>
                            <div class="text-sm font-medium inline-flex items-center space-x-2">
                                <img src="../../../images/S__14942228.jpg" class="rounded-full w-6 h-6" alt="">
                                <p>{{ $feedback->user->name }}</p>
                            </div>
                        </div>
                        <div class="flex flex-col lg:flex-row justify-between">
                            <p class="text-sm text-gray-500">Mata Kuliah</p>
                            <p class="text-sm font-medium text-end">{{ $feedback->class->course->name }}</p>
                        </div>
                        <div class="flex flex-col lg:flex-row justify-between">
                            <p class="text-sm text-gray-500">Kelas</p>
                            <p class="text-sm font-medium">{{ $feedback->class->name }}</p>
                        </div>
                        <div class="flex flex-col lg:flex-row justify-between">
                            <p class="text-sm text-gray-500">Dosen</p>
                            <p class="text-sm font-medium">{{ $feedback->class->lecturer->name }}</p>
                        </div>
                        <div class="flex flex-wrap lg:flex-col justify-between items-center">
                            <p class="text-sm text-gray-500">Kategori</p>
                            <div class="bg-red-100 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1 border border-red-400">
                                <span>
                                    <img src="../../../icons/Lab.png" class="w-4 h-4" alt="">
                                </span>
                                <p class="text-red-600">{{ $feedback->category->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                <h1 class="text-gray-500 font-semibold">Timeline</h1>                  
                <ol class="relative border-l border-gray-200 mt-3">
                    <li class="mb-10 ml-4">
                        <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                        <time class="mb-1 text-sm font-semibold leading-none text-gray-800">Anda mengirim feedback</time>
                        <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                            10 Mei 2023 • 14:00
                        </p>
                    </li>
                </ol>
            </div>
        </div>
        <div>
            <div class="border-t py-2 flex flex-col space-y-2">
                <p class="text-center text-sm text-gray-600">Jika puas dengan respon dan tindakan dosen, klik untuk menyelesaikan proses umpan balik</p>
                <form action="">
                    <button type="button" class="w-full inline-flex justify-center space-x-2 bg-white border hover:bg-gray-200 focus:ring-4 focus:ring-green-300 font-medium rounded text-sm px-5 py-2.5 mr-2 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>
                        <p class="text-base disabled:text-gray-500">Selesai</p>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection