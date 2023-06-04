@extends('template.admin.template')

@section('content')
<h1 class="font-bold text-3xl">Category</h1>
    <div class="mt-6 space-y-auto">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Alasan
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Kategori
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($additional as $data)
                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $data->reason }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $data->for }}
                        </td>
                        <td class="px-6 py-4 space-x-4 inline-flex">
                            <a href="#" class="text-sm text-green-600 font-medium">Edit</a>
                            <form action="#" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-500 font-medium" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection