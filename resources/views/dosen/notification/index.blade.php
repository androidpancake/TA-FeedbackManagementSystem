@extends('template.dosen.template')
@section('content')
<div class="flex flex-col space-y-2">
@forelse($groupedNotification as $date => $notifications)
<p class="w-1/2 mx-auto pb-2 border-b font-medium">{{ $date }}</p>    
    @forelse($notifications as $notification)
        @if($notification->type === 'App\Notifications\SurveyNotification')
            @if($notification->read_at)
                <div class="flex flex-col bg-gray-100 border-2 rounded p-3 space-y-2">
                    <div class="inline-flex space-x-2">
                        <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                    </div>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>

                    <div class="flex">
                        <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat survey</a>
                    </div>
                </div>
            @else
                <div class="flex flex-col bg-white border-2 rounded p-3 space-y-2">
                    <div class="inline-flex space-x-2">
                        <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                    </div>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        
                    <div class="flex">
                        <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat survey</a>
                    </div>
                </div>
            @endif
        @elseif($notification->type === 'App\Notifications\LecturerReplyNotification')
            @if($notification->data['anonymous'] === 'Anonymous')
                @if($notification->read_at)
                <!-- read -->
                <a href="{{ route('lecturer.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        <div class="flex justify-center items-center w-8 h-8 bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 w-4 h-4" fill="currentColor" viewBox="0 0 256 256"><path d="M234.38,210a123.36,123.36,0,0,0-60.78-53.23,76,76,0,1,0-91.2,0A123.36,123.36,0,0,0,21.62,210a12,12,0,1,0,20.77,12c18.12-31.32,50.12-50,85.61-50s67.49,18.69,85.61,50a12,12,0,0,0,20.77-12ZM76,96a52,52,0,1,1,52,52A52.06,52.06,0,0,1,76,96Z"></path></svg>
                        </div>
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-700 font-semibold inline">Anonymous</span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                                <span class="text-gray-500 font-base inline">pada kelas</span>
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['course'] }}</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <!-- <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span> -->
                    </div>
                </a>
                @else
                <!-- unread -->
                <a href="{{ route('lecturer.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        <div class="flex justify-center items-center w-8 h-8 bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 w-4 h-4" fill="currentColor" viewBox="0 0 256 256"><path d="M234.38,210a123.36,123.36,0,0,0-60.78-53.23,76,76,0,1,0-91.2,0A123.36,123.36,0,0,0,21.62,210a12,12,0,1,0,20.77,12c18.12-31.32,50.12-50,85.61-50s67.49,18.69,85.61,50a12,12,0,0,0,20.77-12ZM76,96a52,52,0,1,1,52,52A52.06,52.06,0,0,1,76,96Z"></path></svg>
                        </div>
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-700 font-semibold inline">Anonymous</span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                                <span class="text-gray-500 font-base inline">pada kelas</span>
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['course'] }}</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                    </div>
                </a>
                @endif
            @elseif($notification->data['anonymous'] === 'Not anonymous')
                @if($notification->read_at)
                <!-- read -->
                <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        @if($notification->data['img'])
                        <div>
                            <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                        </div>
                        @else
                        @endif
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }} </span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                                <span>pada kelas</span>
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
                <a href="{{ route('lecturer.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        @if($notification->data['img'])
                        <div>
                            <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                        </div>
                        @else
                        @endif
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }} </span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                                <p class="font-base text-gray-500 inline">pada kelas</p>
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['course'] }}</span>
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['class'] }}</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                    </div>
                </a>    
                @endif
            @endif
        @elseif($notification->type === 'App\Notifications\FeedbackNotification')
            @if($notification->data['anonymous'] === 'Anonymous')
                @if($notification->read_at)
                <!-- read -->
                <a href="{{ route('lecturer.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        @if($notification->data['img'])
                        <div class="flex justify-center items-center w-8 h-8 bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 w-4 h-4" fill="currentColor" viewBox="0 0 256 256"><path d="M234.38,210a123.36,123.36,0,0,0-60.78-53.23,76,76,0,1,0-91.2,0A123.36,123.36,0,0,0,21.62,210a12,12,0,1,0,20.77,12c18.12-31.32,50.12-50,85.61-50s67.49,18.69,85.61,50a12,12,0,0,0,20.77-12ZM76,96a52,52,0,1,1,52,52A52.06,52.06,0,0,1,76,96Z"></path></svg>
                        </div>
                        @else
                        @endif
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-500 font-base inline">dari</span>
                                <span class="text-gray-700 font-semibold inline">Anonymous</span>
                                <span class="text-gray-500 font-base inline">tentang</span>
                                <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                                <p class="font-base text-gray-500 inline">pada kelas</p>
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
                <a href="{{ route('lecturer.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        @if($notification->data['img'])
                        <div class="flex justify-center items-center w-8 h-8 bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 w-4 h-4" fill="currentColor" viewBox="0 0 256 256"><path d="M234.38,210a123.36,123.36,0,0,0-60.78-53.23,76,76,0,1,0-91.2,0A123.36,123.36,0,0,0,21.62,210a12,12,0,1,0,20.77,12c18.12-31.32,50.12-50,85.61-50s67.49,18.69,85.61,50a12,12,0,0,0,20.77-12ZM76,96a52,52,0,1,1,52,52A52.06,52.06,0,0,1,76,96Z"></path></svg>
                        </div>
                        @else
                        @endif
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-500 font-base inline">dari</span>
                                <span class="text-gray-700 font-semibold inline">Anonymous</span>
                                <span class="text-gray-500 font-base inline">tentang</span>
                                <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                                <p class="font-base text-gray-500 inline">pada kelas</p>
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['course'] }}</span>
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['class'] }}</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                    </div>
                </a>
                @endif
            @elseif($notification->data['anonymous'] === 'Not anonymous')
                @if($notification->read_at)
                <!-- read -->
                <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        @if($notification->data['img'])
                        <div>
                            <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                        </div>
                        @else
                        @endif
                        <div class="space-y-2">
                        <div class="">
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }}</span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                                <span class="text-gray-500 font-base">pada kelas</span>
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
                <a href="{{ route('lecturer.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        @if($notification->data['img'])
                        <div>
                            <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                        </div>
                        @else

                        @endif
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }}</span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                                <span class="text-gray-500 font-base">pada kelas</span>
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['course'] }}</span>
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['class'] }}</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                    </div>
                </a>
                @endif
            @endif
        @elseif($notification->type === 'App\Notifications\FeedbackDoneNotification')
            @if($notification->data['anonymous'] === 'Anonymous')
                @if($notification->read_at)
                <!-- read -->
                <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        <div class="flex justify-center items-center w-8 h-8 bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 w-4 h-4" fill="currentColor" viewBox="0 0 256 256"><path d="M234.38,210a123.36,123.36,0,0,0-60.78-53.23,76,76,0,1,0-91.2,0A123.36,123.36,0,0,0,21.62,210a12,12,0,1,0,20.77,12c18.12-31.32,50.12-50,85.61-50s67.49,18.69,85.61,50a12,12,0,0,0,20.77-12ZM76,96a52,52,0,1,1,52,52A52.06,52.06,0,0,1,76,96Z"></path></svg>
                        </div>
                        
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-700 font-semibold inline">Anonymous</span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                                <span class="text-gray-500 font-base">pada kelas</span>
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
                <a href="{{ route('lecturer.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        @if($notification->data['img'])
                        <div class="flex justify-center items-center w-8 h-8 bg-gray-100 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-400 w-4 h-4" fill="currentColor" viewBox="0 0 256 256"><path d="M234.38,210a123.36,123.36,0,0,0-60.78-53.23,76,76,0,1,0-91.2,0A123.36,123.36,0,0,0,21.62,210a12,12,0,1,0,20.77,12c18.12-31.32,50.12-50,85.61-50s67.49,18.69,85.61,50a12,12,0,0,0,20.77-12ZM76,96a52,52,0,1,1,52,52A52.06,52.06,0,0,1,76,96Z"></path></svg>
                        </div>
                        @else
                        @endif
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-700 font-semibold inline">Anonymous</span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                                <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                                <span class="text-gray-500 font-base">pada kelas</span>
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['course'] }}</span>
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['class'] }}</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                    </div>
                </a>
                @endif
            @elseif($notification->data['anonymous'] === 'Not anonymous')
                <!-- read -->
                @if($notification->read_at)
                <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        @if($notification->data['img'])
                        <div>
                            <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                        </div>
                        @else
                        @endif
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }}</span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }}</span>
                                <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                                <span>pada kelas</span>
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
                <a href="{{ route('lecturer.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                    <div class="flex space-x-3 items-center">
                        @if($notification->data['img'])
                        <div>
                            <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                        </div>
                        @else
                        @endif
                        <div class="space-y-2">
                            <div class="">
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }}</span>
                                <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }}</span>
                                <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                                <span>pada kelas</span>
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['course'] }}</span>
                                <span class="text-gray-700 font-semibold inline">{{ $notification->data['class'] }}</span>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                    </div>
                </a>
                @endif
            @endif
        @endif
    @empty
    <p>Kosong</p>
    @endforelse
@empty
<p>Kosong</p>
@endforelse
</div>
@endsection