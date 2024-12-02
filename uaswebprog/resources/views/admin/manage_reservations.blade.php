<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manage Reservations') }}
        </h2>
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('admin.search_email') }}" onsubmit="return false;">
                @csrf

                <div>
                    <x-label for="user_email" value="{{ __('Search Email') }}" />
                    <x-input id="user_email" class="block mt-1 w-full" type="text" name="user_email"
                        required autofocus />
                </div>
            </form>

            <div id="userResult" class="hidden mt-4 p-4 bg-white shadow rounded">
                <p>Full Name: <span id="fullName"></span></p>
                <p>Email: <span id="userEmail"></span></p>
                <p>Is Reserving: <span id="reservationStatus"></span></p>
                <p>Room: <span id="roomNumber"></span></p>
                <p>Gender: <span id="gender"></span></p>

                <form id="decisionForm" action="{{ route('admin.update_reservation') }}" method="POST" class="hidden">
                    @csrf
                    <div>
                        <x-button>
                            {{ __('Accept') }}
                        </x-button>

                        <x-button name="clear_reservation" value="1">
                            {{ __('Reject') }}
                        </x-button>
                    </div>

                    <x-input id="email_reservation" type="hidden" name="email_reservation"/>
                </form>

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
