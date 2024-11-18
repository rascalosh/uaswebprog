<x-guest-layout>

    @php
        $user = Auth::user();
        $email = $user->email;
    @endphp

    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('create-guest') }}">
            @csrf

            <div>
                <x-label for="guest_name" value="{{ __('Guest Name') }}" />
                <x-input id="guest_name" class="block mt-1 w-full" type="text" name="guest_name" :value="old('guest_name')"
                    required autofocus autocomplete="guest_name" />
            </div>

            <div>
                <x-label for="room" value="{{ __('Room') }}" />
                <x-input id="room" class="block mt-1 w-full" type="text" name="room" :value="old('room')"
                    required autofocus />
            </div>

            <div>
                <x-label for="gender" value="{{ __('Gender Kamar') }}" />
                <select id="gender" name="gender" class="block mt-1 w-full" :value="old('gender')" required
                    autofocus autocomplete="gender">
                    <option value="L">{{ __('Male') }}</option>
                    <option value="P">{{ __('Female') }}</option>
                </select>
            </div>
        
            <div class="flex justify-between">

                <div class="mt-4">
                    <x-label for="date" value="{{ __('Date') }}" />
                    <x-input id="date" class="block mt-1 w-full" type="date" name="date"
                        required />
                </div>

                <div class="mt-4">
                    <x-label for="amount" value="{{ __('# of Person') }}" />
                    <x-input id="amount" class="block mt-1 w-full" type="number" name="amount" min="0"
                        required />
                </div>

            </div>

            <div class="mt-4">
                <x-label for="relation" value="{{ __('Relation') }}" />
                <x-input id="relation" class="block mt-1 w-full" type="text" name="relation" :value="old('relation')"
                    required autofocus />
            </div>

            <x-input id="user_email" type="hidden" name="user_email" value="{{$email}}" />

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Submit') }}
                </x-button>
            </div>

        </form>
    </x-authentication-card>
</x-guest-layout>
