@extends('template.admin.dashboard')

@section('content')
<div class="bg-gray-100 pt-16 p-8">
<h1 class="font-bold text-3xl">Selamat Datang, {{ Auth::user()->name }}</h1>

<div class="grid grid-cols-2 gap-6 mt-6">
    <!-- statistic -->
    <div class="bg-white p-2 rounded-lg border border-gray-400">
        <div class="font-bold text-gray-800 text-lg p-4 border-b">Pengaduan Terbaru</div>
        <div class="h-96">
            <div class="divide-y divide-gray-400 h-full overflow-y-auto">
                @foreach($recentComplaint as $data)
                <div class="bg-white px-6 py-8 space-y-3">
                    <div class="flex sm:flex justify-between items-center space-x-2">
                        <div class="flex md:flex-row items-center justify-start space-x-2">
                            <!-- <p>{{ $data->id }}</p> -->
                            @if($data->user->profile_photo)
                            <img src="{{ Storage::url($data->user->profile_photo) }}" class="w-6 rounded-full" alt="">
                            @else
                            <img src="{{ asset('storage/image/Teacher.png') }}" class="w-8 rounded-full" alt="">
                            @endif      
                            <p class="text-lg font-bold text-gray-800">{{ $data->user->name }}</p>
                        </div>
                        <div class="inline-flex space-x-2">
                            <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex space-x-2">
                            <h2 class="font-bold text-gray-800 text-base">{{ $data->subject }}</h2>
                            <span class="{{ $data->category->bg }} text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2 dark:bg-gray-700 dark:text-gray-400">
                                <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                                {{ $data->category->name }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="bg-white p-2 rounded-lg border border-gray-400">
        <div class="font-bold text-gray-800 text-lg p-4 border-b">Status Pengaduan</div>
        <div class="grid grid-cols-2 gap-4 p-2 h-96 mt-2">
            <div class="bg-white rounded border-2 flex items-center p-2">
                <div class="flex justify-between items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 256 256"><path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path></svg>                    <div class="order-last">
                        <h1 class="font-semibold text-sm text-gray-500">Belum direspon</h1>
                        <p class="text-2xl font-bold">{{ $complaintSent }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded border-2 flex items-center p-2">
                <div class="flex justify-between items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 256 256"><path d="M228.44,89.34l-96-64a8,8,0,0,0-8.88,0l-96,64A8,8,0,0,0,24,96V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V96A8,8,0,0,0,228.44,89.34ZM128,41.61l81.91,54.61-67,47.78H113.11l-67-47.78ZM40,200V111.53l65.9,47a8,8,0,0,0,4.65,1.49h34.9a8,8,0,0,0,4.65-1.49l65.9-47V200Z"></path></svg>                    <div class="order-last">
                        <h1 class="font-semibold text-sm text-gray-500">Dibaca</h1>
                        <p class="text-2xl font-bold">{{ $complaintRead }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded border-2 flex items-center p-2">
                <div class="flex justify-between items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path></svg>                    
                    <div class="order-last">
                        <h1 class="font-semibold text-sm text-gray-500">Direspon</h1>
                        <p class="text-2xl font-bold">{{ $complaintResponse }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded border-2 flex items-center p-2">
                <div class="flex justify-between items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>                    <div class="order-last">
                        <h1 class="font-semibold text-sm text-gray-500">Selesai</h1>
                        <p class="text-2xl font-bold">{{ $complaintDone }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white p-2 rounded-lg border border-gray-400">
        <div class="font-bold text-gray-800 text-lg p-4 border-b">Pengaduan berdasarkan kategori</div>
        <canvas id="complaintCategory"></canvas>
    </div>
    <div class="bg-white p-2 rounded-lg border border-gray-400">
        <div class="font-bold text-gray-800 text-lg p-4 border-b">Jumlah harian pengaduan</div>
        <canvas id="dailyComplaint"></canvas>
    </div>
    
</div>
</div>
@push('chartJs')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush
@push('chart')
<script>
    var complaint = <?php echo json_encode($complaintCategory) ?>;
    var labels = complaint.map(function(complaint) {
        return complaint.name;
    });
    // console.log(labels);
    var data = complaint.map(function(complaint) {
        return complaint.count;
    });

    var ctx = document.getElementById('complaintCategory').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Feedback Berdasarkan Kategori',
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
            }]
        },
        options: {
            scales: {
                y: {
                    ticks: {
                        beginAtZero: true,
                        precision: 0,
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

    console.log(labels);
</script>
<script>
    var complaint = <?php echo json_encode($complaintDaily) ?>;
    var labels = complaint.map(function(complaint) {
        return complaint.day;
    });
    // console.log(labels);
    var data = complaint.map(function(complaint) {
        return complaint.count;
    });

    var ctx = document.getElementById('dailyComplaint').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Complaints',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
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
                        beginAtZero: true,
                        precision: 0,
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