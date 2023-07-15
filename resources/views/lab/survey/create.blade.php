@extends('template.lab.template')
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
        @if ($errors->any())
            <div class="bg-red py-2 px-3">
                <div>
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif
        <form action="{{ route('lab.survey.post') }}" method="POST" class="space-y-4 mt-3">
            @csrf
            <div class="flex flex-col space-y-3">
                <div>
                    <label for="course_id" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Mata Kuliah</label>
                    <select id="course" name="course_id" class="w-full bg-white border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-4 text-start inline-flex justify-between items-center">
                        <option value="">Pilih mata kuliah</option>
                        @foreach($course as $data)    
                            <option value="{{ $data->id }}" class="py-2 px-3 ">
                                <p class="font-bold">{{ $data->code }}-{{ $data->name }}</p>                                
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="kelas" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Kelas</label>
                    <select id="kelas" name="kelas_id" class="w-full bg-white border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-4 text-start inline-flex justify-between items-center" disabled>
                            <option value="id" class="py-2 px-3 ">
                                <div class="flex flex-col space-x-3">
                                    <img src="{ url('storage/images/S__14942228.jpg')}" class="rounded-full w-8 h-8" alt="">
                                    <div>
                                        <p class="font-bold">Piih kelas</p>                                
                                    </div>
                                </div>
                            </option>
                    </select>
                </div>
                <div>
                    <label for="" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Pilih tanggal survey</label>
                    
                    <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input type="date" name="date" value="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                    </div>

                </div>
            </div>
            <div class="border border-gray-200 mt-5"></div>
            <div class="flex justify-end">
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
                url: '/lab/getKelas/'+id,
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