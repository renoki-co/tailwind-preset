@extends('layouts.app')

@section('content')
<div class="container mx-auto mb-6">
  <div class="mx-auto text-center leading-snug">
    <svg
      class="w-16 h-16 mx-auto"
      viewBox="0 0 24 24"
    >
      <path
        fill="currentColor"
        d="M21.7 6.53C21.71 6.55 21.71 6.58 21.71 6.61V10.9C21.71 11 21.65 11.12 21.56 11.17L17.95 13.25V17.36C17.95 17.47 17.9 17.57 17.8 17.63L10.28 21.96C10.26 21.97 10.24 22 10.22 22L10.2 22C10.15 22 10.09 22 10.04 22C10.03 22 10 22 10 22C10 22 10 21.97 9.96 21.96L2.44 17.63C2.35 17.58 2.29 17.47 2.29 17.36V4.5C2.29 4.45 2.29 4.42 2.3 4.4C2.3 4.39 2.31 4.38 2.31 4.37C2.31 4.35 2.32 4.34 2.33 4.32C2.33 4.31 2.34 4.3 2.35 4.29C2.36 4.28 2.37 4.27 2.38 4.26C2.39 4.25 2.4 4.24 2.41 4.23C2.42 4.22 2.43 4.21 2.44 4.21L6.2 2.04C6.3 2 6.42 2 6.5 2.04L10.28 4.21H10.28C10.29 4.22 10.3 4.22 10.31 4.23C10.32 4.24 10.33 4.25 10.34 4.26C10.35 4.27 10.36 4.28 10.37 4.29C10.38 4.3 10.39 4.31 10.39 4.32C10.4 4.34 10.41 4.35 10.41 4.37C10.41 4.38 10.42 4.39 10.42 4.4C10.43 4.43 10.43 4.45 10.43 4.5V12.5L13.57 10.72V6.61C13.57 6.58 13.57 6.55 13.58 6.53L13.59 6.5C13.59 6.5 13.6 6.47 13.61 6.45C13.61 6.44 13.62 6.43 13.63 6.42C13.64 6.41 13.65 6.4 13.66 6.39C13.67 6.38 13.68 6.37 13.69 6.36C13.7 6.35 13.71 6.34 13.72 6.34L17.5 4.17C17.58 4.11 17.7 4.11 17.8 4.17L21.56 6.34C21.57 6.34 21.58 6.35 21.59 6.36L21.62 6.39C21.63 6.4 21.64 6.41 21.65 6.42C21.66 6.43 21.66 6.44 21.67 6.45C21.68 6.47 21.68 6.5 21.69 6.5C21.7 6.5 21.7 6.5 21.7 6.53M21.09 10.72V7.15L17.95 8.95V12.5L21.09 10.72M17.33 17.18V13.6L10.43 17.54V21.15L17.33 17.18M2.91 5V17.18L9.81 21.15V17.54L6.21 15.5L6.2 15.5L6.2 15.5C6.19 15.5 6.18 15.5 6.17 15.47C6.16 15.47 6.15 15.46 6.14 15.45V15.45C6.13 15.44 6.12 15.43 6.11 15.42C6.1 15.41 6.1 15.4 6.09 15.39V15.39C6.08 15.37 6.08 15.36 6.07 15.35C6.07 15.33 6.06 15.32 6.06 15.31C6.05 15.3 6.05 15.28 6.05 15.27C6.05 15.25 6.05 15.24 6.05 15.23V6.82L2.91 5M6.36 2.68L3.23 4.5L6.36 6.28L9.5 4.5L6.36 2.68M9.81 12.88V5L6.67 6.82V14.69L9.81 12.88M17.64 4.8L14.5 6.61L17.64 8.41L20.77 6.61L17.64 4.8M17.33 8.95L14.19 7.15V10.72L17.33 12.5V8.95M10.12 17L17 13.06L13.88 11.26L7 15.23L10.12 17Z"
      />
    </svg>

    <div class="font-black text-2xl mt-2">
      {{ __('Create a new account') }}
    </div>

    @if (Route::has('login'))
      <div class="mt-2">
        Or
        <a
          href="{{ route('login') }}"
          class="text-blue-600 hover:text-blue-700 focus:outline-none"
        >
          {{ __('sign in with your account') }}
        </a>
      </div>
    @endif
  </div>

  <div class="flex flex-wrap justify-center mt-6">
    <div class="w-full max-w-md px-3 md:px-0">
      <div class="flex flex-col break-words bg-white border rounded-lg shadow-md p-6">
        <form
          class="w-full"
          method="POST"
          action="{{ route('register') }}"
        >
          @csrf

          <div class="flex flex-wrap mb-6">
            <label
              for="name"
              class="block text-gray-700 text-sm font-bold mb-2"
            >
              {{ __('Name') }}
            </label>

            <input
              id="name"
              type="text"
              class="border focus:border-gray-500 focus:outline-none px-3 py-2 rounded-lg shadow-sm w-full @error('name') border-red-500 @enderror"
              name="name"
              value="{{ old('name') }}"
              required
              autocomplete="name"
              autofocus
            >

            @error('name')
              <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
              </p>
            @enderror
          </div>

          <div class="flex flex-wrap mb-6">
            <label
              for="email"
              class="block text-gray-700 text-sm font-bold mb-2"
            >
              {{ __('E-Mail Address') }}
            </label>

            <input
              id="email"
              type="email"
              class="border focus:border-gray-500 focus:outline-none px-3 py-2 rounded-lg shadow-sm w-full @error('email') border-red-500 @enderror"
              name="email"
              value="{{ old('email') }}"
              required
              autocomplete="email"
            >

            @error('email')
              <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
              </p>
            @enderror
          </div>

          <div class="flex flex-wrap mb-6">
            <label
              for="password"
              class="block text-gray-700 text-sm font-bold mb-2"
            >
              {{ __('Password') }}
            </label>

            <input
              id="password"
              type="password"
              class="border focus:border-gray-500 focus:outline-none px-3 py-2 rounded-lg shadow-sm w-full @error('password') border-red-500 @enderror"
              name="password"
              required
              autocomplete="new-password"
            >

            @error('password')
              <p class="text-red-500 text-xs italic mt-2">
                {{ $message }}
              </p>
            @enderror
          </div>

          <div class="flex flex-wrap mb-6">
            <label
              for="password-confirm"
              class="block text-gray-700 text-sm font-bold mb-2"
            >
              {{ __('Confirm Password') }}
            </label>

            <input
              id="password-confirm"
              type="password"
              class="border focus:border-gray-500 focus:outline-none px-3 py-2 rounded-lg shadow-sm w-full"
              name="password_confirmation"
              required
              autocomplete="password-confirm"
            >
          </div>

          <div class="flex flex-wrap items-center">
            <button
              type="submit"
              class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded focus:outline-none focus:shadow-outline w-full"
            >
              {{ __('Create account') }}
            </button>
          </div>
        </form>

        <div class="text-center pt-6">
          <div class="text-gray-700">
            {{ __('Or continue with') }}
          </div>

          <div class="flex flex-col md:flex-row mt-6">
            <a
              href="#"
              class="w-full md:w-1/3 border border-gray-400 shadow-sm hover:shadow py-2 px-2 md:mr-1 mb-0 rounded-lg"
            >
              <svg
                class="w-6 h-6 mx-auto text-gray-600"
                viewBox="0 0 24 24"
              >
                <path
                  fill="currentColor"
                  d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z"
                />
              </svg>
            </a>
            <a
              href="#"
              class="w-full md:w-1/3 border border-gray-400 shadow-sm hover:shadow py-2 px-2 md:mx-1 mt-2 md:mt-0 rounded-lg"
            >
              <svg
                class="w-6 h-6 mx-auto text-gray-600"
                viewBox="0 0 24 24"
              >
                <path
                  fill="currentColor"
                  d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z"
                />
              </svg>
            </a>
            <a
              href="#"
              class="w-full md:w-1/3 border border-gray-400 shadow-sm hover:shadow py-2 px-2 md:ml-1 mt-2 md:mt-0 rounded-lg"
            >
              <svg
                class="w-6 h-6 mx-auto text-gray-600"
                viewBox="0 0 24 24"
              >
                <path
                  fill="currentColor"
                  d="M21.35,11.1H12.18V13.83H18.69C18.36,17.64 15.19,19.27 12.19,19.27C8.36,19.27 5,16.25 5,12C5,7.9 8.2,4.73 12.2,4.73C15.29,4.73 17.1,6.7 17.1,6.7L19,4.72C19,4.72 16.56,2 12.1,2C6.42,2 2.03,6.8 2.03,12C2.03,17.05 6.16,22 12.25,22C17.6,22 21.5,18.33 21.5,12.91C21.5,11.76 21.35,11.1 21.35,11.1V11.1Z"
                />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
