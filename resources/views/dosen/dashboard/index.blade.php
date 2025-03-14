@extends('template.dosen.template')

@section('content')
<div class="bg-gray-100 pt-16 p-8">
    <h1 class="font-semibold text-3xl">Selamat Datang, {{ Auth::user()->name }}</h1>
    <div class="grid grid-cols-2 gap-6 mt-6">
        <!-- statistic -->
        <div class="bg-white rounded-lg border border-gray-400">
            <div class="font-bold text-gray-900 text-lg p-4 border-b">Umpan Balik Terbaru</div>
            <div class="h-96">
                <div class="divide-y divide-gray-400 h-full overflow-y-auto">
                    @forelse($recentFeedback as $data)
                    <a href="{{ route('lecturer.feedback.detail', $data->id) }}" class="block bg-white hover:bg-gray-100">
                        <div class="p-4 space-y-3">
                            <div class="flex sm:flex justify-between items-start space-x-2">
                                <div class="flex md:flex-row items-start justify-start space-x-2">
                                    <!-- <p>{{ $data->id }}</p> -->
                                    <div class="flex flex-col">
                                        @if($data->anonymous == 0 && $data->user)
                                        <div class="inline-flex space-x-1">
                                            @if($data->user->photo_profile)
                                            <img src="{{ Storage::url($data->user->profile_photo) }}" class="w-5 h-5 rounded-full" alt="">
                                            @else
                                            @endif
                                            <p class="text-base font-semibold text-gray-800">{{ $data->user->name }}</p>
                                        </div>
                                        @else
                                        <p class="text-lg font-bold text-gray-800">Anonymous</p>
                                        @endif
                                        <div class="inline-flex space-x-2">
                                            <p class="text-xs font-medium text-gray-400">{{ $data->class->course->name }}</p>
                                            <p class="hidden md:flex text-xs text-gray-500">•</p>
                                            <p class="flex text-xs font-medium text-gray-400">{{ $data->class->name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="items-start space-x-2">
                                    <p class="text-xs whitespace-nowrap text-end font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
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
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="flex flex-col justify-center items-center h-full space-y-2">
                        <img src="{{ asset('storage/image/undraw_survey_05s5.svg') }}" class="w-36" alt="">
                        <p class="text-gray-600">Tidak ada data</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-400">
            <div class="font-bold text-gray-900 text-lg p-4 border-b flex justify-between items-center">
                Quick Survey Terbaru
                <div>
                    <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Pilih tipe</option>
                        <option value="online">Online</option>
                        <option value="onsite">Onsite</option>
                    </select>
                </div>
            </div>
            <div class="h-96 overflow-y-auto">
                <div class="divide-y divide-gray-400">
                    @forelse($recentSurvey as $data)
                    <a href="{{ route('lecturer.survey.detail', $data->id) }}" class="block bg-white hover:bg-gray-100 p-4 space-y-2">
                        <div class="flex justify-between">
                            <div>
                                <h1 class="text-base font-semibold">{{ $data->class->course->name }}</h1>
                                <p class="text-sm text-gray-500">{{ $data->class->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-800">{{ Carbon\Carbon::parse($data->date)->translatedFormat('d F Y') }}</p>
                            </div>
                        </div>
                        <div class="flex space-x-4">
                            <div class="flex space-x-1 text-sm items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-300" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path>
                                </svg>
                                <p>{{ $data->avgrating }}/5.0</p>
                            </div>
                            <div class="flex space-x-1 text-sm items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z"></path>
                                </svg>
                                <p class="text-sm">{{ count($data->responses) }}/{{ $data->class->user->count() }}</p>
                            </div>
                            <div class="flex space-x-1 text-sm items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M116,120a12,12,0,1,1,12,12A12,12,0,0,1,116,120Zm56,12a12,12,0,1,0-12-12A12,12,0,0,0,172,132Zm60-76V184a16,16,0,0,1-16,16H156.53l-14.84,24.29a16,16,0,0,1-27.41-.06L99.47,200H40a16,16,0,0,1-16-16V56A16,16,0,0,1,40,40H216A16,16,0,0,1,232,56Zm-16,0H40V184H99.47a16.08,16.08,0,0,1,13.7,7.73L128,216l14.82-24.32A16.07,16.07,0,0,1,156.53,184H216ZM84,132a12,12,0,1,0-12-12A12,12,0,0,0,84,132Z"></path>
                                </svg>
                                <p class="text-sm">{{ $data->commentCount }}</p>
                            </div>
                            <div class="flex space-x-1 text-sm items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M128,40a96,96,0,1,0,96,96A96.11,96.11,0,0,0,128,40Zm0,176a80,80,0,1,1,80-80A80.09,80.09,0,0,1,128,216ZM173.66,90.34a8,8,0,0,1,0,11.32l-40,40a8,8,0,0,1-11.32-11.32l40-40A8,8,0,0,1,173.66,90.34ZM96,16a8,8,0,0,1,8-8h48a8,8,0,0,1,0,16H104A8,8,0,0,1,96,16Z"></path>
                                </svg>
                                <p class="text-sm">{{ $data->remaining_time }} Jam</p>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="flex flex-col items-center justify-center">
                        <p class="text-center">Tidak ada data</p>
                        <div class="flex justify-center">
                            <a href="{{ route('lecturer.survey.create') }}" class="bg-green-500 px-2.5 py-3 rounded justify-center text-white font-semibold">Buat Survey</a>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- status -->
        <div class="flex flex-col bg-white rounded-lg border border-gray-200 drop-shadow-sm">
            <!-- status pengaduan -->
            <div class="font-bold text-gray-900 text-lg p-4 border-b">Status Umpan Balik</div>
            <div class="w-100 flex flex-row items-center justify-center px-4 py-6 space-x-2 border-b grow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M230.14,25.86a20,20,0,0,0-19.57-5.11l-.22.07L18.44,79a20,20,0,0,0-3,37.28l84.32,40,40,84.32a19.81,19.81,0,0,0,18,11.44c.57,0,1.15,0,1.73-.07A19.82,19.82,0,0,0,177,237.56L235.18,45.65a1.42,1.42,0,0,0,.07-.22A20,20,0,0,0,230.14,25.86ZM157,220.92l-33.72-71.19,45.25-45.25a12,12,0,0,0-17-17l-45.25,45.25L35.08,99,210,46Z"></path>
                </svg>
                <p class="font-semibold text-md w-full text-gray-700">Menunggu Respon:</p>
                <p class="text-2xl font-semibold text-gray-">{{ count($wait) }}</p>
            </div>
            <div class="w-100 flex flex-row items-center justify-center px-4 py-6 space-x-2 border-b grow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M230.66,86l-96-64a12,12,0,0,0-13.32,0l-96,64A12,12,0,0,0,20,96V200a20,20,0,0,0,20,20H216a20,20,0,0,0,20-20V96A12,12,0,0,0,230.66,86ZM89.81,152,44,184.31v-65ZM114.36,164h27.28L187,196H69.05ZM166.19,152,212,119.29v65ZM128,46.42l74.86,49.91L141.61,140H114.39L53.14,96.33Z"></path>
                </svg>
                <p class="font-semibold text-md w-full text-gray-700">Dibaca:</p>
                <p class="text-2xl font-semibold text-gray-">{{ count($read) }}</p>
            </div>
            <div class="w-100 flex flex-row items-center justify-center px-4 py-6 space-x-2 border-b grow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M128,20A108,108,0,1,0,236,128,108.12,108.12,0,0,0,128,20Zm0,192a84,84,0,1,1,84-84A84.09,84.09,0,0,1,128,212Zm68-84a12,12,0,0,1-12,12H128a12,12,0,0,1-12-12V72a12,12,0,0,1,24,0v44h44A12,12,0,0,1,196,128Z"></path>
                </svg>
                <p class="font-semibold text-md w-full text-gray-700">Dalam Proses:</p>
                <p class="text-2xl font-semibold text-gray-">{{ count($process) }}</p>
            </div>
            <div class="w-100 flex flex-row items-center justify-center px-4 py-6 space-x-2 grow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M232.49,80.49l-128,128a12,12,0,0,1-17,0l-56-56a12,12,0,1,1,17-17L96,183,215.51,63.51a12,12,0,0,1,17,17Z"></path>
                </svg>
                <p class="font-semibold text-md w-full text-gray-700">Selesai:</p>
                <p class="text-2xl font-semibold text-gray-">{{ count($done) }}</p>
            </div>
        </div>
        <!-- category feedback -->
        <div class="bg-white rounded-lg border border-gray-400">
            <div class="font-bold text-gray-900 text-lg p-4 border-b">Umpan Balik Berdasarkan Kategori</div>
            <div class="h-fit">
                <canvas id="feedbackCategory" class="chart"></canvas>
            </div>
        </div>
        <!-- frekuensi -->
        <div class="bg-white rounded-lg border border-gray-400 col-span-2">
            <div class="font-bold text-gray-900 text-lg p-4 border-b">Frekuensi Umpan Balik</div>
            <div class="h-fit p-2">
                <canvas id="feedbackFrequent"></canvas>
            </div>
        </div>
    </div>
</div>
@push('chartJs')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
@push('chart-feedback')
<script>
    var feedback = <?php echo json_encode($feedbackByCategory) ?>;
    var labels = feedback.map(function(feedback) {
        return feedback.name || '';
    });
    // console.log(labels);
    var data = feedback.map(function(feedback) {
        return feedback.count;
    });

    var ctx = document.getElementById('feedbackCategory').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Umpan Balik Berdasarkan Kategori',
                data: data,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1,
                    ticks: {
                        callback: function(value) {
                            if (value % 1 === 0) {
                                return value;
                            }
                        }
                    }
                }
            }
        }
    });
</script>
<script>
    var feedbackDaily = <?php echo json_encode($feedbackDaily) ?>;
    var labels = feedbackDaily.map(function(feedback) {
        return feedback.day;
    });
    // console.log(labels);
    var data = feedbackDaily.map(function(feedback) {
        return feedback.count;
    });

    var ctx = document.getElementById('feedbackFrequent').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Frekuensi Umpan Balik',
                data: data,
                backgroundColor: 'rgb(75, 192, 192)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    stepSize: 1,
                    ticks: {
                        callback: function(value) {
                            if (value % 1 === 0) {
                                return value;
                            }
                        }
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection