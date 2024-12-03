<x-app-layout>
    @php
        $user = Auth::user();
        $email = $user->email;
        $gender = $user->gender;

        // Retrieve user-specific room data based on gender and email
        if ($gender == 'L') {
            $room = DB::table('kamar_pria')->where('email', $email)->first();
        } elseif ($gender == 'P') {
            $room = DB::table('kamar_perempuan')->where('email', $email)->first();
        }

        // Retrieve payment due date (assuming it's based on the 'deadline bayar' field)
        $paymentDue = '15 Desember 2024';
    @endphp

    @if ($room)
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $room->nomor_kamar }} - {{ $room->full_name }}
            </h2>
        </x-slot>

        <!-- Room Information Section -->
        <div class="mt-5 ms-5 mb-5 flex gap-8">
            <!-- Room Image -->
            <div class="w-1/3">
                <img src="https://via.placeholder.com/600x400/gray/FFFFFF/?text=Room+Image" alt="Room Image" class="w-full h-auto rounded-lg shadow-md">
            </div>

            <!-- Personal Information -->
            <div class="w-2/3 mt-5 p-4 bg-gray-100 rounded-lg shadow-md">
                <h4 class="font-semibold text-lg">Personal Information</h4>
                <p>Name: Jap Calvin</p>
                <p>Phone: 089513598982</p>
                <p>Date of Entry: 15 November 2024</p>

                <!-- Payment Due -->
                <h4 class="font-semibold text-lg mt-2">Payment Due</h4>
                <p class="text-red-600 font-medium">{{ $paymentDue }}</p>
            </div>
        </div>

 <!-- Action Buttons Section -->
        <div class="mt-5 flex justify-center flex-wrap gap-4 ms-5">
            <!-- Report a Problem Button -->
            <a href="{{ route('report') }}">
                <x-button class="block py-3 px-8 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                    Report a Problem
                </x-button>
            </a>

            <!-- Notify Guest Button -->
            <a href="{{ route('guest-form') }}">
                <x-button class="block py-3 px-8 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                    Notify Guest
                </x-button>
            </a>

            <!-- Cancel Room Button -->
            <x-button class="block py-3 px-8 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95" onclick="confirmDelete()">
                Cancel Room
            </x-button>
        </div>

        <!-- Review Form Section -->
        <form method="POST" action="{{ route('submit-review') }}" class="mt-5 ms-5 mb-5 flex justify-center">
            @csrf
            <x-label for="review" value="{{ __('Rate the Room') }}" class="mx-3 mt-4"/>
            <div class="star-rating">
                <input type="radio" id="star5" name="review" value="5" /><label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star4" name="review" value="4" /><label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star3" name="review" value="3" /><label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star2" name="review" value="2" /><label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star1" name="review" value="1" /><label for="star1" title="1 star"><i class="fas fa-star"></i></label>
            </div>
            <x-button class="mt-3 ml-3 py-1 px-4 text-center text-gray-700 font-medium border border-gray-300 rounded-lg transform transition-all duration-300 ease-in-out hover:bg-yellow-50 hover:text-yellow-600 hover:scale-105 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-opacity-50 shadow-md hover:shadow-lg active:scale-95">
                {{ __('Submit Rating') }}
            </x-button>
        </form>
    @else
        <p class="mt-5 ms-5 text-gray-600">No room found. Please contact support.</p>
    @endif

    <!-- Modal for Cancellation -->
    <div id="cancelModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="px-4 py-3">
                    <h2 class="text-lg font-semibold">Confirm Cancellation</h2>
                    <p>Are you sure you want to cancel your room?</p>
                    <form method="post" action="{{ route('cancel_room') }}">
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
</x-app-layout>

<script>
    function closeModal() {
        const modal = document.getElementById('cancelModal');
        modal.classList.add('hidden');
    }

    function confirmDelete() {
        const modal = document.getElementById('cancelModal');
        modal.classList.remove('hidden');
    }
</script>

<style>
    .star-rating {
        display: inline-block;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        font-size: 2em;
        color: #ddd;
        cursor: pointer;
    }

    .star-rating input[type="radio"]:checked ~ label i {
        color: #f5b301;
    }

    .star-rating label:hover i,
    .star-rating label:hover ~ label i {
        color: #f5b301;
    }
</style>
