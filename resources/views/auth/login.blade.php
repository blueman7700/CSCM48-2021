<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-10 h-10 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}" class="container my-5">
            @csrf

            <div class="container my-3">
                <div class="row form-group justify-content-center mb-3">
                    <!-- Email Address -->
                    <div class="col-8">
                        <label for="email" class="form-label"><b>Email</b></label>
                        <input type="email" id="email" name="email" class="form-control" required autofocus placeholder="{{old('email')}}" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">
                            We'll never share your email with anyone else.
                        </div>
                    </div>
                </div>
                

                <div class="row form-froup justify-content-center mb-3">
                    <!-- Password -->
                    <div class="col-8">
                        <label for="password" class="form-label"><b>Password</b></label>
                        <input type="password" id="password" name="password" class="form-control" required aria-describedby="passHelp">
                        <div id="passHelp" class="formText">
                            Your password must be 8-20 characters long, and must contain at least one Number, Uppercase Character, and Symbol. 
                        </div>
                    </div>
                </div>
                
            </div>

            

            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">

                <button type="submit" class="btn btn-primary">Submit</button>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
