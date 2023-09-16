@extends('template.template')
@section('content')
<!-- <div class="flex flex-col space-y-2"> -->
    @forelse($groupedNotification as $date => $notifications)
    <p class="w-1/2 mx-auto pb-2 border-b font-medium mt-2">{{ $date }}</p>
    <div class="space-y-2">    
        @forelse($notifications as $notification)
            @if($notification->type === 'App\Notifications\SurveyNotification')
                @if(!$notification->data['survey_filled'])
                    @if($notification->read_at)
                    <!-- read -->
                    <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                        <div class="flex space-x-3 items-center">
                            <div>
                                @if($notification->data['img'])
                                <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                                @else
                                @endif
                            </div>
                            <div class="space-y-2">
                                <div class="">
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['lecturer'] }} </span>
                                    <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['course'] }}</span>
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['class'] }}</span>
                                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <!-- <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span> -->
                        </div>
                    </a>
                    @else
                    <!-- unread -->
                    <a href="{{ route('mahasiswa.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                        <div class="flex space-x-2 items-start">
                            <div>
                                <img src="{{ Storage::url($notification->data['img']) }}" class="w-4 h-4 rounded-full sm:rounded-full" alt="">
                            </div>
                            <div class="space-y-2">
                                <div class="">
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['lecturer'] }} </span>
                                    <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['course'] }}</span>
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['class'] }}</span>
                                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                        </div>
                    </a>
                    @endif
                @elseif($notification->data['survey_filled'])
                    <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                        <div class="flex space-x-2 items-start">
                            <div>
                                <img src="{{ Storage::url($notification->data['img']) }}" class="w-4 h-4 rounded-full sm:rounded-full" alt="">
                            </div>
                            <div class="space-y-2">
                                <div class="">
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['lecturer'] }} </span>
                                    <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['course'] }}</span>
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['class'] }}</span>
                                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <!-- <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span> -->
                        </div>
                    </a>
                @endif
            @elseif($notification->type === 'App\Notifications\LabSurveyNotification')
                @if(!$notification->data['survey_filled'])
                    @if($notification->read_at)
                    <a href="{{ route('mahasiswa.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                        <div class="flex space-x-2 items-start">
                            <div>
                                <img src="{{ Storage::url($notification->data['img']) }}" class="w-4 h-4 rounded-full sm:rounded-full" alt="">
                            </div>
                            <div class="space-y-2">
                                <div class="">
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['lecturer'] }} </span>
                                    <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['course'] }}</span>
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['class'] }}</span>
                                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                        </div>
                    </a>
                    @else
                    <a href="{{ route('mahasiswa.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                        <div class="flex space-x-2 items-start">
                            <div>
                                <img src="{{ Storage::url($notification->data['img']) }}" class="w-4 h-4 rounded-full sm:rounded-full" alt="">
                            </div>
                            <div class="space-y-2">
                                <div class="">
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['lecturer'] }} </span>
                                    <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['course'] }}</span>
                                    <span class="text-gray-700 font-semibold inline">{{ $notification->data['class'] }}</span>
                                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <!-- <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span> -->
                        </div>
                    </a>
                    @endif
                @elseif($notification->data['survey_filled'])
                <div class="flex flex-col bg-gray-100 border-2 rounded p-3 space-y-2">
                    <div class="inline-flex space-x-2">
                        <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                    </div>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>

                    <div class="flex">
                        <button class="bg-white border px-2 py-2.5 rounded text-gray-500" disabled>Surrvey anda sudah disi</button>
                    </div>
                </div>
                @endif
            @elseif($notification->type === 'App\Notifications\ReplyNotification')
                @if($notification->read_at)
                <!-- read -->
                <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        <div>
                            @if($notification->data['img'])
                            <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                            @else
                            @endif
                        </div>
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['lecturer'] }}</span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-medium inline">"{{ $notification->data['subject'] }}"</span>

                                <span class="text-gray-500">pada kelas</span>
                                <span class="text-gray-700 font-medium inline">{{ $notification->data['course'] }}</span>
                                <span class="text-gray-700 font-medium inline">{{ $notification->data['class'] }}</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <!-- <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span> -->
                    </div>
                </a>
                <!-- unread -->
                @else
                <a href="{{ route('mahasiswa.notification.read', ['id' => $notification]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        <div>
                            @if($notification->data['img'])
                            <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                            @else
                            @endif
                        </div>
                        <div class="space-y-2">
                        <div class="">
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['lecturer'] }}</span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-medium inline">"{{ $notification->data['subject'] }}"</span>
                                <span class="text-gray-500">pada kelas</span>
                                <span class="text-gray-700 font-medium inline">{{ $notification->data['course'] }}</span>
                                <span class="text-gray-700 font-medium inline">{{ $notification->data['class'] }}</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                    </div>
                </a>
                @endif
            @elseif($notification->type === 'App\Notifications\ReplyLabNotification')
                @if($notification->read_at)
                <!-- read -->
                <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        <div>
                            @if($notification->data['img'])
                            <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                            @else
                            @endif
                        </div>
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }}</span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-medium inline">"{{ $notification->data['subject'] }}"</span>

                                <span class="text-gray-500">pada kelas</span>
                                <span class="text-gray-700 font-medium inline">{{ $notification->data['course'] }}</span>
                                <span class="text-gray-700 font-medium inline">{{ $notification->data['class'] }}</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <!-- <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span> -->
                    </div>
                </a>
                <!-- unread -->
                @else
                <a href="{{ route('mahasiswa.notification.read', ['id' => $notification]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        <div>
                            @if($notification->data['img'])
                            <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                            @else
                            @endif
                        </div>
                        <div class="space-y-2">
                        <div class="">
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }}</span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-medium inline">"{{ $notification->data['subject'] }}"</span>
                                <span class="text-gray-500">pada kelas</span>
                                <span class="text-gray-700 font-medium inline">{{ $notification->data['course'] }}</span>
                                <span class="text-gray-700 font-medium inline">{{ $notification->data['class'] }}</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                    </div>
                </a>
                @endif
            @elseif($notification->type === 'App\Notifications\AdminReplyNotification')
                @if($notification->read_at)
                <!-- read -->
                <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        <div>
                            <img src="{{ asset('storage/image/logo-si.png') }}" class="rounded-full w-6 h-6" alt="">
                        </div>
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-medium inline">"{{ $notification->data['subject'] }}"</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <!-- <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span> -->
                    </div>
                </a>
                @else
                <!-- unread -->
                <a href="{{ route('mahasiswa.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        <div>
                            <img src="{{ asset('storage/image/logo-si.png') }}" class="rounded-full w-6 h-6" alt="">
                        </div>
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-medium inline">"{{ $notification->data['subject'] }}"</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                    </div>
                </a>
                @endif
            @endif
        @empty
        <p>Kosong</p>
        @endforelse
        </div>
    @empty
    <p>Kosong</p>
    @endforelse
@endsection