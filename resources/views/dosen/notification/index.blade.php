@extends('template.dosen.template')
@section('content')
<div class="flex flex-col space-y-2">
    
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
            @if($notification->read_at)
                <div class="flex flex-col bg-gray-100 border-2 rounded p-3 space-y-2">
                    <div class="flex space-x-2 items-start">
                        <div>
                            @if($notification->data['img'])
                            <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                            @else
                            @endif
                        </div>
                        <div class="space-y-2">
                            <div>
                                <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex">
                                <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat feedback</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex flex-col bg-white border-2 rounded p-3 space-y-2">
                    <div class="flex space-x-2 items-start">
                        <div>
                            <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                        </div>
                        <div class="space-y-2">
                            <div>
                                <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                                <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="flex">
                                <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat feedback</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @elseif($notification->type === 'App\Notifications\FeedbackNotification')
            @if($notification->data['anonymous'] === 'Anonymous')
                @if($notification->read_at)
                    <a href="{{ $notification->data['url'] }}" class="flex flex-col bg-gray-100 border-2 rounded p-3 space-y-2">
                        <div class="flex space-x-2 items-start">
                            <div class="space-y-2">
                                <div>
                                    <div class="inline-flex space-x-1">
                                        <p class="text-gray-900 font-semibold">{{ $notification->data['message'] }} </p>
                                    </div>
                                    <p class="text-gray-900 text-base font-medium">{{ $notification->data['subject'] }} </p>
                                    <div class="inline-flex space-x-1">
                                        <p class="text-gray-900 text-sm font-medium">{{ $notification->data['course'] }} </p>
                                        <p class="text-gray-900 text-sm font-medium">{{ $notification->data['class'] }} </p>
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="{{ $notification->data['url'] }}" class="flex flex-col bg-white border-2 rounded p-3 space-y-2">
                        <div class="flex space-x-2 items-start">
                            <div class="space-y-2">
                                <div>
                                    <div class="inline-flex space-x-1">
                                        <p class="text-gray-900 font-semibold">{{ $notification->data['message'] }} </p>
                                    </div>
                                    <p class="text-gray-900 text-base font-medium">{{ $notification->data['subject'] }} </p>
                                    <div class="inline-flex space-x-1">
                                        <p class="text-gray-900 text-sm font-medium">{{ $notification->data['course'] }} </p>
                                        <p class="text-gray-900 text-sm font-medium">{{ $notification->data['class'] }} </p>
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @elseif($notification->data['anonymous'] === 'Not anonymous')
                @if($notification->read_at)
                    <a href="{{ $notification->data['url'] }}" class="flex flex-col bg-gray-100 border-2 rounded p-3 space-y-2">
                        <div class="flex space-x-2 items-start">
                            <div>
                                @if($notification->data['img'])
                                <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                                @else
                                @endif
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <div class="inline-flex space-x-1">
                                        <p class="text-gray-900 font-semibold">{{ $notification->data['message'] }} </p>
                                        <p class="text-gray-900 font-medium">{{ $notification->data['name'] }} </p>
                                    </div>
                                    
                                    <p class="text-gray-900 font-medium">{{ $notification->data['subject'] }} </p>
                                    <div class="inline-flex space-x-1">
                                        <p class="text-gray-900 text-sm font-medium">{{ $notification->data['course'] }} </p>
                                        <p class="text-gray-900 text-sm font-medium">{{ $notification->data['class'] }} </p>
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @else
                    <a href="{{ $notification->data['url'] }}" class="flex flex-col bg-white border-2 rounded p-3 space-y-2">
                        <div class="flex space-x-2 items-start">
                            <div>
                                <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <div class="inline-flex space-x-1">
                                        <p class="text-gray-900 font-semibold">{{ $notification->data['message'] }} </p>
                                        <p class="text-gray-900 font-medium">{{ $notification->data['name'] }} </p>
                                    </div>
                                    
                                    <p class="text-gray-900 font-medium">{{ $notification->data['subject'] }} </p>
                                    <div class="inline-flex space-x-1">
                                        <p class="text-gray-900 text-sm font-medium">{{ $notification->data['course'] }} </p>
                                        <p class="text-gray-900 text-sm font-medium">{{ $notification->data['class'] }} </p>
                                    </div>
                                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endif
        @endif
    @empty
    <p>Kosong</p>
    @endforelse
</div>
@endsection