@extends('template.dosen.template')
@section('content')
<div class="flex justify-center">
    <div class="flex-col w-1/2 space-y-3">
        <div class="flex justify-start items-center space-x-4">
            <!-- icon -->
            <div>
                <img src="{{ asset('storage/image/Teacher.png') }}" class="w-full" alt="">
            </div>
            <!-- title & desc -->
            <div>
                <div class="flex flex-col items-start">
                    <h1 class="font-semibold text-xl">Buat Quick Survey</h1>

                    <div class="inline-flex space-x-2">
                        <p class="text-gray-500 text-sm">Berikan kesempatan kepada mahasiswa untuk berbagi pandangan, pendapat, dan masukan mereka</p>
                    </div>
                    
                </div>
            </div>
        </div>
        <form action="{{ route('lecturer.survey.post') }}" method="POST" class="space-y-4 mt-3">
            @csrf
            @method('POST')
            <div class="flex flex-col space-y-3">
                <div>
                    <label for="course_id" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Mata Kuliah</label>
                    <select id="course" name="course_id" class="w-full bg-white border border-gray-200 hover:bg-gray-100 focus:border-green-500 focus:ring-green-500 font-medium rounded-lg text-sm px-5 py-4 text-start inline-flex justify-between items-center">
                        <option value="">Pilih mata kuliah</option>
                        @foreach($course as $data)    
                            <option value="{{ $data->id }}" class="py-2 px-3 ">
                                <p class="font-bold">{{ $data->code }}-{{ $data->name }}</p>                                
                            </option>
                        @endforeach
                    </select>
                    @error('course_id')
                    <div class="pt-2 text-sm text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="kelas" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Kelas</label>
                    <select id="kelas" name="kelas_id" class="w-full bg-white border border-gray-200 hover:bg-gray-100 focus:border-green-500 focus:ring-green-500 font-medium rounded-lg text-sm px-5 py-4 text-start inline-flex justify-between items-center" disabled>
                            <option value="id" class="py-2 px-3 ">
                                <div class="flex flex-col space-x-3">
                                    <img src="{ url('storage/images/S__14942228.jpg')}" class="rounded-full w-8 h-8" alt="">
                                    <div>
                                        <p class="font-bold">Piih kelas</p>                                
                                    </div>
                                </div>
                            </option>
                    </select>
                    @error('kelas_id')
                    <div class="pt-2 text-sm text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Pilih tanggal survey</label>
                    
                    <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="date" name="date" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                    </div>
                    @error('date')
                    <div class="pt-2 text-sm text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Pilih tipe survey</label>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        <li>
                            <input type="radio" id="online" name="type" value="online" class="hidden peer">
                            <label for="online" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">                           
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Online</div>
                                    <div class="w-full">Ketika anda mengajar dengan metode online</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="onsite" name="type" value="onsite" class="hidden peer">
                            <label for="onsite" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Onsite</div>
                                    <div class="w-full">Ketika anda mengajar dengan metode onsite</div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" aria-hidden="true" fill="none" viewBox="0 0 256 256">
                                    <path d="M176.49,95.51a12,12,0,0,1,0,17l-56,56a12,12,0,0,1-17,0l-24-24a12,12,0,1,1,17-17L112,143l47.51-47.52A12,12,0,0,1,176.49,95.51ZM236,128A108,108,0,1,1,128,20,108.12,108.12,0,0,1,236,128Zm-24,0a84,84,0,1,0-84,84A84.09,84.09,0,0,0,212,128Z"></path>
                                </svg>
                            </label>
                        </li>
                    </ul>
                    @error('type')
                    <div class="pt-2 text-sm text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="border border-gray-200 mt-5"></div>
            <div class="bg-blue-200 p-4 rounded-lg">
                <h1 class="font-semibold">Informasi</h1>
                <div class="inline-flex">
                    <p class="font-base flex-wrap">Pertanyaan yang akan diajukan yaitu bertujuan untuk mengukur peforma pengajaran anda.</p>
                </div>
            </div>
            <div class="flex justify-between">
                
                <!-- Modal toggle -->
                <button data-modal-target="defaultModal" data-modal-toggle="defaultModal" class="block text-blue-500 font-medium rounded-lg text-sm text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                    tentang survey
                </button>

                <!-- Main modal -->
                <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Survey Pengajaran Dosen
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="defaultModal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6 space-y-6">
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    Survey peforma pengajaran dosen
                                </p>
                                <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                    Survey ini bertujuan untuk menilai peforma dari pengajaran dosen yang mana dapat menjadi bahan evaluasi pembelajaran dan pengajaran.
                                </p>
                            </div>
                            <!-- Modal footer -->
                            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button data-modal-hide="defaultModal" type="button" class="text-white bg-green-500 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Saya mengerti</button>
                                <button data-modal-hide="defaultModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="bg-green-500 py-2 px-4 h-auto rounded-lg text-white text-sm">Buat Quick Survey</button>
            </div>
        </form>
    </div>
</div>
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endpush
@push('select')
<script type="text/javascript">
$(document).ready(function() {
    $('#course').change(function() {
        var id = $(this).val();
        if(id) {
            $('#kelas').prop('disabled', false); // Enable the class select box
            $.ajax({
                url: '/getKelas/'+id,
                type: "GET",
                dataType: "json",
                success:function(data) {
                    $('#kelas').empty();
                    $('#kelas').append('<option value="">Pilih Kelas</option>');
                    $.each(data, function(key, value) {
                        $('#kelas').append('<option value="'+ key +'">'+ value +'</option>');
                    });
                }
            });
        } 
        else 
        {
            $('#kelas').prop('disabled', false); // Disable the class select box
        }
    });
});
</script>
@endpush
@endsection