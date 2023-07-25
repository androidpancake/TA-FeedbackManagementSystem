@extends('template.admin.dashboard')

@section('content')
<div class="p-8 mt-14 bg-gray-50 w-full h-screen space-y-6">
    @forelse($groupedNotification as $date => $notifications)
    <div class="space-y-2">
        <p class="w-1/2 mx-auto pb-2 border-b font-medium text-gray-400">{{ $date }}</p>
        <div class="flex flex-col space-y-3">
            @forelse($notifications as $notification)
            @if($notification->type === 'App\Notifications\ComplaintNotification')
            @if($notification->read_at)
            <!-- create read -->
            <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                <div class="flex space-x-3 items-center">
                    <div>
                        <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                    </div>
                    <div class="space-y-2">
                        <div class="">
                            <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }}</span>
                            <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                            <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                            <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <!-- <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span> -->
                </div>
            </a>
            @else
            <!-- create unread -->
            <a href="{{ route('admin.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                <div class="flex space-x-3 items-center">
                    <div>
                        <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                    </div>
                    <div class="space-y-2">
                        <div class="">
                            <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }}</span>
                            <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                            <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                            <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                </div>
            </a>
            @endif
            @elseif($notification->type === 'App\Notifications\UserComplaintReplyNotification')
            @if($notification->read_at)
            <!-- reply read -->
            <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                <div class="flex space-x-3 items-center">
                    <div>
                        <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                    </div>
                    <div class="space-y-2">
                        <div class="">
                            <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }}</span>
                            <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                            <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                            <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <!-- <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span> -->
                </div>
            </a>
            @else
            <!-- reply unread -->
            <a href="{{ route('admin.notification.read', ['id' => $notification->id]) }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                <div class="flex space-x-3 items-center">
                    <div>
                        <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                    </div>
                    <div class="space-y-2">
                        <div class="">
                            <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }}</span>
                            <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                            <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                            <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                </div>
            </a>
            @endif
            @endif
            @if($notification->type === 'App\Notifications\complaintDoneNotification')
            @if($notification->read_at)
            <!-- done read -->
            <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                <div class="flex space-x-3 items-center">
                    <div>
                        <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                    </div>
                    <div class="space-y-2">
                        <div class="">
                            <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }}</span>
                            <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                            <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                            <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <!-- <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span> -->
                </div>
            </a>
            @else
            <!-- done unread -->
            <a href="{{ $notification->data['url'] }}" class="relative hover:bg-gray-100 flex flex-col bg-white border shadow-sm rounded-md p-3 space-y-2 w-1/2 mx-auto">
                <div class="flex space-x-3 items-center">
                    <div>
                        <img src="{{ Storage::url($notification->data['img']) }}" class="w-8 h-8 rounded-full" alt="">
                    </div>
                    <div class="space-y-2">
                        <div class="">
                            <span class="text-gray-700 font-semibold inline">{{ $notification->data['name'] }}</span>
                            <span class="text-gray-500 font-base inline">{{ $notification->data['message'] }} </span>
                            <span class="text-gray-700 font-semibold inline">"{{ $notification->data['subject'] }}"</span>
                            <p class="text-sm text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <span class="absolute top-3 right-3 w-2 h-2 bg-blue-500 rounded-full"></span>
                </div>
            </a>

            @endif
            @endif
            @empty
            <p>Belum ada aktivitas</p>
            @endforelse
        </div>
    </div>
    @empty
    @endforelse
</div>
@endsection