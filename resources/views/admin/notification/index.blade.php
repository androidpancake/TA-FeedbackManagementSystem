@extends('template.admin.dashboard')

@section('content')
<div class="p-8 mt-14 bg-gray-50 w-full">
    <div class="flex flex-col space-y-3">
        @forelse($notifications as $notification)
        @if($notification->type === 'App\Notifications\ComplaintNotification')
        @if($notification->read_at)
        <!-- complaint read -->
        <a href="{{ $notification->data['url'] }}" class="hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
            <div class="flex space-x-2 items-start">
                <div>
                    <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                </div>
                <div class="space-y-2">
                    <div>
                        <p class="text-gray-900 font-semibold">{{ $notification->data['message'] }} dari {{ $notification->data['name'] }}</p>
                        <p class="text-gray-900 font-medium">{{ $notification->data['subject'] }} </p>
                        <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </a>
        @else
        <!-- complaint unread -->
        <a href="{{ $notification->data['url'] }}" class="hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
            <div class="flex space-x-2 items-start">
                <div>
                    <img src="{{ Storage::url($notification->data['img']) }}" class="w-4 h-4 rounded-full sm:rounded-full" alt="">
                </div>
                <div class="space-y-2">
                    <div>
                        <p class="text-gray-900 font-semibold">{{ $notification->data['message'] }} </p>
                        <p class="text-gray-900 font-medium">{{ $notification->data['subject'] }} </p>
                        <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </a>
        @endif
        @elseif($notification->type === 'App\Notifications\UserComplaintReplyNotification')
        @if($notification->read_at)
        <!-- reply read -->
        <a href="{{ $notification->data['url'] }}" class="hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
            <div class="inline-flex space-x-2">
                <img src="{{ Storage::url($notification->data['img']) }}" class="w-4 h-4 rounded-full sm:rounded-full" alt="">
                <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
            </div>
            <p class="text-base text-gray-900">{{ $notification->data['reply'] }}</p>
            <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
        </a>
        @else
        <!-- reply unread -->
        <a href="{{ $notification->data['url'] }}" class="hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
            <div class="inline-flex space-x-2">
                <img src="{{ Storage::url($notification->data['img']) }}" class="w-4 h-4 rounded-full sm:rounded-full" alt="">
                <p class="text-gray-900 font-medium">{{ $notification->data['message'] }} </p>
            </div>
            <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
            <p class="text-base text-gray-900">{{ $notification->data['reply'] }}</p>
        </a>
        @endif
        @endif
        @if($notification->type === 'App\Notifications\complaintDoneNotification')
        @if($notification->read_at)
        <!-- complaint read -->
        <a href="{{ $notification->data['url'] }}" class="hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
            <div class="flex space-x-2 items-start">
                <div>
                    <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                </div>
                <div class="space-y-2">
                    <div>
                        <p class="text-gray-700 font-semibold">{{ $notification->data['name'] }}</p>
                        <p class="text-gray-500 font-base">{{ $notification->data['message'] }} </p>
                        <p class="text-gray-700 font-semibold">{{ $notification->data['subject'] }}</p>
                        <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </a>
        @else
        <!-- complaint unread -->
        <a href="{{ $notification->data['url'] }}" class="hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
            <div class="flex space-x-2 items-start">
                <div>
                    <img src="{{ Storage::url($notification->data['img']) }}" class="w-4 h-4 rounded-full sm:rounded-full" alt="">
                </div>
                <div class="space-y-2">
                    <div>
                        <p class="text-gray-700 font-semibold">{{ $notification->data['name'] }}</p>
                        <p class="text-gray-500 font-base">{{ $notification->data['message'] }} </p>
                        <p class="text-gray-700 font-semibold">{{ $notification->data['subject'] }}</p>
                        <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </a>
        @endif
        @endif
        @empty
        <p>Belum ada aktivitas</p>
        @endforelse
    </div>
</div>
@endsection