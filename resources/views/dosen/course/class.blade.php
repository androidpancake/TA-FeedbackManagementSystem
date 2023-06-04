@extends('template.dosen.template')

@section('content')
<div class="grid grid-cols-3 gap-2">
    @foreach($class as $data)
    <a href="{{ route('lecturer.course.class.feedback', $data->id) }}" class="bg-white border rounded-lg space-y-3">
        <!-- header -->
        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 rounded-t-lg h-36"></div>
        <!-- <img src="{{ asset('image/'.$data->header) }}" alt="" class="rounded-t-lg h-36"> -->
        <div class="p-3">
            <!-- rating -->
            <div class="flex items-center space-x-1">
                <p class="text-sm font-medium text-gray-800">4.5/5.0</p>
                <p class="text-sm font-base text-gray-500">dari 4 quick survey</p>
            </div>

            <!-- class -->
            <p>{{ $data->class_id }}</p>
            <p class="text-gray-800 font-semibold text-lg">{{ $data->name }}</p>
            <!-- course -->
            <p class="text-gray-400">{{ $data->course->name }}</p>
            <!-- feedback -->
            <div>
                <!-- icon -->
                <!-- info -->
                <p class="font-medium">{{ $feedback->feedback_count }} umpan balik</p>
            </div>
            <p class="text-sm">{{ $user_count->user_count }} mahasiswa</p>
        </div>
    </a>
    @endforeach
</div>
@endsection