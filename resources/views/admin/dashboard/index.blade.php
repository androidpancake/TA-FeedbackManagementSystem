@extends('template.admin.dashboard')

@section('content')
<div class="bg-gray-50 pt-16 mt-4 p-8">
    <h1 class="font-semibold text-3xl text-gray-700">Selamat Datang, {{ Auth::user()->name }}</h1>
    <div class="grid grid-cols-2 gap-6 mt-6">
        <!-- statistic -->
        <div class="bg-white rounded-lg border border-gray-200 drop-shadow-sm">
            <div class="font-semibold text-gray-800 text-lg p-4 border-b">Keluhan Terbaru</div>
            <div class="h-96">
                <div class="divide-y divide-gray-200 h-full overflow-y-auto">
                    @forelse($recentComplaint as $data)
                    <a href="{{ Route('admin.complaint.detail', $data->id) }}" class="block">
                        <div class="bg-white hover:bg-gray-100 px-4 py-6">
                            <div class="flex sm:flex justify-between items-center space-x-2 mb-2">
                                <div class="flex md:flex-row items-center justify-center items-center space-x-2">
                                    @if($data->user->profile_photo)
                                    <img src="{{ Storage::url($data->user->profile_photo) }}" class="w-5 h-5 rounded-full" alt="">
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 256 256">
                                        <path d="M234.38,210a123.36,123.36,0,0,0-60.78-53.23,76,76,0,1,0-91.2,0A123.36,123.36,0,0,0,21.62,210a12,12,0,1,0,20.77,12c18.12-31.32,50.12-50,85.61-50s67.49,18.69,85.61,50a12,12,0,0,0,20.77-12ZM76,96a52,52,0,1,1,52,52A52.06,52.06,0,0,1,76,96Z"></path>
                                    </svg>
                                    @endif
                                    <p class="text-sm text-gray-600">{{ $data->user->name }}</p>
                                </div>
                                <p class="text-sm text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                            </div>
                            <div class="flex flex-col">
                                <div class="flex justify-between">
                                    <p class="font-semibold text-gray-700 text-base">{{ $data->subject }}</p>
                                    <span class="{{ $data->category->bg }} text-xs font-semibold inline-flex items-center rounded-md h-6 px-2">
                                        <img src="{{ Storage::url($data->category->label) }}" class="w-4 h-4 mr-1" alt="">
                                        <p class="w-fit">{{ $data->category->name }}</p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="flex flex-col w-full h-full space-y-2 justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 text-gray-500" fill="currentColor" viewBox="0 0 256 256">
                            <path d="M240,120a48.05,48.05,0,0,0-48-48H152.2c-2.91-.17-53.62-3.74-101.91-44.24A16,16,0,0,0,24,40V200a16,16,0,0,0,26.29,12.25c37.77-31.68,77-40.76,93.71-43.3v31.72A16,16,0,0,0,151.12,214l11,7.33A16,16,0,0,0,186.5,212l11.77-44.36A48.07,48.07,0,0,0,240,120ZM40,199.93V40h0c42.81,35.91,86.63,45,104,47.24v65.48C126.65,155,82.84,164.07,40,199.93Zm131,8,0,.11-11-7.33V168h21.6ZM192,152H160V88h32a32,32,0,1,1,0,64Z"></path>
                        </svg>
                        <p class="text-gray-400">Belum ada keluhan</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white rounded-lg border border-gray-200 drop-shadow-sm">
            <!-- status pengaduan -->
            <div class="font-semibold text-gray-800 text-lg p-4 border-b">Status Keluhan</div>
            <div class="w-100 flex flex-row items-center justify-center px-4 py-6 space-x-2 border-b grow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M230.14,25.86a20,20,0,0,0-19.57-5.11l-.22.07L18.44,79a20,20,0,0,0-3,37.28l84.32,40,40,84.32a19.81,19.81,0,0,0,18,11.44c.57,0,1.15,0,1.73-.07A19.82,19.82,0,0,0,177,237.56L235.18,45.65a1.42,1.42,0,0,0,.07-.22A20,20,0,0,0,230.14,25.86ZM157,220.92l-33.72-71.19,45.25-45.25a12,12,0,0,0-17-17l-45.25,45.25L35.08,99,210,46Z"></path>
                </svg>
                <p class="font-semibold text-md w-full text-gray-700">Menunggu Respon:</p>
                <p class="text-2xl font-semibold text-gray-">{{ $complaintSent }}</p>
            </div>
            <div class="w-100 flex flex-row items-center justify-center px-4 py-6 space-x-2 border-b grow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M230.66,86l-96-64a12,12,0,0,0-13.32,0l-96,64A12,12,0,0,0,20,96V200a20,20,0,0,0,20,20H216a20,20,0,0,0,20-20V96A12,12,0,0,0,230.66,86ZM89.81,152,44,184.31v-65ZM114.36,164h27.28L187,196H69.05ZM166.19,152,212,119.29v65ZM128,46.42l74.86,49.91L141.61,140H114.39L53.14,96.33Z"></path>
                </svg>
                <p class="font-semibold text-md w-full text-gray-700">Dibaca:</p>
                <p class="text-2xl font-semibold text-gray-">{{ $complaintRead }}</p>
            </div>
            <div class="w-100 flex flex-row items-center justify-center px-4 py-6 space-x-2 border-b grow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M128,20A108,108,0,1,0,236,128,108.12,108.12,0,0,0,128,20Zm0,192a84,84,0,1,1,84-84A84.09,84.09,0,0,1,128,212Zm68-84a12,12,0,0,1-12,12H128a12,12,0,0,1-12-12V72a12,12,0,0,1,24,0v44h44A12,12,0,0,1,196,128Z"></path>
                </svg>
                <p class="font-semibold text-md w-full text-gray-700">Dalam Proses:</p>
                <p class="text-2xl font-semibold text-gray-">{{ $complaintResponse }}</p>
            </div>
            <div class="w-100 flex flex-row items-center justify-center px-4 py-6 space-x-2 grow">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 text-gray-400" fill="currentColor" viewBox="0 0 256 256">
                    <path d="M232.49,80.49l-128,128a12,12,0,0,1-17,0l-56-56a12,12,0,1,1,17-17L96,183,215.51,63.51a12,12,0,0,1,17,17Z"></path>
                </svg>
                <p class="font-semibold text-md w-full text-gray-700">Selesai:</p>
                <p class="text-2xl font-semibold text-gray-">{{ $complaintDone }}</p>
            </div>
            <!-- <div class="grid grid-cols-2 gap-4 p-2 h-96 mt-2">
            <div class="bg-white rounded border-2 flex items-center p-2">
                <div class="flex justify-between items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 256 256"><path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path></svg>                    <div class="order-last">
                        <h1 class="font-semibold text-sm text-gray-500">Belum direspon</h1>
                        <p class="text-2xl font-semibold">{{ $complaintSent }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded border-2 flex items-center p-2">
                <div class="flex justify-between items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 256 256"><path d="M228.44,89.34l-96-64a8,8,0,0,0-8.88,0l-96,64A8,8,0,0,0,24,96V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V96A8,8,0,0,0,228.44,89.34ZM128,41.61l81.91,54.61-67,47.78H113.11l-67-47.78ZM40,200V111.53l65.9,47a8,8,0,0,0,4.65,1.49h34.9a8,8,0,0,0,4.65-1.49l65.9-47V200Z"></path></svg>                    <div class="order-last">
                        <h1 class="font-semibold text-sm text-gray-500">Dibaca</h1>
                        <p class="text-2xl font-semibold">{{ $complaintRead }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded border-2 flex items-center p-2">
                <div class="flex justify-between items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm64-88a8,8,0,0,1-8,8H128a8,8,0,0,1-8-8V72a8,8,0,0,1,16,0v48h48A8,8,0,0,1,192,128Z"></path></svg>                    
                    <div class="order-last">
                        <h1 class="font-semibold text-sm text-gray-500">Direspon</h1>
                        <p class="text-2xl font-semibold">{{ $complaintResponse }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded border-2 flex items-center p-2">
                <div class="flex justify-between items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>                    <div class="order-last">
                        <h1 class="font-semibold text-sm text-gray-500">Selesai</h1>
                        <p class="text-2xl font-semibold">{{ $complaintDone }}</p>
                    </div>
                </div>
            </div>
        </div> -->
        </div>
        <div class="bg-white rounded-lg border border-gray-200 drop-shadow-sm">
            <div class="font-semibold text-gray-800 text-lg p-4 border-b">Keluhan Berdasarkan Kategori</div>
            <canvas class="p-2" id="complaintCategory"></canvas>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 drop-shadow-sm">
            <div class="font-semibold text-gray-800 text-lg p-4 border-b">Frekuensi Keluhan</div>
            <canvas class="p-2" id="dailyComplaint"></canvas>
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
        return complaint.categoryName;
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
                    label: ' ',
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
                },

                // {
                //     label: 'Kemahasiswaan',
                //     data:   data,
                //     backgroundColor: 'rgba(255, 99, 132, 0.2)',
                //     borderColor: 'rgba(255, 99, 132)'
                // }
            ]
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
                label: 'Jumlah Keluhan',
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