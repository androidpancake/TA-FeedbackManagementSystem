@extends('template.template')

@section('content')
<h1 class="font-bold text-2xl">Feedback</h1>
    <div class="lg:flex justify-between space-y-2 mt-4 items-start">
        <div class="hidden lg:flex space-x-2">
            <button class="py-2 px-2 bg-gray-200 rounded-lg font-bold text-gray-700 text-sm inline-flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256"><path d="M227.32,28.68a16,16,0,0,0-15.66-4.08l-.15,0L19.57,82.84a16,16,0,0,0-2.42,29.84l85.62,40.55,40.55,85.62A15.86,15.86,0,0,0,157.74,248q.69,0,1.38-.06a15.88,15.88,0,0,0,14-11.51l58.2-191.94c0-.05,0-.1,0-.15A16,16,0,0,0,227.32,28.68ZM157.83,231.85l-.05.14L118.42,148.9l47.24-47.25a8,8,0,0,0-11.31-11.31L107.1,137.58,24,98.22l.14,0L216,40Z"></path></svg>
                <p>Menunggu respon</p>
                <p>{{ $wait }}</p>
            </button>
            <button class="py-2 px-2 rounded font-bold text-gray-700 text-sm inline-flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256"><path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path></svg>                        
                <p>Diproses</p>
                <p>{{ $read }}</p>
            </button>
            <button class="py-2 px-2 rounded font-bold text-gray-700 text-sm inline-flex items-center space-x-1">
                <svg xmlns="http://www.w3.org/2000/svg"class="w-5 h-5 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 256 256"><path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path></svg>                        
                <p>Selesai</p>
                <p>{{ $done }}</p>
            </button>
        </div>
        
        <!-- select < sm screen -->
        <select id="category" class="w-full lg:hidden bg-white border border-gray-300 hover:bg-gray-200 focus:border-green-500 focus:ring-green-300 rounded-lg text-sm px-4 py-2.5 text-center inline-flex justify-start items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-3" fill="#000000" viewBox="0 0 256 256"><path d="M80,64a8,8,0,0,1,8-8H216a8,8,0,0,1,0,16H88A8,8,0,0,1,80,64Zm136,56H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16Zm0,64H88a8,8,0,0,0,0,16H216a8,8,0,0,0,0-16ZM44,52A12,12,0,1,0,56,64,12,12,0,0,0,44,52Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,116Zm0,64a12,12,0,1,0,12,12A12,12,0,0,0,44,180Z"></path></svg>

            <option selected>Terkirim</option>
            <option value="">Terkirim</option>
        </select>

        <div class="flex space-x-2">
            
            <select id="small" class="w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:border-green-500 focus:ring-green-500">
                <option selected>Urutkan</option>
                <option value="US">United States</option>
                <option value="CA">Canada</option>
                <option value="FR">France</option>
                <option value="DE">Germany</option>
            </select>
            <select id="small" class="w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-white focus:ring-green-500 focus:border-green-500">
                <option selected>Filter</option>
                <option value="US">United States</option>
                <option value="CA">Canada</option>
                <option value="FR">France</option>
                <option value="DE">Germany</option>

            </select>
        </div>
    </div>
    
    @forelse($feedback as $data)
    <div href="" class="border-b divide-gray-200 mt-6">
        <div class="border-y sm:bg-white py-6 space-y-3">
            <div class="flex sm:flex justify-between items-center space-x-2">
                <div class="flex md:flex-row items-center justify-start space-x-2">
                    <p>{{ $data->id }}</p>
                    <p class="text-lg font-bold text-gray-800">{{ $data->class->lecturer->name }}</p> 
                    <p class="hidden md:flex text-sm text-gray-500">•</p>
                    <p class="text-sm font-medium text-gray-400">{{ $data->class->course->name }}</p>
                    <p class="hidden md:flex text-sm text-gray-500">•</p>
                    <p class="hidden md:flex text-sm font-medium text-gray-400">{{ $data->class->name }}</p>
                </div>
                <div class="inline-flex space-x-2">
                    <p class="text-sm font-medium text-gray-400">{{ date('D, d M Y, H:i', strtotime($data->created_at)) }}</p>
                    <button id="dropdownDelete" data-dropdown-toggle="dropdownID4" class="hover:bg-gray-200 rounded-full focus:ring-2 ring-green-600 ring-inset">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="#000000" viewBox="0 0 256 256"><path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128Zm56-12a12,12,0,1,0,12,12A12,12,0,0,0,196,116ZM60,116a12,12,0,1,0,12,12A12,12,0,0,0,60,116Z"></path></svg>                            
                    </button>
                    <div id="dropdownID4" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                        <ul aria-labelledby="dropdownDelete" class="py-2 text-sm text-gray-700">
                            <li>
                                <button data-modal-target="modalID2" data-modal-toggle="modalID2" class="w-full px-4 py-2 text-base hover:bg-gray-100">Hapus feedback</button>
                            </li>
                        </ul>
                    </div>
                    <!-- Delete modal -->
                    <div id="modalID2" tabindex="-1" aria-hidden="true" class="fixed top-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 rounded-t dark:border-gray-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 bg-gray-200 rounded-full p-2" fill="currentColor" viewBox="0 0 256 256"><path d="M216,48H176V40a24,24,0,0,0-24-24H104A24,24,0,0,0,80,40v8H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM96,40a8,8,0,0,1,8-8h48a8,8,0,0,1,8,8v8H96Zm96,168H64V64H192ZM112,104v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Zm48,0v64a8,8,0,0,1-16,0V104a8,8,0,0,1,16,0Z"></path></svg>
                                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="modalID2">
                                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-6 space-y-2">
                                    <p class="text-lg font-bold leading-relaxed text-gray-900 dark:text-gray-400">
                                        Hapus umpan balik?
                                    </p>
                                    <p class="text-base leading-relaxed text-gray-500 dark:text-gray-400">
                                        Apakah Anda yakin ingin menghapus umpan balik ini? Aksi ini tidak dapat dibatalkan dan semua data terkait umpan balik ini akan hilang.                                            </p>
                                </div>
                                <!-- Modal footer -->
                                <form action="{{ route('mahasiswa.feedback.delete', $data->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="flex flex-row items-center p-6 space-x-2 border-t border-gray-200 rounded-b">
                                        <a href="" data-modal-hide="modalID2" class="grow text-center bg-white border px-3 py-2 rounded">Batalkan</a>
                                        <button type="submit" class="grow text-center bg-red-600 px-3 py-2 text-white rounded">Hapus</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-col">
                <div class="flex space-x-2">
                    <h2 class="font-bold text-gray-800 text-base">{{ $data->subject }}</h2>

                    <span class="bg-green-100 text-green-800 text-xs font-semibold inline-flex items-center px-2.5 py-0.5 rounded-md mr-2 dark:bg-gray-700 dark:text-gray-400 border border-green-300">
                        <img src="../../../images/Book.png" class="w-4 h-4 mr-1" alt="">
                        {{ $data->category->name }}
                    </span>
                </div>
                <p class="text-sm mt-2 text-gray-500">
                    {{ $data->content }}
                </p>
                <div class="flex items-center space-x-2 mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 256 256"><path d="M140,128a12,12,0,1,1-12-12A12,12,0,0,1,140,128ZM84,116a12,12,0,1,0,12,12A12,12,0,0,0,84,116Zm88,0a12,12,0,1,0,12,12A12,12,0,0,0,172,116Zm60,12A104,104,0,0,1,79.12,219.82L45.07,231.17a16,16,0,0,1-20.24-20.24l11.35-34.05A104,104,0,1,1,232,128Zm-16,0A88,88,0,1,0,51.81,172.06a8,8,0,0,1,.66,6.54L40,216,77.4,203.53a7.85,7.85,0,0,1,2.53-.42,8,8,0,0,1,4,1.08A88,88,0,0,0,216,128Z"></path></svg>
                    <p class="text-sm text-blue-500">1 balasan</p>
 
                    <a href="{{ route('mahasiswa.feedback.detail', $data->id) }}" class="px-2 py-1 border rounded hover:bg-gray-200">Lihat feedback</a>
                </div>
            </div>
        </div>
    </div>
    
    @empty
    <div class="flex justify-center">
        <div class="bg-white h-screen w-full items-center">
            <p class="text-xl text-gray-700">Tidak ada data</p>
        </div>
    </div>
    @endforelse
    <!-- add feedback button + modal -->
    <button data-modal-target="add" data-modal-toggle="add" class="fixed bottom-4 right-3 m-6 w-12 h-12 p-3 bg-green-500 hover:bg-green-800 text-white font-bold py-2 rounded shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 256 256"><path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path></svg>
    </button>
    <div id="add" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-5 rounded-t dark:border-gray-600">
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="add">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form action="{{ route('mahasiswa.feedback.create.dosen') }}" method="GET">
                    @csrf
                    <div class="p-6 space-y-2 items-center">
                        <h2 class="font-semibold text-center">Kirim umpan balik</h2>
                        <p class="text-sm text-center">Pilih salah satu opsi berikut untuk melanjutkan</p>
                        
                        <div class="grid w-full gap-6">
                            <div>
                                <input type="radio" id="dosen" name="page" value="dosen" class="hidden peer" required>
                                <label for="dosen" class="inline-flex items-center justify-between w-full space-x-3 p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">                           
                                    <img src="{{ asset('storage/image/teacher.png') }}" alt="">
                                    <div class="">
                                        <div class="w-full text-base font-semibold">Beri umpan balik ke dosen</div>
                                        <div class="w-full text-sm">Berikan penilaian terhadap pengajaran dan interaksi dengan dosen</div>
                                    </div>
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-3" fill="currentColor" viewBox="0 0 256 256"><path d="M173.66,98.34a8,8,0,0,1,0,11.32l-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35A8,8,0,0,1,173.66,98.34ZM232,128A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"></path></svg>
                                </label>
                            </div>
                            <div>
                                <input type="radio" id="lab" name="page" value="lab" class="hidden peer">
                                <label for="lab" class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                    <img src="{{ asset('storage/image/teacher.png') }}" alt="">
                                        <div class="">
                                            <div class="w-full text-base font-semibold">Beri umpan balik ke lab</div>
                                            <div class="w-full text-sm">Berikan penilaian terhadap pengajaran dan interaksi dengan lab</div>
                                        </div>
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 ml-3" fill="currentColor" viewBox="0 0 256 256"><path d="M173.66,98.34a8,8,0,0,1,0,11.32l-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35A8,8,0,0,1,173.66,98.34ZM232,128A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z"></path></svg>
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex flex-col items-center p-6 space-y-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button type="submit" class="w-full text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Konfirmasi</button>
                        <button data-modal-hide="add" type="button" class="w-full text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Decline</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end feedback modal -->
@endsection