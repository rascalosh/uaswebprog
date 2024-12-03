<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

$imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
$imagesPria = File::files(public_path('images/KamarPria'));

if($gender == "P") $table = "kamar_perempuan";
else $table = "kamar_pria";

$room = DB::table($table)
            ->where('nomor_kamar', $id)
            ->first();
?>

<x-app-layout>
        
    <div class="container mx-auto p-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Left Section (Room Info) -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <!-- Room Image -->
         <div class="w-full bg-gray-300 rounded-lg h-48 mb-4 flex items-center justify-center">
                <img src="{{ asset('images/KamarPerempuan/your_image.jpg') }}" alt="Room Image" class="w-full h-full object-cover rounded-lg">
            </div>

            <h2 class="text-2xl font-semibold text-gray-800">Standard Female Room</h2>
            <p class="text-gray-500 text-sm mb-4">Kos Perempuan | Allogio Barat 3</p>

            <!-- Availability -->
            <p class="text-lg font-bold text-red-600 mb-4">Tersisa 1 Kamar!</p>

            <!-- Divider -->
            <hr class="border-gray-300 mb-6">

            <!-- Room Specifications -->
            <div class="space-y-4 mb-6">
                <h4 class="text-lg font-semibold text-gray-700">Spesifikasi Kamar</h4>
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-gray-600">
                    <li class="flex items-center"><ion-icon name="snow-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>AC</li>
                    <li class="flex items-center"><ion-icon name="bed-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Kasur</li>
                    <li class="flex items-center"><ion-icon name="tv-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>TV</li>
                    <li class="flex items-center"><ion-icon name="wifi-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>WiFi</li>
                    <li class="flex items-center"><ion-icon name="cube-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Lemari</li>
                    <li class="flex items-center"><ion-icon name="resize-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>3x3 m²</li>
                    <li class="flex items-center"><ion-icon name="home-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Lantai 2</li>
                </ul>
            </div>

            <!-- Divider -->
            <hr class="border-gray-300 mb-6">

            <!-- Room Facilities -->
            <div class="space-y-4">
                <h4 class="text-lg font-semibold text-gray-700 mb-4">Fasilitas Kost</h4>
                <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-gray-600">
                    <li class="flex items-center"><ion-icon name="key-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Depan</li>
                    <li class="flex items-center"><ion-icon name="restaurant-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Dapur</li>
                    <li class="flex items-center"><ion-icon name="car-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Parkiran</li>
                    <li class="flex items-center"><ion-icon name="water-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Kamar Mandi</li>
                    <li class="flex items-center"><ion-icon name="thermometer-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Water Heater</li>
                    <li class="flex items-center"><ion-icon name="snow-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>AC</li>
                    <li class="flex items-center"><ion-icon name="desktop-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Meja</li>
                    <li class="flex items-center"><ion-icon name="cube-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>Lemari</li>
                </ul>
            </div>
        </div>

<!-- Right Section (Booking Info) -->
<div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <!-- Title Section -->
    <div class="text-center mb-6">
        <h3 class="text-2xl font-bold text-gray-800 mb-2">Your Reservation</h3>
        <p class="text-xl font-semibold text-green-600">RpX.XXX.XXX /bulan</p>
    </div>

            <!-- Booking Buttons -->
            <div class="flex justify-center space-x-6 mb-6">
                <a href="#" class="block py-3 px-8 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-green-50 hover:text-green-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                    Mulai Kost
                </a>
                <a href="#" class="block py-3 px-8 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                    Tanya Pemilik
                </a>
            </div>


    <!-- Divider -->
    <hr class="border-gray-300 mb-6">

    <!-- Rules Section -->
    <div class="mb-6">
        <h4 class="text-lg font-semibold text-gray-700 mb-3">Peraturan Kost</h4>
        <div class="relative cursor-pointer overflow-hidden rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
            <!-- Image for Peraturan Kost -->
            <img src="{{ asset('images/peraturan_kost.jpg') }}" alt="Peraturan" class="w-full h-48 object-cover rounded-lg hover:scale-105 transition-transform duration-300" onclick="openModal()">
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

function updateImageZoom() {
    const modalImage = document.getElementById('modalImage');
    modalImage.style.transform = `scale(${currentZoom})`;
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

