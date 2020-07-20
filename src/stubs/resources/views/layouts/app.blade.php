<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Alpine.js -->
  <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
  <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>

  <!-- Styles -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 h-screen antialiased leading-none">
  <div id="app">
    <nav
      x-data="{ menuOpened: false, profileOpened: false }"
      class="bg-gray-800 mb-8"
    >
      <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
          <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
            <button
              @click="menuOpened = !menuOpened"
              @click.away="menuOpened = false"
              class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out"
              aria-label="Main menu"
              aria-expanded="false"
            >
              <!-- Icon when menu is closed. -->
              <!-- Menu open: "hidden", Menu closed: "block" -->
              <svg
                class="block h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16"
                />
              </svg>

              <!-- Icon when menu is open. -->
              <!-- Menu open: "block", Menu closed: "hidden" -->
              <svg
                class="hidden h-6 w-6"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"
                />
              </svg>
            </button>
          </div>

          <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
            <div class="flex-shrink-0">
              <img
                class="block lg:hidden h-8 w-auto"
                src="https://tailwindui.com/img/logos/workflow-mark-on-dark.svg"
                alt="Laravel"
              >
              <img
                class="hidden lg:block h-8 w-auto"
                src="https://tailwindui.com/img/logos/workflow-logo-on-dark.svg"
                alt="Laravel"
              >
            </div>
            <div class="hidden sm:block sm:ml-6">
              <div class="flex">
                <a
                  href="#"
                  class="px-3 py-2 rounded-md text-sm font-medium leading-5 text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                >
                  Dashboard
                </a>
                <a
                  href="#"
                  class="ml-4 px-3 py-2 rounded-md text-sm font-medium leading-5 text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
                >
                  Team
                </a>
              </div>
            </div>
          </div>
          <div class="hidden sm:block inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
            @guest
              <a
                href="{{ route('login') }}"
                class="px-3 py-2 rounded-md text-sm font-medium leading-5 text-white focus:outline-none focus:text-white transition duration-150 ease-in-out"
              >
                Login
              </a>
              <a
                href="{{ route('register') }}"
                class="px-3 py-2 rounded-md text-sm font-medium leading-5 text-white focus:outline-none focus:text-white transition duration-150 ease-in-out"
              >
                Register
              </a>
            @else
              <!-- Profile dropdown -->
              <div class="ml-3 relative">
                <div>
                  <button
                    @click="profileOpened = true"
                    @click.away="profileOpened = false"
                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-white transition duration-150 ease-in-out" id="user-menu" aria-label="User menu" aria-haspopup="true"
                  >
                    <img
                      class="h-8 w-8 rounded-full"
                      src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                      alt=""
                    >
                  </button>
                </div>
                <!--
                  Profile dropdown panel, show/hide based on dropdown state.

                  Entering: "transition ease-out duration-100"
                    From: "transform opacity-0 scale-95"
                    To: "transform opacity-100 scale-100"
                  Leaving: "transition ease-in duration-75"
                    From: "transform opacity-100 scale-100"
                    To: "transform opacity-0 scale-95"
                -->
                <template x-if="profileOpened === true">
                  <div class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg">
                    <div
                      class="py-1 rounded-md bg-white shadow-xs"
                      role="menu"
                      aria-orientation="vertical"
                      aria-labelledby="user-menu"
                    >
                      <a
                        href="#"
                        class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                        role="menuitem"
                      >
                        Settings
                      </a>
                      <a
                        href="javascript:{}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                        class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                        role="menuitem"
                      >
                        Sign out
                      </a>
                    </div>
                  </div>
                </template>
              </div>

              <form
                id="logout-form"
                action="{{ route('logout') }}"
                method="POST"
                style="display: none;"
              >
                @csrf
              </form>
            @endguest
          </div>
        </div>
      </div>

      <!--
        Mobile menu, toggle classes based on menu state.
        Menu open: "block", Menu closed: "hidden"
      -->
      <div
        class="sm:hidden"
        :class="{ 'block': menuOpened, 'hidden': !menuOpened }"
      >
        <div class="px-2 pt-2 pb-3">
          <a
            href="#"
            class="block px-3 py-2 rounded-md text-base font-medium text-white bg-gray-900 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          >
            Dashboard
          </a>
          <a
            href="#"
            class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
          >
            Team
          </a>

          @guest
            <a
              href="{{ route('login') }}"
              class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
            >
              Login
            </a>
            <a
              href="{{ route('register') }}"
              class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
            >
              Register
            </a>
          @else
            <a
              href="#"
              class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
              role="menuitem"
            >
              Settings
            </a>

            <a
              href="javascript:{}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"
              class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
              role="menuitem"
            >
              Sign out
            </a>
          @endguest
        </div>
      </div>
    </nav>

    @yield('content')
  </div>
</body>
</html>
