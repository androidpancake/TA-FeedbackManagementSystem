@extends('template.template')
@section('content')
<div class="flex flex-col space-y-2">
    
    @forelse($surveys as $data)
    <div class="flex flex-col bg-white border-2 rounded p-3 space-y-2">
        <div class="inline-flex space-x-2">
            <p class="text-gray-900 font-medium">{{ $data->class->lecturer->name }} </p>
            <p>membagikan quick survey kelas</p>
            <p class="font-medium">{{ $data->class->course->name }} {{ $data->class->name }}</p>
            <p>pada</p>
            <p class="font-medium">{{ date('D, d M Y, H:i', strtotime($data->date)) }}</p>
        </div>
        <p class="text-sm text-gray-500">{{ $data->date }}</p>
        <div>
            @if($data->hasFilled)
            <button class="bg-gray-400 p-2 rounded" disabled>Anda sudah mengisi survey</button>
            @else
            <a href="{{ route('mahasiswa.survey.fill', $data->id) }}" class="bg-green-500 p-2 rounded text-white">Isi quick survey</a>
            @endif
        </div>
    </div>
    @empty
    <p>Kosong</p>
    @endforelse
</div>
@endsection