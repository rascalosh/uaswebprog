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
                            <p class="text-gray-600 dark:text-gray-400">Room Number: {{ $reservation->reservation_id }}</p>

                            <form action="{{ route('admin.update_reservation') }}" method="POST">
                                @csrf
                                <div>
                                    <x-button>
                                        {{ __('Accept') }}
                                    </x-button>

                                    <x-button name="clear_reservation" value="1">
                                        {{ __('Reject') }}
                                    </x-button>
                                </div>

                                <x-input id="reservation_id" type="hidden" name="reservation_id" value='{{ $reservation->reservation_id }}'/>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>

<script>
document.getElementById('user_email').addEventListener('input', function() {
   fetch('/admin/search_email', {
       method: 'POST',
       headers: {
           'Content-Type': 'application/json',
           'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
       },
       body: JSON.stringify({user_email: this.value})
   })
   .then(res => res.json())
   .then(user => {
       const resultDiv = document.getElementById('userResult');
       const decisionForm = document.getElementById('decisionForm');
       if(user) {

           if(user.gender == 'L') gender = "Pria";
           else if(user.gender == 'P') gender = "Perempuan";
           else gender = "None";

           document.getElementById('fullName').textContent = user.full_name || 'None';
           document.getElementById('userEmail').textContent = user.email || 'None';
           document.getElementById('roomNumber').textContent = user.is_reserving || 'None';
           document.getElementById('reservationStatus').textContent = user.is_reserving ? 'Yes' : 'Not Reserving';
           document.getElementById('email_reservation').value = user.email;
           document.getElementById('gender').textContent = gender;
           resultDiv.classList.remove('hidden');

           if (user.is_reserving) {
                decisionForm.classList.remove('hidden');
            } else {
                decisionForm.classList.add('hidden');
            }
       } else {
           resultDiv.classList.add('hidden');
       }
   });
});
</script>
