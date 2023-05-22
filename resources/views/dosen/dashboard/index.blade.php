@extends('template.dosen.template')

@section('content')
<h1 class="font-bold text-3xl">Selamat Datang, {{ Auth::user()->name }}</h1>
<div class="grid grid-cols-4 gap-2 mt-6">
    <!-- statistic -->
    <div class="bg-white p-2 rounded-lg border border-gray-400">
        <div class="font-bold text-gray-500 text-sm">Test</div>
        <p class="font-bold">Test</p>
    </div>
    <div class="bg-white p-2 rounded-lg border border-gray-400">
        <div class="font-bold text-gray-500 text-sm">Test</div>
        <p class="font-bold">Test</p>
    </div>
</div>
@endsection