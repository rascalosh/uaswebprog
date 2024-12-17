<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Reservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Reservations</h3>
                <div class="grid grid-flow-col auto-cols-max gap-10 overflow-x-auto">
                    @foreach ($reservations as $reservation)
                        <div class="bg-white dark:bg-gray-700 p-4 rounded-lg shadow-md text-wrap">
                            <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200">{{ $reservation->user->full_name }}</h4>
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $reservation->nomor_kamar }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Jenis Kos: {{ $reservation->gender == 'P' ? "Perempuan" : "Laki-Laki" }}</p>
                            <p class="text-gray-600 dark:text-gray-400">User Gender: {{ $reservation->user->gender == 'P' ? "Perempuan" : "Laki-Laki" }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Nomor HP: {{ $reservation->user->no_telp }}</p>
                            <p class="text-gray-600 dark:text-gray-400">Start Date: {{ Carbon\Carbon::parse($reservation->start_date)->format('F j, Y') }}</p>

                            <form id="updateReservationForm" action="{{ route('admin.update_reservation') }}" method="POST">
                                @csrf
                                <div>
                                    <button onclick="openConfirmReservationModal('accept', '{{ $reservation->reservation_id }}')" type="button" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                                        {{ __('Accept') }}
                                    </button>

                                    <button onclick="openConfirmReservationModal('reject', '{{ $reservation->reservation_id }}')" type="button" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">
                                        {{ __('Reject') }}
                                    </button>

                                    <x-input id="reservation_id" type="hidden" name="reservation_id" value='{{ $reservation->reservation_id }}'/>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div id="confirmReservationModal" class="hidden fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="px-4 py-3">
                    <h2 class="text-lg font-semibold">Confirmation</h2>
                    <p>Are you sure of your decision?</p>
                        <div class="flex justify-end mt-4">
                            <button type="button" onclick="closeConfirmReservationModal()" class="text-gray-500 hover:text-gray-800">Cancel</button>
                            <button type="button" onclick="confirmUpdateReservation(); disableSubmitButton(this);" class="ml-2 text-white bg-red-600 hover:bg-red-700 rounded px-4 py-2">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

<script>

    let reservationAction = '';
    let reservationId = '';

    function openConfirmReservationModal(action, id) {
        reservationAction = action;
        reservationId = id;
        document.getElementById('confirmReservationModal').classList.remove('hidden');
    }

    function closeConfirmReservationModal() {
        document.getElementById('confirmReservationModal').classList.add('hidden');
    }

    function disableSubmitButton(button) {
        button.disabled = true;
        button.innerText = "Processing...";
        button.classList.add("opacity-50", "cursor-not-allowed");
    }

    function confirmUpdateReservation(){
        const form = document.getElementById('updateReservationForm');
        const actionInput = document.createElement('input');
        actionInput.type = 'hidden';
        actionInput.name = 'action';
        actionInput.value = reservationAction;

        form.appendChild(actionInput);

        form.reservation_id.value = reservationId;

        form.submit();
    }

</script>
