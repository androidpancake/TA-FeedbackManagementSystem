@extends('template.template')

@section('content')
@if(!$hasFilled)
<div class="flex justify-center">
    <div class="space-y-4 w-full sm:w-1/2 space-y-3 py-24">
        @if ($errors->any())
            <div class="bg-red py-2 px-3">
                <div>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif
        <!-- animate -->
        <div>
            <div class="p-2 flex justify-center">
                <img src="{{ asset('storage/image/clock.png') }}" class="mt-2" alt="">
            </div>
        </div>

        <!-- quick survey -->
        <div class="text-center">
            <h1 class="font-semibold text-lg">Isi quick survey</h1>
            <p class="text-sm font-medium text-gray-500">
                Kami mengharapkan kejujuran anda dalam mengisi jawaban survey, karena jawaban anda menjadi bahan perbaikan kami         
            </p>
            
        </div>

        <!-- dosen-kelas -->
        <div class="flex items-end space-x-2">
            <div class="grow">
                <div class="flex space-x-1 sm:bg-white p-2 border-2 rounded-lg space-x-3">
                    <img src="{{ asset('storage/image/Teacher.png') }}" class="w-6 h-6 sm:w-8 h-8 rounded-full" alt="">
                    <div>
                        @if($survey->class->lecturer)
                        <h1 class="font-semibold">{{ $survey->class->lecturer->name }}</h1>
                        @elseif($survey->class->lab)
                        <h1 class="font-semibold">{{ $survey->class->lab->name }}</h1>
                        @endif
                        <div class="inline-flex items-center space-x-2">
                            <p class="text-sm text-gray-500">{{ $survey->class->course->name }}</p>
                            <p class="text-sm text-gray-500">•</p>
                            <p class="text-sm text-gray-500">{{ $survey->class->name }}</p>
                            <p class="text-sm text-gray-500">•</p>
                            <p class="text-sm text-gray-500">{{ date('d M Y, H:i', strtotime($survey->date)) }}</p>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- date -->
        <div class="flex justify-between">
            <p class="text-sm text-gray-500">Due date</p>
            <p class="text-sm text-gray-500">{{ date('d M Y, H:i', strtotime($survey->limit_date)) }}</p>
        </div>

        <!-- divider -->
        <div class="border-b border-gray-400"></div>
        <!-- rating -->
        <div>
            <h1 class="font-bold text-lg text-center">Bagaimana penilaian Anda terhadap kualitas pengajaran dosen pada sesi ini?</h1>
        </div>
        <form action="{{ route('mahasiswa.survey.send', $survey->id) }}" method="POST">
            @csrf
            <div class="flex justify-center space-x-2 my-3">
                <div class="flex items-center space-x-2">
                    <input type="radio" id="star1" value="1" name="rating">
                    <label for="1" class="text-sm text-gray-800">Sangat kurang</label>
                </div>
                <div class="flex items-center space-x-2">
                    <input type="radio" id="star2" value="2" name="rating">
                    <label for="2" class="text-sm text-gray-800">Kurang</label>

                </div>
                <div class="flex items-center space-x-2">
                    <input type="radio" id="star3" value="3" name="rating">
                    <label for="3" class="text-sm text-gray-800">Cukup</label>

                </div>
                <div class="flex items-center space-x-2">
                    <input type="radio" id="star4" value="4" name="rating">
                    <label for="4" class="text-sm text-gray-800">Puas</label>

                </div>
                <div class="flex items-center space-x-2">
                    <input type="radio" id="star5" value="5" name="rating">
                    <label for="5" class="text-sm text-gray-800">Sangat puas</label>
                </div>
            </div>
            <!-- additional -->
            
        <div class="mb-5 text-lg font-medium text-gray-900 dark:text-white text-center">
            <p id="reasonLow" class="text-gray-900 text-base" style="display: none;">Apa yang perlu ditingkatkan?</p>
            <p id="reasonHigh" class="text-gray-900 text-base" style="display: none;">Apa yang sudah baik?</p>
        </div>
        <ul id="checkboxLow" class="grid w-full gap-2 my-3 md:grid-cols-4" style="display: none;">
            @foreach($reasonLow as $data)
            <li>
                <input type="checkbox" id="reason{{ $data->id }}" value="{{ $data->reason }}" name="additional[]" class="hidden peer">
                <label for="reason{{ $data->id }}" class="inline-flex items-center justify-between w-full p-4 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600">                           
                    <div class="block">
                        <div class="w-full text-base font-semibold">{{ $data->reason }}</div>
                    </div>
                </label>
            </li>
            @endforeach
        </ul>
        <ul id="checkboxHigh" class="grid w-full gap-2 my-3 md:grid-cols-4" style="display: none;">
            @foreach($reasonHigh as $data)
            <li>
                <input type="checkbox" id="reason{{ $data->id }}" value="{{ $data->reason }}" name="additional[]" class="hidden peer">
                <label for="reason{{ $data->id }}" class="inline-flex items-center justify-between w-full p-4 text-gray-500 bg-white border-2 border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-blue-600 hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600">                           
                    <div class="block">
                        <div class="w-full text-base font-semibold">{{ $data->reason }}</div>
                    </div>
                </label>
            </li>
            @endforeach
        </ul>


            <!-- komentar -->
            <label for="" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Jelaskan kepada kami</label>
            <textarea id="message" name="comment" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Berikan pendapat anda..."></textarea>
            <p class="text-sm text-gray-500">Ingatlah untuk menjaga komentar secara konstruktif dan sopan</p>

            <!-- divider -->
            <div class="border-b border-gray-300 py-2"></div>
            <!-- button -->
            <button type="submit" class="w-full bg-green-500 py-2 px-3 mt-3 text-center text-white rounded hover:bg-green-800 focus:ring-4 focus:ring-green-500">Submit</button>
        </form>
    </div>
</div>
@else
<div class="flex justify-center">
    <div class="w-1/2 py-24">
        <p class="text-lg font-semibold text-center">Anda sudah mengisi survey</p>
    </div>
</div>
@endif
@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
@push('star')
<script>
    $(document).ready(function() {
    $('.rating .fa-star').on('click', function() {
        var rating = $(this).data('rating');
        $('#rating').val(rating);
        
        // Mengubah warna bintang
        $('.rating .fa-star').each(function() {
            if ($(this).data('rating') <= rating) {
                $(this).removeClass('text-muted');
                $(this).addClass('text-warning');
            } else {
                $(this).removeClass('text-warning');
                $(this).addClass('text-muted');
            }
        });
    });
});
</script>
@endpush
@push('reason')
<script>
    // Ambil elemen-elemen yang dibutuhkan
    const option1 = document.getElementById('star1');
    const option2 = document.getElementById('star2');
    const option3 = document.getElementById('star3');
    const option4 = document.getElementById('star4');
    const option5 = document.getElementById('star5');
    const checkboxReasonLow = document.getElementById('checkboxLow');
    const checkboxReasonHigh = document.getElementById('checkboxHigh');

    // Tambahkan event listener pada radio button
    option1.addEventListener('change', function() {
        if (option1.checked) {
            checkboxReasonLow.style.display = 'flex'; // Tampilkan checkbox
            checkboxReasonHigh.style.display = 'none'; // Tampilkan checkbox

            reasonLow.style.display = 'flex';
            reasonHigh.style.display = 'none';

        } else {
            checkboxReasonLow.style.display = 'none'; // Sembunyikan checkbox
            reasonLow.style.display = 'none';
        }
    });

    option2.addEventListener('change', function() {
        if (option2.checked) {
            checkboxReasonLow.style.display = 'flex'; // Tampilkan checkbox
            checkboxReasonHigh.style.display = 'none'; // Tampilkan checkbox

            reasonLow.style.display = 'flex';
            reasonHigh.style.display = 'none';

        } else {
            checkboxReasonLow.style.display = 'none'; // Sembunyikan checkbox
            reasonLow.style.display = 'none';
            reasonHigh.style.display = 'none';
        }
    });

    option3.addEventListener('change', function() {
        if (option3.checked) {
            checkboxReasonLow.style.display = 'flex'; // Tampilkan checkbox
            checkboxReasonHigh.style.display = 'none'; // Tampilkan checkbox

            reasonLow.style.display = 'flex';
            reasonHigh.style.display = 'none';

        } else {
            checkboxReasonLow.style.display = 'none'; // Sembunyikan checkbox
            reasonLow.style.display = 'none';
            reasonHigh.style.display = 'none';
        }
    });

    option4.addEventListener('change', function() {
        if (option4.checked) {
            checkboxReasonHigh.style.display = 'flex'; // Tampilkan checkbox
            checkboxReasonLow.style.display = 'none'; // Tampilkan checkbox
            reasonHigh.style.display = 'flex';
            reasonLow.style.display = 'none';

        } else {
            checkboxReasonHigh.style.display = 'none'; // Sembunyikan checkbox
            reasonHigh.style.display = 'none';
            reasonLow.style.display = 'none';

        }
    });

    option5.addEventListener('change', function() {
        if (option5.checked) {
            checkboxReasonHigh.style.display = 'flex'; // Tampilkan checkbox
            checkboxReasonLow.style.display = 'none'; // Tampilkan checkbox
            reasonHigh.style.display = 'flex';

        } else {
            checkboxReasonHigh.style.display = 'none'; // Sembunyikan checkbox
            reasonHigh.style.display = 'none';
            reasonLow.style.display = 'none';


        }
    });
</script>
@endpush
@endsection