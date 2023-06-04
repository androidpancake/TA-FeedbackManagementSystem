@extends('template.dosen.template')

@section('content')
<h1 class="font-bold text-lg">Mata kuliah saya</h1>

<div class="grid grid-cols-3 gap-2">
    @foreach($course as $data)
    <a href="{{ route('lecturer.course.class', $data->id) }}" class="bg-white px-4 py-2.5 border rounded-lg space-y-3">
        <!-- icon -->
        <span>
            <img src="{{ asset('storage/image/book.png') }}" alt="">
        </span>
        <div>
            <!-- name -->
            <h1 class="text-lg font-semibold text-gray-800">{{ $data->name }}</h1>
            <!-- rating -->
            <div class="inline-flex space-x-2">
                <p class="font-semibold text-gray-800">4.5/5.0</p>
                <p class="text-gray-500">dari 4 kelas</p>
            </div>
        </div>
    </a>
    @endforeach
</div>
@endsection