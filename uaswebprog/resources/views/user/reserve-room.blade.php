<x-app-layout>

    @php
        $user = Auth::user();
        $email = $user->email;

        $gender = $user->gender;

        if($gender == 'P') $table = 'kamar_perempuan';
        else $table = 'kamar_pria';

        $rooms = DB::table($table)->select('nomor_kamar', 'email')->get();
    @endphp

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reserve A Room!!!') }}
        </h2>
    </x-slot>

    
    
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <form method="POST" action="{{ route('create-reservation') }}">
                @csrf
                <label for="room" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select an option</label>
                <select name="room" id="room" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a room</option>
                    @foreach($rooms as $room)
                        @if($room->email)
                            <option value="{{ $room->nomor_kamar }}" disabled>
                                {{ $room->nomor_kamar }} (Occupied)
                            </option>
                        @else
                            <option value="{{ $room->nomor_kamar }}">
                                {{ $room->nomor_kamar }}
                            </option>
                        @endif
                    @endforeach
                </select>

                <x-input id="user_email" type="hidden" name="user_email" value="{{$email}}" />

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ms-4">
                        {{ __('Reserve Room') }}
                    </x-button>
                </div>
            </form>
            
        </div>
    </div>


</x-app-layout>