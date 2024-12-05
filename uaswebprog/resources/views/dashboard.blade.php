<?php

use Illuminate\Support\Facades\File;
$imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
$imagesPria = File::files(public_path('images/KamarPria'));

?>

<x-app-layout>

    <!-- Banner Section -->
    <div>
        <div class="mx-auto">
            <div class="bg-white dark:bg-gray-800 overflow-hidden w-full">
                <x-welcome-banner />
            </div>
        </div>
    </div>

<!-- About Section -->
<div class="mt-20 lg:px-28 px-8" data-aos="fade-up">
    <div class="lg:flex lg:items-center lg:gap-12 text-center lg:text-left">
        <!-- Gambar Utama -->
        <div class="lg:w-1/3 mb-8 lg:mb-0 relative flex justify-center">
            <img src="{{ asset('images/aloha.jpeg') }}" alt="Aloha Guest House"
                class="w-80 h-80 lg:w-96 lg:h-96 rounded-xl shadow-xl object-cover transition transform duration-700 ease-in-out hover:scale-110 hover:rotate-3">
            <!-- Gradient Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black opacity-30 rounded-xl"></div>
        </div>

        <!-- Konten -->
        <div class="lg:w-2/3 mt-8 lg:mt-0">
            <h2 class="text-5xl font-extrabold text-gray-900 leading-tight mb-6 animate__animated animate__fadeIn animate__delay-0.5s">
                Welcome to <span class="text-yellow-500 text-6xl">Aloha</span><br>
                <span class="text-gray-800">Guest House</span>
            </h2>
            <p class="text-gray-700 leading-relaxed mb-8 text-lg lg:text-xl font-medium animate__animated animate__fadeIn animate__delay-1s">
                Terletak strategis di Cluster Alloggio, Gading Serpong, Aloha Guest House menawarkan kenyamanan dan
                kemudahan akses ke fasilitas utama, seperti UMN, SDC, dan berbagai tempat makan. Hunian ideal untuk
                mahasiswa dan profesional muda yang mengutamakan kenyamanan dan aksesibilitas. Nikmati pengalaman
                menginap yang tenang dengan fasilitas terbaik untuk memenuhi kebutuhan Anda.
            </p>

            <!-- Call to Action Section -->
            <div class="flex justify-center lg:justify-start mb-8 animate__animated animate__fadeIn animate__delay-1.5s">
                <a href="#contact" 
                   class="inline-block px-8 py-3 border-2 border-yellow-600 text-lg font-semibold text-yellow-600 bg-transparent rounded-lg transition-all duration-300 ease-in-out transform hover:bg-yellow-600 hover:text-white hover:border-yellow-600 hover:scale-105">
                    Contact Us
                </a>
            </div>
        </div>
    </div>



<!-- Fitur dengan Icon -->
<div class="grid lg:grid-cols-3 grid-cols-1 gap-8 mt-12 text-center">
    <!-- Dekat UMN -->
    <div class="flex flex-col items-center bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <img src="https://img.icons8.com/ios/50/000000/university.png" alt="University Icon" class="mb-4 w-16 h-16 mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Dekat UMN dan Pradita</h3>
        <p class="text-gray-600">
            Hanya 5 menit dari Universitas Multimedia Nusantara (UMN) dan Universitas Pradita, menjadikan Aloha Guest House pilihan ideal bagi mahasiswa.
        </p>
    </div>

    <!-- Fasilitas Sekitar -->
    <div class="flex flex-col items-center bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <img src="https://img.icons8.com/ios/50/000000/shopping-basket.png" alt="Shopping Icon" class="mb-4 w-16 h-16 mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Fasilitas Sekitar</h3>
        <p class="text-gray-600">
            Tersedia berbagai tempat makan dan minimarket di sekitar kost untuk memenuhi kebutuhan sehari-hari.
        </p>
    </div>

    <!-- Shuttle Bus -->
    <div class="flex flex-col items-center bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <img src="https://img.icons8.com/ios/50/000000/bus.png" alt="Shuttle Icon" class="mb-4 w-16 h-16 mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Shuttle Bus</h3>
        <p class="text-gray-600">
            Nikmati kemudahan transportasi dengan shuttle bus yang menghubungkan Allogio ke SDC dan Summarecon Mall Serpong (SMS).
        </p>
    </div>

    <!-- Akses ke Lippo Karawaci & Alam Sutera -->
    <div class="flex justify-center flex-col items-center bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <img src="https://img.icons8.com/ios/50/000000/road.png" alt="Road Icon" class="mb-4 w-16 h-16 mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Dekat Lippo Karawaci & Alam Sutera</h3>
        <p class="text-gray-600">
            Aloha Guest House hanya 20 menit dari Lippo Karawaci dan Alam Sutera, memudahkan akses ke berbagai fasilitas utama.
        </p>
    </div>

    <!-- Akses ke BSD City -->
    <div class="flex justify-center flex-col items-center bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <img src="https://img.icons8.com/ios/50/000000/city.png" alt="City Icon" class="mb-4 w-16 h-16 mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Akses ke BSD City</h3>
        <p class="text-gray-600">
            Capai BSD City dalam 30-35 menit, pusat perbelanjaan dan area komersial yang berkembang pesat.
        </p>
    </div>

    <!-- Dekat SMS -->
    <div class="flex flex-col items-center bg-white p-6 rounded-lg shadow-lg transform transition duration-300 hover:scale-105">
        <img src="https://img.icons8.com/ios/50/000000/building.png" alt="Building Icon" class="mb-4 w-16 h-16 mx-auto">
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Dekat SMS</h3>
        <p class="text-gray-600">
            Hanya 5 menit dari Summarecon Mall Serpong (SMS), pusat perbelanjaan terkemuka di kawasan Gading Serpong.
        </p>
    </div>
</div>





    <!-- Rooms Section -->
    <div class="mt-40 lg:px-20 px-6" data-aos="zoom-in">
        <h2 class="text-3xl font-bold mb-6 text-center">OUR FACILITIES</h2>
        <div x-data="{ currentIndex: 0 }" class="relative w-full overflow-hidden">
            <!-- Carousel Container -->
            <div class="flex transition-transform duration-500"
                :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
                @php
                    $imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
                    $chunks = array_chunk($imagesPerempuan, 3); // Bagi gambar ke grup 3 per baris
                @endphp

                @foreach ($chunks as $chunk)
                    <div class="grid grid-cols-3 gap-4 flex-shrink-0 w-full">
                        @foreach ($chunk as $image)
                            <div>
                                <img src="{{ asset('images/KamarPerempuan/' . $image->getFilename()) }}"
                                    alt="Room Image" class="w-full h-48 object-cover rounded shadow-md"
                                    style="width: 40rem; height: 20rem; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Left Button -->
            <button @click="currentIndex = (currentIndex === 0) ? {{ count($chunks) - 1 }} : currentIndex - 1"
                class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-2 rounded-full shadow hover:bg-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Right Button -->
            <button @click="currentIndex = (currentIndex === {{ count($chunks) - 1 }}) ? 0 : currentIndex + 1"
                class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-2 rounded-full shadow hover:bg-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Rooms Section -->
    <div class="mt-16 lg:px-20 px-6" data-aos="zoom-in">
        <h2 class="text-3xl font-bold mb-6 text-center">OUR FACILITIES</h2>
        <div x-data="{ currentIndex: 0 }" class="relative w-full overflow-hidden">
            <!-- Carousel Container -->
            <div class="flex transition-transform duration-500"
                :style="{ transform: `translateX(-${currentIndex * 100}%)` }">
                @php
                    $imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
                    $chunks = array_chunk($imagesPerempuan, 3); // Bagi gambar ke grup 3 per baris
                @endphp

                @foreach ($chunks as $chunk)
                    <div class="grid grid-cols-3 gap-4 flex-shrink-0 w-full">
                        @foreach ($chunk as $image)
                            <div>
                                <img src="{{ asset('images/KamarPerempuan/' . $image->getFilename()) }}"
                                    alt="Room Image" class="w-full h-48 object-cover rounded shadow-md"
                                    style="width: 40rem; height: 20rem; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>

            <!-- Left Button -->
            <button @click="currentIndex = (currentIndex === 0) ? {{ count($chunks) - 1 }} : currentIndex - 1"
                class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-2 rounded-full shadow hover:bg-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <!-- Right Button -->
            <button @click="currentIndex = (currentIndex === {{ count($chunks) - 1 }}) ? 0 : currentIndex + 1"
                class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-300 p-2 rounded-full shadow hover:bg-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>



</x-app-layout>
    <!-- Footer -->
    <footer class="bg-slate-600 text-gray-200 py-1 mt-56">
        <div class="container mx-auto px-6 lg:px-5">
            <div class="lg:flex lg:justify-between">
                <!-- Logo dan Deskripsi -->
                <div class="mb-6 lg:mb-0">
                    <h3 class="text-2xl font-bold mb-1 mt-7">Aloha Guest House</h3>
                    <p class="text-sm">
                        Hunian nyaman dengan lokasi strategis di Gading Serpong. Menyediakan fasilitas terbaik untuk
                        mahasiswa dan profesional muda.
                    </p>
                </div>

                <!-- Link Navigasi -->
                <div class="grid grid-cols-2 gap-4 lg:gap-8 text-sm">
                    <div>
                        <h4 class="font-semibold mb-2 mt-5">Quick Links</h4>
                        <ul>
                            <li><a href="#" class="hover:text-white">Home</a></li>
                            <li><a href="#" class="hover:text-white">Facilities</a></li>
                            <li><a href="#" class="hover:text-white">Contact Us</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2 mt-5">Contact</h4>
                        <ul>
                            <li>Phone: +62 812-3456-7890</li>
                            <li>Email: info@alohaguesthouse.com</li>
                            <li>Address: Gading Serpong, Indonesia</li>
                        </ul>
                    </div>
                </div>
            </div>

            <hr class="my-4 border-gray-700">

            <!-- Hak Cipta -->
            <div class="text-center text-sm">
                © 2024 Aloha Guest House. All rights reserved.
            </div>
        </div>
    </footer>