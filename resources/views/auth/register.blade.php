<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="container my-3">
                <div class="row form-group justify-content-center mb-3">
                    <!-- Name -->
                    <div class="col-8">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" type="text" name="name" :value="old('name')" required autofocus />
                    </div>
                </div>

                <div class="row form-froup justify-content-center mb-3">
                    <!-- Email Address -->
                    <div class="col-8">
                        <x-label for="email" :value="__('Email')" />
                        <x-input id="email" type="email" name="email" :value="old('email')" required aria-describedby="emailHelp"/>
                        <div id="emailHelp" class="form-text">
                            We'll never share your email with anyone else.
                        </div>
                    </div>
                </div>

                <div class="row form-froup justify-content-center mb-3">
                    <!-- Password -->
                    <div class="col-8">
                        <x-label for="password" :value="__('Password')" />
                        <x-input id="password" type="password" name="password" required autocomplete="new-password" aria-describedby="passHelp" />
                        <div id="passHelp" class="formText">
                            Your password must be 8-20 characters long, and must contain at least one Number, Uppercase Character, and Symbol. 
                        </div>
                    </div>
                </div>

                <div class="row form-froup justify-content-center mb-3">
                    <!-- Confirm Password -->
                    <div class="col-8">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-input id="password_confirmation" type="password" name="password_confirmation" required />
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="m-4">
                    {{ __('Register') }}
                </x-button>

                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
