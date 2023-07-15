@forelse($surveys as $data)
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
            {{ $data->remaining_time }} jam 
        </th>
        <td class="px-6 py-4 text-right space-x-2">
            <a href="{{ route('lab.survey.detail', $data->id) }}" class="text-sm font-medium text-green-600">Lihat hasil</a>
            <a href="" class="text-sm text-red-500">Hapus</a>
        </td>
    </tr>
@empty
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
        Tidak ada data
    </th>
@endforelse