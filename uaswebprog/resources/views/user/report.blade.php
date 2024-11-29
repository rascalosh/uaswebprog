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

        <form method="POST" action="{{ route('create-report') }}">
            @csrf

            <div>
                <x-label for="full_name" value="{{ __('Full Name') }}" />
                <x-input id="full_name" class="block mt-1 w-full" type="text" name="full_name" :value="old('full_name')"
                    required autofocus autocomplete="full_name" />
            </div>

            <select name="room" id="room" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a room</option>
                    <option value="1A">1A</option>
                    <option value="1B">1B</option>
                    <option value="2A">2A</option>
                    <option value="2B">2B</option>
                    <option value="2C">2C</option>
                    <option value="2D">2D</option>
                    <option value="3A">3A</option>
                    <option value="3B">3B</option>
                    <option value="3C">3C</option>
                    <option value="3D">3D</option>
                </select>

            <div>
                <x-label for="gender" value="{{ __('Jenis Koa') }}" />
                <select id="gender" name="gender" class="block mt-1 w-full" :value="old('gender')" required
                    autofocus autocomplete="gender">
                    <option value="L">{{ __('Male') }}</option>
                    <option value="P">{{ __('Female') }}</option>
                </select>
            </div>
        
            <div class="mt-4">
                <x-label for="date" value="{{ __('Date') }}" />
                <x-input id="date" class="block mt-1 w-full" type="date" name="date"
                    required />
            </div>

            <div class="mt-4">
                <x-label for="desc_pelaporan" value="{{ __('Issue(s)') }}" />
                <x-textarea id="desc_pelaporan" class="block mt-1 w-full h-40 resize-y" name="desc_pelaporan"
                    required autofocus autocomplete="desc_pelaporan" />
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
