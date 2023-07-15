<!-- @if(isset($replies->attachment) && !empty($replies->attachment))
                                @foreach(json_decode($replies->attachment, true) as $file)
                                    @php
                                        $path = $file['path'];
                                        $name = $file['name'];
                                        $extension = pathinfo($path, PATHINFO_EXTENSION);
                                    @endphp
                                    @if(in_array($extension, ['.jpg','.jpeg','.png','.gif']))
                                        <img src="{{ Storage::url($path) }}" class="rounded-lg" alt="gambar">
                                    @elseif(in_array($extension, ['.pdf']))
                                        <a href="{{ Storage::url($path) }}" target="_blank" class="w-1 h-8 bg-green-50 border p-2" alt="file">
                                            {{ pathinfo($name, PATHINFO_FILENAME) }}
                                        </a>
                                    @endif
                                @endforeach
                            @endif -->

                            <div id="information-sidebar" role="tabpanel" aria-labelledby="information-tab" class="fixed top-0 right-0 z-40 w-64 h-screen pt-8 transition-transform -translate-x-full">
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
                            <div class="flex justify-between items-center">
                                <p class="text-sm text-gray-500">Kategori</p>
                                <div class="bg-red-100 px-2 py-1 rounded-lg text-sm font-medium inline-flex space-x-1 border border-red-400">
                                    <p class="text-red-600">{{ $feedback->category->name }}</p>
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