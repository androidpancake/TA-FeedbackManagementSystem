@extends('template.lab.template')

@section('content')
<div class="flex justify-center">
    <div class="w-1/2 flex-col space-y-2">
        <!-- title & icon -->
        <div class="space-y-2 border-b py-2">
            <div class="flex justify-between items-center space-x-2">
                <!-- icon -->
                <div>
                    <img src="{{ asset('storage/image/logo.png') }}" class="w-auto h-8" alt="">
                </div>
                <!-- title & desc -->
                <div>
                    <div class="flex flex-col items-end">
                        <h1 class="font-semibold text-xl">{{ $survey->class->course->name }}</h1>

                        <div class="inline-flex space-x-2">
                            <p>{{ $survey->class->name }}</p>
                            <p>•</p>
                            <p>{{ Carbon\Carbon::parse($survey->date)->translatedFormat('d F Y H:i') }}</p>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- due date -->
            <div class="flex justify-between space-x-8">
                <p class="text-sm text-gray-500">Tenggat waktu</p>
                <p class="text-sm text-gray-500">{{ Carbon\Carbon::parse($survey->limit_date)->translatedFormat('d F Y H:i') }}</p>
            </div>
        </div>

        

        <!-- rating -->
        <div class="w-full py-2">
            <h1 class="font-semibold text-xl">Rating</h1>
            <div class="flex items-center mb-3">
                <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <p class="ml-2 text-sm font-medium text-gray-900 dark:text-white">{{ $survey->averageRating }} dari 5</p>
            </div>
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ count($survey->responses) }} dari {{ $survey->class->user->count() }} mahasiswa</p>
            @foreach($ratingsCount as $rating => $count)
            <div class="flex items-center mt-4">
                <span class="text-sm font-medium text-blue-600 dark:text-blue-500">{{ $rating }} star</span>
                <div class="grow h-5 mx-4 bg-gray-200 rounded dark:bg-gray-700">
                    <div class="h-5 bg-yellow-400 rounded" style="width: {{ $ratingPrecentage[$rating] }}%"></div>
                </div>
                <span class="text-sm font-medium text-blue-600 dark:text-blue-500">{{ $count }}</span>
            </div>
            @endforeach  
        </div>

        <!-- comment -->
        <div>
            <h1 class="font-semibold">Komentar {{($commentCount)}}</h1>
            <div class="mt-2 space-y-2 h-96 overflow-y-auto">
                @foreach($survey->responses as $data)
                <div class="w-full bg-white rounded-lg border-2">
                    <div class="p-4 space-y-1">
                        <div class="flex space-x-2 items-center border-b border-gray-300 pb-3">
                            <img src="{{ asset('storage/image/Teacher.png') }}" alt="" class="rounded-full">
                            <h1 class="text-gray-500 font-semibold">{{ $data->user->name }}</h1>
                            <p>•</p>
                            <p class="text-sm text-gray-500 font-medium">{{ $data->created_at->diffForHumans() }}</p>
                        </div>
                        
                        <div class="flex items-center my-5">
                            @for($i = 1; $i<=5;$i++)
                                @if($i <= $data->rating)
                                    <svg aria-hidden="true" class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                @else
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>First star</title><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>

                                @endif
                            @endfor
                        </div>
                        <div class="mt-4">
                            <p class="text-gray-800 text-lg">{{ $data->comment }}</p>
                        </div>
                        <div class="space-y-1">
                            @if($data->additional)
                                @if($data->rating <= 3)
                                    <h1 class="text-sm text-gray-500">Yang perlu ditingkatkan</h1>
                                @else
                                    <h1 class="text-sm text-gray-500">Yang sudah ditingkatkan</h1>
                                @endif
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach(explode(',', $data->additional) as $additional)
                                    <div class="inline-flex items-center justify-between w-full p-2 text-gray-500 bg-white border-2  border-gray-200 rounded-lg">                           
                                        <div class="block">
                                            <div class="w-full text-base font-semibold">{{ $additional }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                            @endif
                        </div>
                        
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection