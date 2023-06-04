@extends('template.dosen.template')

@section('content')
<div class="flex justify-center">
    <div class="space-y-3 w-1/2 py-24">
        <!-- animate -->
        <div>
            <div class="bg-gray-300 pt-4 -pb-1 flex justify-center">
                <img src="{{ asset('storage/image/illustration.png') }}" class="mt-2" alt="">
            </div>
        </div>

        <!-- quick survey -->
        <div class="text-center">
            <h1 class="font-semibold text-lg">Quick Survey Berhasil Dibuat</h1>
            <p class="text-sm text-gray-500">Selamat! quick survey Anda telah berhasil dibuat dan disebarkan ke mahasiswa. Quick survey ini akan ditutup dalam 24 jam setelah dibuat.</p>
            <p class="mt-2 text-sm text-gray-500">Anda dapat berbagi survei dengan mahasiswa menggunakan link atau kode QR berikut</p>
        </div>

        <!-- url -->
        <div class="flex items-end space-x-2">
            <div class="grow">
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">URL Survey</label>
                <input id="surveyUrl" type="text" class="border w-full border-gray-300 bg-gray-50 rounded" placeholder="{{ $survey->url }}" readonly>
            </div>
            <div>
                <button onclick="copyToClipboard()" class="bg-white border py-2 px-3 rounded text-base w-32 hover:bg-gray-100 focus:ring-4 focus:ring-green-200">
                    <p>Copy link</p>
                </button>
            </div>
        </div>

        <!-- qr code -->
        <div>
            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-500 dark:text-white">Kode QR</label>
            <button class="w-full bg-white rounded border py-2 px-3 text-center hover:bg-gray-100 focus:ring-4 focus:ring-green-200">
                <p>Tampilkan QR</p>
            </button>
        </div>

        <!-- divider -->
        <div class="border-b border-gray-400"></div>
        <!-- button -->
        <div>
            <a href="{{ route('lecturer.survey.index') }}" class="block bg-green-500 py-2 px-3 text-white rounded hover:bg-green-800 focus:ring-4 focus:ring-green-500">
                <p class="text-center">Kembali ke menu utama</p>
            </a>
        </div>
    </div>
</div>
@push('copy')
<script>
function copyToClipboard() {
  /* Get the text field */
  var copyText = document.getElementById("surveyUrl");

  /* Select the text field */
  var range = document.createRange();
  range.selectNode(copyText);
  window.getSelection().removeAllRanges(); // clear current selection
  window.getSelection().addRange(range); // to select text

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text" + copyText.textContent);
}
</script>
@endpush
@endsection