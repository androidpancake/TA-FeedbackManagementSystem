@forelse($surveys as $data)
    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
            {{ $data->class->name }}
        </th>
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
            {{ Carbon\Carbon::parse($data->date)->translatedFormat('d F Y H:i') }}
        </th>
        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
            {{ $data->type }}
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
            {{ $data->remaining_time }} jam 
        </th>
        <td class="px-6 py-4 text-right inline-flex items-center justify-end space-x-2">
            <a href="{{ route('lecturer.survey.detail', $data->id) }}" class="text-sm font-medium text-green-600">Lihat hasil</a>
            <button data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="bg-transparent text-red-500 px-2 py-2.5">Hapus</button>

            <div id="deleteModal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-6 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin akan menghapus survey ini?</h3>
                            <div class="inline-flex">
                                <form action="{{ route('lecturer.survey.delete', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">
                                        Hapus
                                    </button>
                                </form>
                                <button data-modal-hide="deleteModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tidak</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
    </tr>
@empty
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
        Tidak ada data
    </th>
@endforelse