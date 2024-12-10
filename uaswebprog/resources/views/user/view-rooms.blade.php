<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

$imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
$imagesPria = File::files(public_path('images/KamarPria'));

$user = Auth::user();

$women = DB::table('kamar_perempuan')->get();
$men = DB::table('kamar_pria')->get();
$is_reserving = FALSE;
$has_room = FALSE;
if($user){
    $is_reserving = $user->is_reserving;
    $has_room = $user->has_room;
}

if($gender == "P"){
    $table = "kamar_perempuan";
    $randomFile = $imagesPerempuan[array_rand($imagesPerempuan)];
    $randomAsset = 'images/KamarPerempuan/' . $randomFile->getFilename();
    $kos_gender = "Kos Perempuan";
}
else{
    $table = "kamar_pria";
    $randomFile = $imagesPria[array_rand($imagesPria)];
    $randomAsset = 'images/KamarPria/' . $randomFile->getFilename();
    $kos_gender = "Kos Pria";
}

$room = DB::table($table)
            ->where('nomor_kamar', $id)
            ->first();

if($room->tipe_kamar == 1){
    $price = 'Rp2.000.000';
    $name = "Premium ";
    $bathroom_facility = "Kamar Mandi Dalam";
}
else{
    $price = 'Rp1.700.000';
    $name = "Standard ";
    $bathroom_facility = "Kamar Mandi Luar";
}

if($gender == "P"){
    $name = $name . "Female Room";
}
else{
    $name = $name . "Male Room";
}

if($room->id_user) $status = "Maaf, Sudah Occupied.";
else $status = "Tersedia!";

$floor = "";
if ($room) {
    $room_number = $room->nomor_kamar;
    
    if (substr($room_number, 0, 1) == '1') {
        $floor = "1st Floor";
    } elseif (substr($room_number, 0, 1) == '2') {
        $floor = "2nd Floor";
    } elseif (substr($room_number, 0, 1) == '3') {
        $floor = "3rd Floor";
    }
}
?>

<x-app-layout>

    @if($is_reserving)
        <div class="flex flex-col min-h-screen">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Section Title -->
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6 text-center">
                        Your Reservation is Pending!
                    </h3>
                    
                    <!-- Content Wrapper -->
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg space-y-6">
                        <!-- Welcome Message -->
                        <h4 class="text-3xl font-semibold text-gray-800 dark:text-gray-200 text-center">
                            The room you reserved is {{ $user->reservation->nomor_kamar }} in the {{ $user->reservation->gender == 'P' ? "Perempuan" : "Laki-Laki" }} section.
                        </h4>
                        <p class="text-lg text-gray-600 dark:text-gray-300 text-center">
                            Enrty Date if Accepted: {{ Carbon\Carbon::parse($user->reservation->start_date)->format('F j, Y') }}.
                        </p>

                        <!-- Button Section -->
                        <div class="flex justify-center space-x-4"">
                            <button onclick="confirmCancel()" 
                            class="py-3 px-8 text-lg text-gray-700 font-semibold border border-gray-300 rounded-lg transition duration-300 ease-in-out 
                                    transform hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 
                                    focus:ring-opacity-50 shadow-lg hover:shadow-xl active:scale-95">
                                Cancel
                            </button>

                            <a href="https://wa.link/71i4rz" 
                            class="py-3 px-8 text-lg text-gray-700 font-semibold border border-gray-300 rounded-lg transition duration-300 ease-in-out 
                                    transform hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 
                                    focus:ring-opacity-50 shadow-lg hover:shadow-xl active:scale-95">
                                Tanya Pemilik
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="cancelModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                    <div class="px-4 py-3">
                        <h2 class="text-lg font-semibold">Confirm Cancellation</h2>
                        <p>Are you sure you want to cancel your reservation?</p>
                        <form method="post" action="{{ route('cancel_reservation') }}">
                            @csrf
                            <div class="flex justify-end mt-4">
                                <button type="button" onclick="closeModal()" class="text-gray-500 hover:text-gray-800">Cancel</button>
                                <button type="submit" name="cancel" class="ml-2 text-white bg-red-600 hover:bg-red-700 rounded px-4 py-2">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    
    @elseif($has_room)
        <div class="flex flex-col min-h-screen">
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <!-- Section Title -->
                    <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6 text-center">
                        You Have a Room!
                    </h3>
                    
                    <!-- Content Wrapper -->
                    <div class="bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg space-y-6">
                        <!-- Welcome Message -->
                        <h4 class="text-3xl font-semibold text-gray-800 dark:text-gray-200 text-center">
                            Welcome, {{ $user->full_name }}!
                        </h4>
                        <p class="text-lg text-gray-600 dark:text-gray-300 text-center">
                            Check out your room here.
                        </p>

                        <!-- Button Section -->
                        <div class="flex justify-center">
                            <a href="{{ route('my_room') }}" 
                            class="py-3 px-8 text-lg text-gray-700 font-semibold border border-gray-300 rounded-lg transition duration-300 ease-in-out 
                                    transform hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 
                                    focus:ring-opacity-50 shadow-lg hover:shadow-xl active:scale-95">
                                Go to My Room
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        
    <div class="container mx-auto p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Section (Room Info) -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" data-aos="flip-left">
            <!-- Room Image -->
         <div class="w-full bg-gray-300 rounded-lg h-48 mb-4 flex items-center justify-center">
                <img src="{{ asset($randomAsset) }}" alt="Room Image" class="w-full h-full object-cover rounded-lg">
            </div>

            <h2 class="text-2xl font-semibold text-gray-800">{{ $name }}</h2>
            <p class="text-gray-500 text-sm mb-4">{{ $kos_gender }} | Allogio Barat 3</p>

            <!-- Availability -->
            <p class="text-lg font-bold text-red-600 mb-4">{{ $status }}</p>

            <!-- Divider -->
            <hr class="border-gray-300 mb-6">

           <!-- Room Specifications -->
           <div class="space-y-4 mb-6">
                <h4 class="text-lg font-semibold text-gray-700">Spesifikasi Kamar</h4>
                    <div class="border border-gray-200 rounded-lg shadow-lg flex flex-col p-4 bg-white mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Kamar {{ $room->nomor_kamar }}</h3>
                        <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-gray-600">
                            <li class="flex items-center"><ion-icon name="snow-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>AC</li>
                            <li class="flex items-center"><ion-icon name="bed-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Kasur</li>
                            <li class="flex items-center"><ion-icon name="tv-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>TV</li>
                            <li class="flex items-center"><ion-icon name="wifi-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>WiFi</li>
                            <li class="flex items-center"><ion-icon name="cube-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Lemari</li>
                            <li class="flex items-center"><ion-icon name="resize-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>3x3 m²</li>
                            <li class="flex items-center"><ion-icon name="home-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>{{ $floor }}</li>
                            <li class="flex items-center"><ion-icon name="water-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>{{ $bathroom_facility }}</li>
                        </ul>
                    </div>
            </div>

            <!-- Divider -->
            <hr class="border-gray-300 mb-6">

            <!-- Room Facilities -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-700 mb-4">Fasilitas Kost</h4>
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-gray-600">
                    <li class="flex items-center"><ion-icon name="key-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Kunci</li>
                    <li class="flex items-center"><ion-icon name="restaurant-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Dapur</li>
                    <li class="flex items-center"><ion-icon name="car-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Parkiran</li>
                    <li class="flex items-center"><ion-icon name="water-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Kamar Mandi</li>
                    <li class="flex items-center"><ion-icon name="thermometer-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Water Heater</li>
                    <li class="flex items-center"><ion-icon name="snow-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>AC</li>
                    <li class="flex items-center"><ion-icon name="desktop-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Televisi</li>
                    <li class="flex items-center"><ion-icon name="cube-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Lemari</li>
                    <li class="flex items-center"><ion-icon name="videocam-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>CCTV</li>
                </ul>
            </div>
        </div>

<!-- Right Section (Booking Info) -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6" data-aos="flip-right">
    <!-- Title Section -->
    <div class="text-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Your Reservation</h3>
        <p class="text-xl font-semibold text-green-600">{{ $price }} /bulan</p>
    </div>

            <!-- Booking Buttons -->
            <div class="flex justify-center space-x-6 mb-6">

                @if(!$room->id_user && !$is_reserving)
                    <div class="block">
                        <button onclick="openReserveModal()" class="w-full py-3 px-8 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-green-50 hover:text-green-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                            Mulai Kost
                        </button>
                    </div>
                @endif

                <a href="https://wa.link/71i4rz" class="block py-3 px-8 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                    Tanya Pemilik
                </a>
            </div>


    <!-- Divider -->
    <hr class="border-gray-300 mb-6">

    <!-- Rules Section -->
    <div class="mb-6">
        <h4 class="text-lg font-semibold text-gray-700 mb-3">PERATURAN KAMAR KOST</h4>
        <div class="relative cursor-pointer overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300 p-4 bg-gray-100">
            <!-- Paragraf untuk Peraturan Kost -->
            <p class="text-gray-600 leading-relaxed">
            1.  Dilarang keras membawa maupun memakai narkoba,minuman keras,berjudi,berbuat kriminal dan
            berbuat asusila.
            <br>
            2. Dilarang merokok didalam kamar atau didalam gedung
            ALOHA dan dilarang membuang softex di closet kamar
            mandi.
            <br>
            3. Penyewa diwajibkan menjaga kebersihan kamar sendiri, jika ingin minta tolong dibersihkan dapat memberitahu pihak
            ALOHA.
            <br>
            4. Penyewa dilarang membawa hewan peliharan yang memiliki
            bulu ( Anjing, Kucing, Hamster, Burung, dan lain - lain ).
            <br>
            5. Orang tua dan keluarga kandung diperbolehkan menginap di kamar penyewa dengan memberitahu pihak ALOHA.
            <br>
            6. Elektronik yang disediakan (TV dan AC) oleh pihak ALOHA
            merupakan tanggung jawab pribadi penyewa kamar dan jika
            terjadi kerusakan merupakan tanggung jawab penyewa.
            <br>
            7. Jika penyewa ingin memaku tembok harap melapor kepada
            pihak ALOHA terlebih dahulu.
            <br>
            8. Listrik token per kamar merupakan tanggung jawab penyewa dan dapat mengisi nya sendiri dengan kebutuhan masing-masing.
            <br>
            9. Tamu dari penyewa kamar dapat menginap dengan melapor
            ke pihak ALOHA terlebih dahulu.
            <br>
            10. Tamu yang menginap di kamar penyewa tidak boleh lawan
            jenis
            <br>
            11. Deposit penyewa merupakan kewajiban yang harus
            diberikan kepada pihak ALOHA.
            <br>
            12. Deposit yang diberikan kepada pihak ALOHA akan di
            gunakan jika terjadi kerusakan dikamar penyewa.
            <br>
            13. Laundry akan diberikan secara gratis dengan maksimal 4
            potong pakaian per hari dan diluar underwear.
            <br>
            14. Demi kenyamanan bersama dilarang membuat kebisingan
            yang melebihi batas.
            <br>
            15. Pembayaran dapat dilakukan per tanggal masuk yang sudah ada di FORM ALOHA.
            <br>
            16. Segala bentuk kehilangan di dalam kamar penyewa bukan
            merupakan tanggung jawab dari pihak ALOHA, penyewa
            diharapkan menjaga barang pribadi masing - masing.
            <br>
            17. Jam berkunjung untuk lawan jenis dibatasi sampai jam
            19.00,karena sesuai peraturan tidak bisa lawan jenis
            menginap di ALOHA. Jika ada lawan jenis melewati jam
            batas mohon laporan kepada pihak ALOHA.
            </p>
        </div>
    </div>


    <!-- Additional Info -->
    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
        <h5 class="text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Catatan:</h5>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            Pastikan Anda membaca dan memahami peraturan sebelum mengajukan sewa. Untuk pertanyaan lebih lanjut, hubungi pemilik melalui tombol "Tanya Pemilik".
        </p>
    </div>
</div>


<!-- Modal for Rules Image -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
    <div class="relative p-6">
        <div class="overflow-hidden" id="imageContainer" style="max-width: 90vw; max-height: 90vh; overflow: auto;">
            <!-- Dynamically load the image here -->
            <img id="modalImage" src="{{ asset('images/peraturan_kost.jpg') }}" alt="Peraturan" class="object-contain w-full h-full transition-transform duration-300" draggable="false">
        </div>

        <!-- Zoom Controls -->
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-6">
            <button onclick="zoomIn()" class="bg-black bg-opacity-60 text-white p-3 rounded-lg shadow-2xl transform transition-all duration-300 hover:bg-opacity-80 hover:scale-110 focus:outline-none active:scale-95">
                <span class="text-2xl font-bold">+</span>
            </button>
            <button onclick="zoomOut()" class="bg-black bg-opacity-60 text-white p-3 rounded-lg shadow-2xl transform transition-all duration-300 hover:bg-opacity-80 hover:scale-110 focus:outline-none active:scale-95">
                <span class="text-2xl font-bold">-</span>
            </button>
        </div>
        <!-- Close Button -->
        <button onclick="closeModal()" class="absolute top-4 right-4 bg-gray-800 text-white p-2 rounded-full">X</button>
    </div>
</div>

<div id="reserveModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen">
        <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
            <div class="px-6 py-4">
                <h2 class="text-lg font-semibold">Reserve Form</h2>
                <form method="POST" action="{{ route('create-reservation') }}">
                    @csrf
                    <!-- Choose a Room -->
                    <div class="mt-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input id="start_date" name="start_date" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" value="{{ now()->toDateString() }}">
                    </div>

                    <x-input id="nomor_kamar" type="hidden" name="nomor_kamar" value="{{ $id }}" />

                    <x-input id="gender" type="hidden" name="gender" value="{{ $gender }}" />

                    <!-- Buttons -->
                    <div class="mt-6 flex justify-end">
                        <button type="button" onclick="closeReserveModal()" class="text-gray-500 hover:text-gray-800 mr-3">Cancel</button>
                        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md shadow-sm hover:bg-indigo-700">RESERVE!!!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <x-footer />
</div>
    
<script>
let currentZoom = 1;
let isDragging = false;
let startX, startY, initialScrollLeft, initialScrollTop;

function openModal() {
    document.getElementById('imageModal').classList.remove('hidden');
    // Ensure image in modal matches the clicked image
    const modalImage = document.getElementById('modalImage');
    modalImage.src = '{{ asset("images/peraturan_kost.jpg") }}';  // Dynamically update image source if needed
}

function closeModal() {
    document.getElementById('imageModal').classList.add('hidden');
}

function zoomIn() {
    currentZoom += 0.1;
    updateImageZoom();
}

function zoomOut() {
    currentZoom = Math.max(0.1, currentZoom - 0.1); // Prevent zooming out too much
    updateImageZoom();
}

function closeModal() {
    const modal = document.getElementById('cancelModal');
    modal.classList.add('hidden');
}

function confirmCancel() {
    const modal = document.getElementById('cancelModal');
    modal.classList.remove('hidden');
}

function updateImageZoom() {
    const modalImage = document.getElementById('modalImage');
    modalImage.style.transform = `scale(${currentZoom})`;
}

function openReserveModal() {
    const modal = document.getElementById('reserveModal');
    modal.classList.remove('hidden');
}

function closeReserveModal() {
    const modal = document.getElementById('reserveModal');
    modal.classList.add('hidden');
}

// Image drag functionality
const imageContainer = document.getElementById('imageContainer');
imageContainer.addEventListener('mousedown', (e) => {
    isDragging = true;
    startX = e.clientX;
    startY = e.clientY;
    initialScrollLeft = imageContainer.scrollLeft;
    initialScrollTop = imageContainer.scrollTop;
    e.preventDefault(); // Prevent image selection
});

imageContainer.addEventListener('mousemove', (e) => {
    if (isDragging) {
        const moveX = e.clientX - startX;
        const moveY = e.clientY - startY;
        imageContainer.scrollLeft = initialScrollLeft - moveX;
        imageContainer.scrollTop = initialScrollTop - moveY;
    }
});

imageContainer.addEventListener('mouseup', () => {
    isDragging = false;
});

imageContainer.addEventListener('mouseleave', () => {
    isDragging = false;
});
</script>

</x-app-layout>

