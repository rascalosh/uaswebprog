<x-app-layout>
    @php
        $user = Auth::user();
        $email = $user->email;
        $gender = $user->gender;
        if ($gender == 'L') {
            $room = DB::table('kamar_pria')->where('email', $email)->first();
        } elseif ($gender == 'P') {
            $room = DB::table('kamar_perempuan')->where('email', $email)->first();
        }

    @endphp

    @if ($room)
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ $room->nomor_kamar }}
                {{ $room->full_name }}
            </h2>
        </x-slot>

        <div class="mt-5 ms-5 mb-5">
            <h3>Average Rating: {{ $averageRating ? number_format($averageRating, 1) : 'No ratings yet' }}</h3>
        </div>

        <a href="{{ route('report') }}">
            <x-button color="red" class="ms-5 me-5">
                Report a Problem
            </x-button>
        </a>

        <a href="{{ route('guest-form') }}">
            <x-button color="red" class="">
                Guest Form
            </x-button>
        </a>

        <x-button color="red" onclick='confirmDelete()'>
            Cancel Room
        </x-button>

        <form method="POST" action="{{ route('submit-review') }}">
            @csrf
            <div class="mt-5 ms-5">
                <x-label for="review" value="{{ __('Rate the Room') }}" />
                <div class="star-rating">
                    <input type="radio" id="star5" name="review" value="5" /><label for="star5"
                        title="5 stars"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star4" name="review" value="4" /><label for="star4"
                        title="4 stars"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star3" name="review" value="3" /><label for="star3"
                        title="3 stars"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star2" name="review" value="2" /><label for="star2"
                        title="2 stars"><i class="fas fa-star"></i></label>
                    <input type="radio" id="star1" name="review" value="1" /><label for="star1"
                        title="1 star"><i class="fas fa-star"></i></label>
                </div>
            </div>
            <x-button class="mt-4 ms-5">
                {{ __('Submit Rating') }}
            </x-button>
        </form>
    @endif

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
        direction: ltr;
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

    .star-rating input[type="radio"]:checked~label i {
        color: #f5b301;
    }

    .star-rating label:hover i,
    .star-rating label:hover~label i {
        color: #f5b301;
    }
</style>
