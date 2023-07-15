@extends('template.lab.template')

@section('content')
<h1 class="font-bold text-3xl">Selamat Datang, {{ Auth::user()->name }}</h1>
<div class="grid grid-cols-2 gap-2 mt-6">
    <!-- statistic -->
    <div class="bg-white p-2 rounded-lg border border-gray-400">
        <div class="font-bold text-gray-900 text-base p-4 border-b">Umpan Balik Terbaru</div>
        <div class="h-96">
            <div class="divide-y divide-gray-400 h-full overflow-y-auto">
                @foreach($recentFeedback as $data)
                <div class="bg-white p-4 space-y-3">
                    <div class="flex sm:flex justify-between items-center space-x-2">
                        <div class="flex flex-row items-center justify-start space-x-2">
                            <!-- <p>{{ $data->id }}</p> -->
                            @if($data->anonymous == 0 && $data->user)
                                <p class="text-lg font-bold text-gray-800 whitespace-nowrap">{{ $data->user->name }}</p>
                            @else
                                <p class="text-lg font-bold text-gray-800">Anonymous</p>
                            @endif
                            <p class="text-sm font-medium text-gray-400">{{ $data->class->course->name }}</p>
                            <p class="hidden md:flex text-sm font-medium text-gray-400">{{ $data->class->name }}</p>
                        </div>
                        <div class="inline-flex space-x-2">
                            <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
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
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path></svg>
                            <button class="text-sm text-blue-500">{{ count($data->reply) }} balasan</button>
                            <a href="{{ route('lab.feedback.detail', $data->id) }}" class="text-gray-400 text-sm hover:text-black">Lihat feedback</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bg-white p-2 rounded-lg border border-gray-400">
        <div class="font-bold text-gray-900 text-base p-4 border-b">Quick Survey Terbaru</div>
        <div class="h-96">
            <div class="divide-y divide-gray-400 h-full overflow-y-auto">
                @forelse($recentSurvey as $data)
                <div class="bg-white p-4 space-y-3">
                    <a href="{{ route('lab.survey.detail', $data->id) }}">
                        <div class="flex justify-between">
                            <div class="flex-col">
                                <h1 class="font-medium text-gray-800">{{ $data->class->course->name }}</h1>
                                <p class="text-sm">{{ $data->class->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-800">{{ Carbon\Carbon::parse($data->date)->translatedFormat('d F Y H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex justify-start items-center space-x-2">
                            <div class="flex space-x-1 text-sm items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-yellow-300" fill="currentColor" viewBox="0 0 256 256"><path d="M234.5,114.38l-45.1,39.36,13.51,58.6a16,16,0,0,1-23.84,17.34l-51.11-31-51,31a16,16,0,0,1-23.84-17.34L66.61,153.8,21.5,114.38a16,16,0,0,1,9.11-28.06l59.46-5.15,23.21-55.36a15.95,15.95,0,0,1,29.44,0h0L166,81.17l59.44,5.15a16,16,0,0,1,9.11,28.06Z"></path></svg>                            
                                <p>{{ $data->avgrating }}/5.0</p>
                            </div>
                            <div class="flex space-x-1 text-sm items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256"><path d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z"></path></svg>
                                <p class="text-sm">{{ count($data->responses) }}/{{ $data->class->user->count() }}</p>
                            </div>
                            <div class="flex space-x-1 text-sm items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256"><path d="M116,120a12,12,0,1,1,12,12A12,12,0,0,1,116,120Zm56,12a12,12,0,1,0-12-12A12,12,0,0,0,172,132Zm60-76V184a16,16,0,0,1-16,16H156.53l-14.84,24.29a16,16,0,0,1-27.41-.06L99.47,200H40a16,16,0,0,1-16-16V56A16,16,0,0,1,40,40H216A16,16,0,0,1,232,56Zm-16,0H40V184H99.47a16.08,16.08,0,0,1,13.7,7.73L128,216l14.82-24.32A16.07,16.07,0,0,1,156.53,184H216ZM84,132a12,12,0,1,0-12-12A12,12,0,0,0,84,132Z"></path></svg>
                                <p class="text-sm">{{ $data->commentCount }}</p>
                            </div>
                            <div class="flex space-x-1 text-sm items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256"><path d="M128,40a96,96,0,1,0,96,96A96.11,96.11,0,0,0,128,40Zm0,176a80,80,0,1,1,80-80A80.09,80.09,0,0,1,128,216ZM173.66,90.34a8,8,0,0,1,0,11.32l-40,40a8,8,0,0,1-11.32-11.32l40-40A8,8,0,0,1,173.66,90.34ZM96,16a8,8,0,0,1,8-8h48a8,8,0,0,1,0,16H104A8,8,0,0,1,96,16Z"></path></svg>
                                <p class="text-sm">{{ $data->remaining_time }} Jam</p>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="flex flex-col justify-center items-center mt-4">
                    <p class="text-center text-sm font-medium">Anda belum membuat survey apapun</p>
                    <a href="{{ route('lab.survey.create') }}" class="border px-2 py-2.5 rounded bg-white hover:bg-gray-400 text-sm">Buat Quick survey</a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="bg-white p-2 rounded-lg border border-gray-400">
        <div class="font-bold text-gray-900 text-base p-4 border-b">Frekuensi Umpan Balik</div>
        <div class="h-96">
            <canvas id="feedbackFrequent"></canvas>
        </div>
    </div>
    <div class="bg-white p-2 rounded-lg border border-gray-400">
        <div class="font-bold text-gray-900 text-base p-4 border-b">Umpan Balik Berdasarkan Kategori</div>
        <div class="h-96">
            <canvas id="feedbackCategory" class="chart"></canvas>
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
                    stepSize: 1
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
                    stepSize: 1
                }
            }
        }
    });
</script>
@endpush
@endsection