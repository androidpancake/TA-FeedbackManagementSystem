@extends('template.lab.template')

@section('content')

@section('breadcrumb-course')
<nav class="flex" aria-label="Breadcrumb">
  <ol class="inline-flex items-center space-x-1 md:space-x-3">
    <li class="inline-flex items-center">
      <a href="{{ route('lab.course.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 dark:text-gray-400 dark:hover:text-white">
        <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
        Home
      </a>
    </li>
    <li aria-current="page" class="active">
      <div class="flex items-center">
        <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
        <span class="ml-1 text-sm font-semibold text-gray-900 md:ml-2 dark:text-gray-400">{{ $course->name }}</span>
      </div>
    </li>
  </ol>
</nav>
@endsection
<div class="grid grid-cols-3 gap-2">
    @foreach($class as $data)
    <a href="{{ route('lab.course.class.feedback', $data->id) }}" class="bg-white border rounded-lg space-y-3">
        <!-- header -->
        <div class="bg-gradient-to-r from-cyan-500 to-blue-500 rounded-t-lg h-36"></div>
        <!-- <img src="{{ asset('image/'.$data->header) }}" alt="" class="rounded-t-lg h-36"> -->
        <div class="p-3">
            <!-- rating -->
            <div class="flex items-center space-x-1">
                <p class="text-sm font-medium text-gray-800">{{ round($data->average_rating) }}/5.0</p>
                <p class="text-sm font-base text-gray-500">dari {{ $survey_count->survey_count }} quick survey</p>
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
                <p class="font-medium">{{ $feedback }} umpan balik</p>
            </div>
            <p class="text-sm">{{ $user_count }} mahasiswa</p>
        </div>
    </a>
    @endforeach
</div>
@endsection