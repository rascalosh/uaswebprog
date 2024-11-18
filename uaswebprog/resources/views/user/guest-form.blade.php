<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('create-guest') }}">
            @csrf

            <div>
                <x-label for="full_name" value="{{ __('Guest Name') }}" />
                <x-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" :value="old('full_name')"
                    required autofocus autocomplete="name" />
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
                    <x-label for="person" value="{{ __('# of Person') }}" />
                    <x-input id="person" class="block mt-1 w-full" type="number" name="person" min="0"
                        required />
                </div>

            </div>

            <div class="mt-4">
                <x-label for="relation" value="{{ __('Relation') }}" />
                <x-input id="relation" class="block mt-1 w-full" type="text" name="relation" :value="old('relation')"
                    required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ms-4">
                    {{ __('Submit') }}
                </x-button>
            </div>

        </form>
    </x-authentication-card>
</x-guest-layout>
