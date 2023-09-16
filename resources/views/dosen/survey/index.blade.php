@extends('template.dosen.template')

@section('content')
<h1 class="font-bold text-2xl">Quick Survey</h1>
    <div class="flex flex-col space-y-2 space-x-0 lg:flex-row justify-between mt-4 items-center">
        
        <!-- select < sm screen -->
        <div class="flex flex-col w-full space-y-2 lg:hidden">
            <div class="flex space-x-2">
                <select id="category" class="grow bg-white border border-gray-300 hover:bg-gray-200 focus:border-green-500 focus:ring-green-300 rounded-lg text-sm px-4 py-2.5 text-center inline-flex justify-start items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3" fill="#000000" viewBox="0 0 256 256"><path d="M80,64a8,8,0,0,1,8-8H216a8,8,0,0,1,0,16H88A8,8,0,0,1,80,64Zm136,56H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Zm0,64H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16ZM44,52A12,12,0,1,0,56,64,12,12,0,0,0,44,52Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,116Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,180Z"></path></svg>

                    <option selected>Terkirim</option>
                    <option value="">Terkirim</option>
                </select>

                <select id="category" class="grow bg-white border border-gray-300 hover:bg-gray-200 focus:border-green-500 focus:ring-green-300 rounded-lg text-sm px-4 py-2.5 text-center inline-flex justify-start items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3" fill="#000000" viewBox="0 0 256 256"><path d="M80,64a8,8,0,0,1,8-8H216a8,8,0,0,1,0,16H88A8,8,0,0,1,80,64Zm136,56H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Zm0,64H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16ZM44,52A12,12,0,1,0,56,64,12,12,0,0,0,44,52Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,116Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,180Z"></path></svg>

                    <option selected>Terkirim</option>
                    <option value="">Terkirim</option>
                </select>
            </div>
            
            <!-- <form action="{{ route('lecturer.survey.search') }}" method="GET" id="search-form">
                <div class="flex flex-row items-center">
                    @csrf
                    <div class="relative grow">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input datepicker name="start_date" type="date" id="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date start">
                    </div>
                    <span class="mx-4 text-gray-500">to</span>
                    <div class="relative grow">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input datepicker name="end_date" type="date" id="end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5" placeholder="Select date end">
                    </div>
                </div>
            </form> -->


        </div>
        <!-- select > sm -->
        <div class="flex flex-row space-x-2">
            <div class="flex space-x-2">
                <select id="course-select" class="bg-white border border-gray-300 hover:bg-gray-200 focus:border-green-500 focus:ring-green-500 rounded-lg text-sm px-4 py-2.5 text-center inline-flex justify-start items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3" fill="#000000" viewBox="0 0 256 256"><path d="M80,64a8,8,0,0,1,8-8H216a8,8,0,0,1,0,16H88A8,8,0,0,1,80,64Zm136,56H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Zm0,64H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16ZM44,52A12,12,0,1,0,56,64,12,12,0,0,0,44,52Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,116Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,180Z"></path></svg>
                    <option value="" selected>Pilih Mata Kuliah</option>
                    @foreach($course as $data)
                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                    @endforeach
                </select>

                <select id="class-select" class="grow sm:bg-white border border-gray-300 hover:bg-gray-200 focus:border-green-500 focus:ring-green-500 rounded-lg text-sm px-4 py-2.5 text-center inline-flex justify-start items-center" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3" fill="#000000" viewBox="0 0 256 256"><path d="M80,64a8,8,0,0,1,8-8H216a8,8,0,0,1,0,16H88A8,8,0,0,1,80,64Zm136,56H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Zm0,64H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16ZM44,52A12,12,0,1,0,56,64,12,12,0,0,0,44,52Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,116Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,180Z"></path></svg>
                    <option value="" selected>Pilih Kelas</option>
                </select>

                <form action="{{ route('lecturer.survey.index') }}" method="GET">
                    @csrf
                    <select name="type" onchange="this.form.submit()" class="flex justify-between border-gray-300 hover:bg-gray-200 focus:border-green-500 focus:ring-green-500 rounded-lg text-sm px-4 py-2.5">
                        <option value="all">Pilih tipe perkuliahan</option>
                        <option value="online" {{ request()->get('type') == 'online' ? 'selected' : '' }}>Online</option>
                        <option value="onsite" {{ request()->get('type') == 'onsite' ? 'selected' : '' }}>Onsite</option>
                    </select>
                </form>
            </div>
        </div>
        <div class="w-full lg:w-auto">
            <div class="w-full">
                <a href="{{ route('lecturer.survey.create') }}" class="inline-flex space-x-2 p-4 sm:px-3 py-2.5 bg-green-600 text-white rounded">
                    <p>+</p>
                    <p>Buat quick survey</p>
                </a>
            </div>
        </div>
    </div>
    <div class="mt-4">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Kelas
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Tanggal
                                <a href="#"><svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 ml-1" aria-hidden="true" fill="currentColor" viewBox="0 0 320 512"><path d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z"/></svg></a>
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Tipe
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Rating
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Responden
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Komentar
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <div class="flex items-center">
                                Sisa waktu
                            </div>
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Edit</span>
                        </th>
                    </tr>
                </thead>
                
                <tbody id="survey-container">
                    @include('dosen.survey.filter.survey')
                </tbody>
            </table>

            <!-- Navigation -->
            <nav class="flex items-center justify-between pt-4 p-4" aria-label="Table navigation">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $surveys->firstItem() }}</span> to
                <span class="font-semibold text-gray-900 dark:text-white">{{ $surveys->lastItem() }}</span> of
                <span class="font-semibold text-gray-900 dark:text-white">{{ $surveys->total() }}</span>
            </span>
                <ul class="inline-flex items-center -space-x-px">
                    @if ($surveys->currentPage() > 1)
                        <li>
                            <a href="{{ $surveys->previousPageUrl() }}"
                                class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Previous</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>
                    @endif

                    @for ($page = 1; $page <= $surveys->lastPage(); $page++)
                        <li>
                            <a href="{{ $surveys->url($page) }}"
                                class="{{ $page == $surveys->currentPage() ? 'z-10' : '' }} px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                {{ $page }}
                            </a>
                        </li>
                    @endfor

                    @if ($surveys->currentPage() < $surveys->lastPage())
                        <li>
                            <a href="{{ $surveys->nextPageUrl() }}"
                                class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
                                <span class="sr-only">Next</span>
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@push('date-picker')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>
@endpush
@push('select-course')
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script>
    function getAllSurveys() {
        $.ajax({
            url: '/getAllSurvey/', // Ganti URL dengan endpoint yang tepat untuk mendapatkan semua survei
            method: 'GET',
            success: function(response) {
                $('#survey-container').html(response);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    function getSurveyByType(type){
        var type = $('#type').val();
        var url = '/getSurveyByType/';
        if(type) {
            url += type
        } else {
            getAllSurveys();
            return;
        }

        $.ajax({
            url: url, // Ganti URL dengan endpoint yang tepat untuk mendapatkan semua survei
            method: 'GET',
            success: function(response) {
                $('#survey-container').html(response);
                console.log("function called");
            },
            error: function(xhr, status, error) {
                console.log(error);

            },
           
        });
    }

    function getSurveysByClass(classId) {
        var url = '/getSurveyByClass/';
        if (classId) {
            url += classId;
        } else {
            getAllSurveys(); // Memanggil fungsi untuk menampilkan semua survei
            return;
        }

        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                $('#survey-container').html(response);
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    }

    function fetchDataByDate() {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();

        if(start_date === '' || end_date === ''){
            getAllSurveys();
            return;
        }

        $.ajax({
            url: '/dosen/quicksurvey/search',
            type: 'GET',
            data: {
                start_date: start_date,
                end_date: end_date,
            },
            success: function(response) {
                $('#survey-container').html(response);
            },
            error: function(xhr) {
                // Handle error
                console.log(xhr.responseText);
            }
        });
    }

    $(document).ready(function() {
        // Event listener saat memilih mata kuliah
        $('#course-select').change(function() {
            var courseId = $(this).val();
            if (courseId) {
                $('#class-select').prop('disabled', false);

                $.ajax({
                    url: '/getKelas/' + courseId,
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('#class-select').empty().append('<option value="">Pilih Kelas</option>');
                        $.each(response, function(key, value){
                            $('#class-select').append('<option value="'+key+'">'+ value +'</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            } else {
                $('#class-select').prop('disabled', true);
                $('#class-select').empty().append('<option value="">Pilih Kelas</option>');
                getAllSurveys(); // Memanggil fungsi untuk menampilkan semua survei
            }
            
            // Reset tampilan survei saat mata kuliah berubah
            $('#survey-container').empty();
        });

        // Event listener saat memilih kelas
        $('#class-select').change(function() {
            var classId = $(this).val();
            getSurveysByClass(classId);
        });

        $('#type').change(function(){
            var type = $(this).val();
            getSurveyByType(type);
        });

        $('#start_date, #end_date').change(fetchDataByDate);

        // Call fetchDataByDate initially to populate data
        fetchDataByDate();
    });
</script>
@endpush
@push('date')
<!-- <script>
    // Tangkap elemen input dan tombol
    var startDateInput = document.getElementById('start_date');
    var endDateInput = document.getElementById('end_date');
    var searchButton = document.getElementById('search-button');
    var surveyContainer = document.getElementById('survey-container');

    // Tambahkan event listener pada tombol "Submit"
    searchButton.addEventListener('click', function() {
        // Ambil nilai tanggal dari input
        var startDate = startDateInput.value;
        var endDate = endDateInput.value;

        // Bangun URL dengan parameter tanggal
        var url = "{{ route('lecturer.survey.search') }}" + "?start_date=" + startDate + "&end_date=" + endDate;

        // Buat permintaan AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Tangkap respon JSON
                var response = JSON.parse(xhr.responseText);

                // Muat data ke tampilan
                surveyContainer.innerHTML = response.html;
            }
        };

        // Kirim permintaan AJAX
        xhr.send();
    });
</script> -->

<script>
    // Menggunakan JavaScript
    document.getElementById('search-button').addEventListener('click', function() {
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;
        var url = '{{ route("lecturer.survey.search") }}?start_date=' + startDate + '&end_date=' + endDate;

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('survey-container').innerHTML = xhr.responseText;
            }
        };
        xhr.open('GET', url, true);
        xhr.send();
    });

    // Menggunakan jQuery
    $('#search-button').click(function() {
        var startDate = $('#start_date').val();
        var endDate = $('#end_date').val();
        var url = '{{ route("lecturer.survey.search") }}?start_date=' + startDate + '&end_date=' + endDate;

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                $('#survey-container').html(response);
            }
        });
    });
</script>
@endpush
@endsection