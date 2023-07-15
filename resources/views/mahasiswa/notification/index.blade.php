@extends('template.template')
@section('content')
<div class="flex flex-col space-y-2">
    
    @forelse($notifications as $notification)
        @if($notification->type === 'App\Notifications\SurveyNotification')
            @if(!$notification->data['survey_filled'])
                @if($notification->read_at)
                    <div class="flex flex-col bg-gray-100 border-2 rounded p-3 space-y-2">
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
                                    <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat survey</a>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                @else
                    <div class="flex flex-col bg-white border-2 rounded p-3 space-y-2">
                        <div class="flex space-x-2 items-start">
                            <div>
                                <img src="{{ Storage::url($notification->data['img']) }}" class="w-4 h-4 rounded-full sm:rounded-full" alt="">
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex">
                                    <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat survey</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
        @elseif($notification->type === 'App\Notifications\LabSurveyNotification')
            @if(!$notification->data['survey_filled'])
                @if($notification->read_at)
                    <div class="flex flex-col bg-gray-100 border-2 rounded p-3 space-y-2">
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
                                    <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat survey</a>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                @else
                    <div class="flex flex-col bg-white border-2 rounded p-3 space-y-2">
                        <div class="flex space-x-2 items-start">
                            <div>
                                <img src="{{ Storage::url($notification->data['img']) }}" class="w-4 h-4 rounded-full sm:rounded-full" alt="">
                            </div>
                            <div class="space-y-2">
                                <div>
                                    <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="flex">
                                    <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat survey</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                <div class="flex flex-col bg-gray-100 border-2 rounded p-3 space-y-2">
                    <div class="inline-flex space-x-2">
                        <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                    </div>
                    <p class="text-base text-gray-900">{{ $notification->data['reply'] }}</p>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    <div class="flex">
                        <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat Feedback</a>
                    </div>
                </div>
            @else
                <div class="flex flex-col bg-white border-2 rounded p-3 space-y-2">
                    <div class="inline-flex space-x-2">
                        <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                    </div>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    <p class="text-base text-gray-900">{{ $notification->data['reply'] }}</p>
                    <div class="flex">
                        <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat Feedback</a>
                    </div>
                </div>
            @endif
        @elseif($notification->type === 'App\Notifications\ReplyLabNotification')
            @if($notification->read_at)
                <div class="flex flex-col bg-gray-100 border-2 rounded p-3 space-y-2">
                    <div class="inline-flex space-x-2">
                        <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                    </div>
                    <p class="text-base text-gray-900">{{ $notification->data['reply'] }}</p>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    <div class="flex">
                        <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat Feedback</a>
                    </div>
                </div>
            @else
                <div class="flex flex-col bg-white border-2 rounded p-3 space-y-2">
                    <div class="inline-flex space-x-2">
                        <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                    </div>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    <p class="text-base text-gray-900">{{ $notification->data['reply'] }}</p>
                    <div class="flex">
                        <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat Feedback</a>
                    </div>
                </div>
            @endif
        @elseif($notification->type === 'App\Notifications\AdminReplyNotification')
            @if($notification->read_at)
                <div class="flex flex-col bg-gray-100 border-2 rounded p-3 space-y-2">
                    <div class="inline-flex space-x-2">
                        <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                    </div>
                    <p class="text-base text-gray-900">{{ $notification->data['reply'] }}</p>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    <div class="flex">
                        <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat Pengaduan</a>
                    </div>
                </div>
            @else
                <div class="flex flex-col bg-white border-2 rounded p-3 space-y-2">
                    <div class="inline-flex space-x-2">
                        <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                    </div>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    <p class="text-base text-gray-900">{{ $notification->data['reply'] }}</p>
                    <div class="flex">
                        <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat Pengaduan</a>
                    </div>
                </div>
            @endif
        @endif
    @empty
    <p>Kosong</p>
    @endforelse
</div>
@endsection