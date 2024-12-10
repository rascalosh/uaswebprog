<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

$user = Auth::user();

// Image directories for each gender.
$imagesPerempuan = File::files(public_path('images/KamarPerempuan'));
$imagesPria = File::files(public_path('images/KamarPria'));

$women = DB::table('kamar_perempuan')->get();
$men = DB::table('kamar_pria')->get();
$is_reserving = FALSE;
$has_room = FALSE;
if($user){
    $is_reserving = $user->is_reserving;
    $has_room = $user->has_room;
}
?>

<x-dynamic-component :component="Auth::check() ? 'app-layout' : 'welcome-layout'">

    <!-- If User is Reserving -->
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

                            <a href="https://wa.link/4ee7rb" 
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

    <!-- If User Has Room -->
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
    <div>
        <!-- Welcome Section -->
        <div class="mx-auto">
            <div class="dark:bg-gray-800 overflow-hidden w-full">
                <x-swelcome-banner />
            </div>
        </div>

    <!-- Filter Buttons -->
    <div class="mb-1 flex justify-center space-x-4 mt-16">
        <button 
            onclick="showContent('woman')" 
            class="transition-all duration-300 ease-in-out px-6 py-3 rounded-lg text-gray-700 font-semibold border border-gray-300 bg-white shadow-md hover:bg-yellow-100 hover:shadow-lg hover:-translate-y-1 active:translate-y-0"
            id="woman-btn">
            Kamar Perempuan
        </button>
        <button 
            onclick="showContent('man')" 
            class="transition-all duration-300 ease-in-out px-6 py-3 rounded-lg text-gray-700 font-semibold border border-gray-300 bg-white shadow-md hover:bg-yellow-100 hover:shadow-lg hover:-translate-y-1 active:translate-y-0"
            id="man-btn">
            Kamar Laki-Laki
        </button>
    </div>

        <!-- Dynamic Content Section -->
        <div id="content-woman" class="hidden">
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @php
                    $i = 0;
                @endphp

                @foreach ($women as $room)
                    @php
                        $randomFile = $imagesPerempuan[array_rand($imagesPerempuan)];
                        $randomAsset = 'images/KamarPerempuan/' . $randomFile->getFilename();
                        if($room->tipe_kamar == 1){
                            $features = ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju', 'Kamar Mandi Dalam'];
                            $price = 'Rp. 2.000.000,00';
                            $name = "Premium Female Room";
                        }
                        else{
                            $features = ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'];
                            $price = 'Rp. 1.700.000,00';
                            $name = "Standard Female Room";
                        }
                        if($room->id_user) $status = "TANYA PEMILIK";
                        else $status = "READY";

                        if($i < 2) $floor = "1st Floor";
                        else if($i < 6) $floor = "2nd Floor";
                        else $floor = "3rd Floor";

                        $i++;
                    @endphp

                <div class="border border-gray-200 rounded-lg shadow-lg flex flex-col p-4 bg-white" data-aos="fade-up">
                    <!-- Room Image -->
                    <div class="w-full bg-gray-300 rounded-lg h-32 mb-4 flex items-center justify-center">
                        <img src="{{ asset($randomAsset) }}" class="w-full h-full object-cover rounded-lg">
                    </div>
                    <!-- Room Details -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">({{ $room->nomor_kamar }}) {{$name}}</h3>
                        <!-- Grid for Features -->
                        <div class="grid grid-cols-2 gap-y-4 gap-x-2 text-sm text-gray-600 mb-4">
                            @foreach ($features as $feature)
                                <div class="flex items-center">
                                    <ion-icon name="checkmark-circle-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>
                                    <span>{{ $feature }}</span>
                                </div>
                            @endforeach
                        </div>
                        <p class="text-sm text-gray-500">Lantai: {{ $floor }}</p>
                    </div>
                    <!-- Room Status -->
                    <div class="mt-4">
                        <p class="text-lg font-bold text-gray-700 mb-2">{{ $price }}</p>
                        <a href="{{ route('view_rooms', ['id' => $room->nomor_kamar, 'gender' => 'P']) }}" class="text-sm px-3 py-1 rounded-full inline-block 
                                {{ $room->id_user ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                            {{ $status }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div id="content-man" class="hidden">
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @php
                    $i = 0;
                @endphp

                @foreach ($men as $room)
                    @php
                        $randomFile = $imagesPria[array_rand($imagesPria)];
                        $randomAsset = 'images/KamarPria/' . $randomFile->getFilename();
                        if($room->tipe_kamar == 1){
                            $features = ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju', 'Kamar Mandi Dalam'];
                            $price = 'Rp. 2.000.000,00';
                            $name = "Premium Male Room";
                        }
                        else{
                            $features = ['AC', 'WiFi', 'Meja', 'Kasur', 'Lemari Baju'];
                            $price = 'Rp. 1.700.000,00';
                            $name = "Standard Male Room";
                        }
                        if($room->id_user) $status = "TANYA PEMILIK";
                        else $status = "READY";

                        if($i < 2) $floor = "1st Floor";
                        else if($i < 6) $floor = "2nd Floor";
                        else $floor = "3rd Floor";

                        $i++;
                    @endphp

                    <div class="border border-gray-200 rounded-lg shadow-lg flex flex-col p-4 bg-white" data-aos="fade-up">
                        <!-- Room Image -->
                        <div class="w-full bg-gray-300 rounded-lg h-32 mb-4 flex items-center justify-center">
                            <img src="{{ asset($randomAsset) }}" class="w-full h-full object-cover rounded-lg">
                        </div>
                        <!-- Room Details -->
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">({{ $room->nomor_kamar }}) {{$name}}</h3>
                            <!-- Grid for Features -->
                            <div class="grid grid-cols-2 gap-y-4 gap-x-2 text-sm text-gray-600 mb-4">
                                @foreach ($features as $feature)
                                    <div class="flex items-center">
                                        <ion-icon name="checkmark-circle-outline" class="w-5 h-5 mr-2 text-gray-700"></ion-icon>
                                        <span>{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-sm text-gray-500">Lantai: {{ $floor }}</p>
                        </div>
                        <!-- Room Status -->
                        <div class="mt-4">
                            <p class="text-lg font-bold text-gray-700 mb-2">{{ $price }}</p>
                            <a href="{{ route('view_rooms', ['id' => $room->nomor_kamar, 'gender' => 'L']) }}" class="text-sm px-3 py-1 rounded-full inline-block 
                                    {{ $room->id_user ? 'bg-red-100 text-red-700 hover:bg-red-200' : 'bg-green-100 text-green-700 hover:bg-green-200' }}">
                                {{ $status }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @endif

    <x-footer />
</x-dynamic-component>

<!-- JavaScript to Filter Content -->
<script>
    function closeModal() {
        const modal = document.getElementById('cancelModal');
        modal.classList.add('hidden');
    }

    function confirmCancel() {
        const modal = document.getElementById('cancelModal');
        modal.classList.remove('hidden');
    }

    // Display women rooms by default
    document.addEventListener('DOMContentLoaded', function() {
        showContent('woman');
    });

    function showContent(type) {
        const womanContent = document.getElementById('content-woman');
        const manContent = document.getElementById('content-man');
        const womanBtn = document.getElementById('woman-btn');
        const manBtn = document.getElementById('man-btn');

        if (type === 'woman') {
            womanContent.classList.remove('hidden');
            manContent.classList.add('hidden');
            womanBtn.classList.add('active');
            manBtn.classList.remove('active');
        } else if (type === 'man') {
            womanContent.classList.add('hidden');
            manContent.classList.remove('hidden');
            womanBtn.classList.remove('active');
            manBtn.classList.add('active');
        }

     // Optional: Refresh AOS if using animations
    setTimeout(() => {
        if (typeof AOS !== 'undefined') {
            AOS.refresh();
        }
    }, 10);
}
</script>

<style>
    .active {
        background-color: #fbbf24;
        color: #ffff;
        box-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
    }
</style>
