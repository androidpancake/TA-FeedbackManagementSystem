@extends('template.lab.template')

@section('content')
<h1 class="font-bold text-lg">Praktikum Saya</h1>

<div class="grid grid-cols-3 gap-2">
    @foreach($course as $data)
    <a href="{{ route('lab.course.class', $data->id) }}" class="bg-white px-4 py-2.5 border rounded-lg space-y-3">
        <!-- icon -->
        <span>
            <img src="{{ asset('storage/image/book.png') }}" alt="">
        </span>
        <div>
            <!-- name -->
            <h1 class="text-lg font-semibold text-gray-800">{{ $data->name }}</h1>
            <!-- info -->
            <div class="flex-col">
                <p class="text-sm text-gray-800">Kode : {{ $data->code }}</p>
                <p class="text-sm text-gray-600">{{ $courseCounts[$data->id] }} kelas</p>
            </div>
        </div>
    </a>
    @endforeach
</div>
@endsection