@extends('template.admin.template')

@section('content')
<div class="px-6 py-6 space-y-6 lg:px-8">
    @if ($errors->any())
        <div class="bg-red py-2 px-3">
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif
    <h3 class="mb-4 text-xl font-semibold text-gray-900">{{ $category->name }}</h3>
    <form action="{{ route('admin.setting.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="space-y-2">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama kategori</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ $category->name }}">
        </div>
        <div>
            <label for="desc" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
            <input type="text" name="desc" id="desc" value="{{ $category->desc }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="{{ $category->desc }}">
        </div>
        <div>
            <label for="for" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Peruntukan</label>
            <select name="for" id="for" class="w-full rounded text-sm">
                <option value="">Pilih peruntukan</option>
                <option value="complaint">Complaint</option>
                <option value="feedback">Feedback</option>
            </select>
        </div>
        <div>
            <img src="{{ Storage::url($category->label) }}}" class="w-6 h-6" alt="">
            <label for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Label</label>
            <input type="file" name="label">
        </div>
        <div>
            <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update</button>
        </div>
    </form>
</div>
@endsection