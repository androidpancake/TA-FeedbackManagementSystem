@extends('template.dosen.template')
@section('breadcrumb-class')
<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('lecturer.course.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 dark:text-gray-400 dark:hover:text-white">
                <svg aria-hidden="true" class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                </svg>
                Home
            </a>
        </li>
        <li class="inline-flex items-center">
            <a href="{{ route('lecturer.course.class', $class->course->id) }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 dark:text-gray-400 dark:hover:text-white">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                {{ $class->course->name }}
            </a>
        </li>
        <li aria-current="page" class="active">
            <div class="flex items-center">
                <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="ml-1 text-sm font-semibold text-gray-900 md:ml-2 dark:text-gray-400">{{ $class->name }}</span>
            </div>
        </li>
    </ol>
</nav>
@endsection
@section('content')
<!-- header -->
<div class="bg-gradient-to-r from-cyan-400 to-blue-500 h-36 w-full rounded-lg"></div>
<!-- info -->
<div class="bg-white border-b w-full">
    <div class="flex flex-row justify-between items-end p-4">
        <!-- class & mk -->
        <div>
            <h1 class="text-2xl font-semibold">{{ $class->name }}</h1>
            <p class="text-sm text-gray-600">{{ $class->course->name }}</p>
        </div>
        <div class="inline-flex space-x-1">
            <!-- star -->
            <p class="text-sm font-semibold">{{ round($avg_rating) }}/5.0</p>
            <p class="text-sm text-gray-500">dari {{ $count_survey }} quick survey</p>
        </div>
    </div>
</div>
<!-- controls -->
<div class="flex flex-col md:flex-row justify-between space-y-2 mt-4" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
    <div class="flex items-center space-x-2">
        <button id="feedback-tab" role="tab" data-tabs-target="#feedback" aria-selected="true" aria-controls="feedback" class="py-2 px-2 bg-gray-200 rounded-lg font-bold text-gray-700 text-sm inline-flex items-center space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256">
                <path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path>
            </svg>
            <p>Umpan Balik</p>
            <p>({{ $count }})</p>
        </button>
        <button id="survey-tab" role="tab" data-tabs-target="#survey" aria-controls="survey" class="py-2 px-2 rounded font-bold text-gray-700 text-sm inline-flex items-center space-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256">
                <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path>
            </svg>
            <p>Survei</p>
            <p>({{ $count_survey }})</p>
        </button>
    </div>
</div>
<!-- feedback -->
<div id="myTabContent">
    <div class="hidden mt-4" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
        @forelse($feedback as $data)
        <a href="{{ route('lecturer.feedback.detail', $data->id) }}">
            <div class="border-y sm:bg-white py-6 space-y-3">
                <div class="flex flex-col sm:flex-row justify-between space-x-2">
                    <div class="flex md:flex-row items-center justify-start space-x-2">
                        @if($data->anonymous == 0)
                        <p class="text-lg font-bold text-gray-800">{{ $data->user->name }}</p>
                        @else
                        <p class="text-lg font-bold text-gray-800">Anonymous</p>
                        @endif
                        <p class="hidden md:flex text-sm text-gray-500">•</p>
                        <p class="text-sm font-medium text-gray-400">{{ $data->class->course->name }}</p>
                        <p class="hidden md:flex text-sm text-gray-500">•</p>
                        <p class="flex text-sm font-medium text-gray-400">{{ $data->class->name }}</p>
                    </div>
                    <div class="inline-flex space-x-2">
                        <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->date)) }}</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="flex space-x-2">
                        <h2 class="font-bold text-gray-800 text-base">{{ $data->subject }}</h2>

                        <span class="bg-green-100 text-green-800 text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2 dark:bg-gray-700 dark:text-gray-400 border border-green-300">
                            <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                            {{ $data->category->name }}
                        </span>
                    </div>
                    <p class="text-sm mt-2 text-gray-500">
                        {{ $data->content }}
                    </p>
                    <div class="flex items-center space-x-2 mt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path>
                        </svg>
                        <button class="text-sm text-blue-500">{{ count($data->reply) }}</button>
                    </div>
                </div>
            </div>
        </a>
        @empty
        @endforelse
    </div>
    <div class="hidden" id="survey" role="tabpanel" aria-labelledby="survey-tab">
        <div class="relative overflow-x-auto shadow-md mt-2 sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Kelas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Tanggal
                                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512">
                                        <path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                                    </svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Rating
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Responden
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Komentar
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Sisa waktu
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($survey as $data)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $data->class->name }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ Carbon\Carbon::parse($data->date)->translatedFormat('d F Y H:i') }}
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $data->avgrating }}/5.0
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ count($data->responses) }}/{{ $data->class->user->count() }} Mahasiswa
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $data->commentCount }} Komentar
                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                            {{ $data->remaining_time }} Jam
                        </th>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('lecturer.survey.detail', $data->id) }}" class="text-sm font-medium text-green-600">Lihat hasil</a>
                            <a href="" class="text-sm text-red-500">Hapus</a>

                        </td>
                    </tr>
                    @empty
                    <p>tidak ada data</p>
                    @endforelse
                </tbody>
            </table>
            {{ $survey->links() }}

        </div>
    </div>
</div>
@endsection