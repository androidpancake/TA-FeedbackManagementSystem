@extends('template.template')
@section('content')
<div class="flex flex-col space-y-2">
    
    @forelse($notifications as $notification)
        @if($notification->type === 'App\Notification\SurveyNotification')
            @if($notification->read_at)
                <div class="flex flex-col bg-gray-100 border-2 rounded p-3 space-y-2">
                    <div class="inline-flex space-x-2">
                        <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                    </div>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        @if($notification->data['survey_filled'])
                        <button class="bg-gray-300 px-2 py-2.5 rounded text-white" disabled>Anda sudah mengisi survey</button>
                        @else
                        <div class="flex">
                            <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat survey</a>
                        </div>
                        @endif
                </div>
            @else
                <div class="flex flex-col bg-whiteborder-2 rounded p-3 space-y-2">
                    <div class="inline-flex space-x-2">
                        <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                    </div>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        @if($notification->data['survey_filled'])
                        <button class="bg-gray-300 px-2 py-2.5 rounded text-white" disabled>Anda sudah mengisi survey</button>
                        @else
                        <div class="flex">
                            <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat survey</a>
                        </div>
                        @endif
                </div>
            @endif
        <!-- @elseif($notification->type === 'App\Notification\ReplyNotification')
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
                <div class="flex flex-col bg-whiteborder-2 rounded p-3 space-y-2">
                    <div class="inline-flex space-x-2">
                        <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
                    </div>
                    <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    <p class="text-base text-gray-900">{{ $notification->data['reply'] }}</p>
                    <div class="flex">
                        <a href="{{ $notification->data['url'] }}" class="bg-green-500 px-2 py-2.5 rounded text-white">Lihat Feedback</a>
                    </div>
                </div>
            @endif -->
        @endif
    @empty
    <p>Kosong</p>
    @endforelse
</div>
@endsection