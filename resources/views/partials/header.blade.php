<!-- resources/views/partials/header.blade.php -->
<header class="bg-primary-softwhite shadow-sm">
  <div class="container mx-auto px-4 py-4 flex items-center justify-between">
    <div class="flex items-center space-x-2">
      <i class="fa-solid fa-horse text-primary-darksage text-2xl"></i>
      <h1 class="text-2xl font-bold text-primary-sage">LoanAHorse</h1>
    </div>
    <nav class="hidden md:block">
      <ul class="flex space-x-6 text-primary-lightgray">
        <li><a href="{{ route('home') }}" class="hover:text-primary-sage transition duration-300">Browse</a></li>
        <li><a href="{{ route('list-a-horse')}}" class="hover:text-primary-sage transition duration-300">Create Listing</a></li>
        <li><a href="#" class="hover:text-primary-sage transition duration-300">Contact</a></li>
      </ul>
    </nav>
    @auth
        <div class="relative md:block hidden">
            <button id="avatar-menu-button" class="flex items-center space-x-2 focus:outline-none" aria-haspopup="true" aria-expanded="false">
                <!-- user avatar in a circle (just the users initials) accessed through splitting the name by space and getting the first letter of each item -->
                <div class="w-8 h-8 bg-primary-sage text-primary-lightgray flex items-center justify-center rounded-full">
                    <span>{{
                        strtoupper(substr(explode(' ', auth()->user()->name)[0], 0, 1))
                        . strtoupper(substr(explode(' ', auth()->user()->name)[1], 0, 1))
                    }}</span>
                </div>
            </button>
            <div id="avatar-menu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden">
                <a href="#" class="block px-4 py-2 text-sm text-primary-lightgray hover:bg-primary-softwhite">Profile</a>
                <a href="{{ route('signOut') }}" class="block px-4 py-2 text-sm text-primary-lightgray hover:bg-primary-softwhite">Logout</a>
            </div>
        </div>
    @endauth

    @guest
        <!-- User is not logged in -->
        <a href="{{ route('sign-in') }}" class="hidden md:block">
            <button class="bg-primary-darksage text-primary-softwhite px-4 py-2 rounded-md hover:bg-primary-sage transition duration-300">
                Login / Register
            </button>
        </a>
    @endguest
    <button id="mobile-menu-button" class="md:hidden focus:outline-none">
      <i class="fa-solid fa-bars text-2xl text-primary-sage"></i>
    </button>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="md:hidden w-full h-full fixed top-0 translate-x-full bg-white transition-transform duration-300 ease-in-out z-50">
    <div class="flex justify-between px-4 py-4">
        <div class="flex space-x-2">
        <i class="fa-solid fa-horse text-primary-darksage text-2xl"></i>
        <h1 class="text-2xl font-bold text-primary-sage">LoanAHorse</h1>
        </div>
      <button id="mobile-menu-close" class="focus:outline-none">
        <i class="fa-solid fa-xmark text-2xl text-primary-sage"></i>
      </button>
    </div>
    <ul class="px-4 py-2 space-y-2">
      <li><a href="{{ route('home') }}" class="block px-4 py-2 text-sm text-primary-lightgray hover:bg-primary-softwhite">Browse</a></li>
      <li><a href="{{ route('list-a-horse')}}" class="block px-4 py-2 text-sm text-primary-lightgray hover:bg-primary-softwhite">Create Listing</a></li>
      <li><a href="#" class="block px-4 py-2 text-sm text-primary-lightgray hover:bg-primary-softwhite">Contact</a></li>
      @auth
          <li><a href="#" class="block px-4 py-2 text-sm text-primary-lightgray hover:bg-primary-softwhite">Profile</a></li>
          <li><a href="{{ route('signOut') }}" class="block px-4 py-2 text-sm text-primary-lightgray hover:bg-primary-softwhite">Logout</a></li>
      @endauth
      @guest
        <!-- User is not logged in -->
        <li><a href="{{ route('sign-in') }}" class="block px-4 py-2 text-sm text-primary-lightgray hover:bg-primary-softwhite">Login / Register</a></li>
      @endguest
    </ul>
  </div>
</header>

@vite(['resources/js/header.js'])

