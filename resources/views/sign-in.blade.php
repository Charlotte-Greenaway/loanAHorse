@extends('layouts.app')

@section('content')
<main class="bg-primary-softwhite min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <div class="flex border-b border-primary-lightgray/20">
                <button id="signin-tab" class="w-1/2 px-4 py-2 text-center text-primary-sage font-semibold bg-primary-softwhite hover:bg-primary-sage hover:text-primary-softwhite focus:outline-none">Sign In</button>
                <button id="register-tab" class="w-1/2 px-4 py-2 text-center text-primary-lightgray font-semibold bg-white hover:bg-primary-sage hover:text-primary-softwhite focus:outline-none">Register</button>
            </div>

            <!-- Sign In Form posts to /auth/sign-in -->
            <div id="signin-form" class="p-8">
                <h2 class="text-2xl font-bold text-primary-sage mb-6">Sign In</h2>
                <form action="/auth/sign-in" method="POST">
                    @csrf  <!-- This will generate the CSRF token -->
                    <div class="mb-4">
                        <label for="signin-email" class="block text-primary-lightgray mb-2">Email</label>
                        <input name="email" type="email" id="signin-email" class="w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage" required>
                    </div>
                    <div class="mb-6">
                        <label for="signin-password" class="block text-primary-lightgray mb-2">Password</label>
                        <input name="password" type="password" id="signin-password" class="w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage" required>
                    </div>
                    @error('sign-in')
                        <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="w-full bg-primary-sage text-primary-softwhite py-2 px-4 rounded-md hover:bg-primary-darksage transition duration-300">Sign In</button>
                </form>
                <div class="mt-4 text-center">
                    <a href="#" class="text-primary-sage hover:underline">Forgot Password?</a>
                </div>
            </div>

            <!-- Register Form -->
            <div id="register-form" class="p-8 hidden">
                <h2 class="text-2xl font-bold text-primary-sage mb-6">Register</h2>
                <form action="/auth/sign-up" method="POST" id="register-formm">
                    @csrf  <!-- This will generate the CSRF token -->
                    <div class="mb-4">
                        <label for="register-name" class="block text-primary-lightgray mb-2">Full Name</label>
                        <input name="name" type="text" id="register-name" class="w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage" required>
                    </div>
                    @error('name')
                        <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-4">
                        <label for="register-email" class="block text-primary-lightgray mb-2">Email</label>
                        <input name="email" type="email" id="register-email" class="w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage" required>
                    </div>
                    @error('email')
                        <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
                    @enderror
                    <div class="mb-6">
                        <label for="register-password" class="block text-primary-lightgray">Password</label>
                        <small class="text-primary-lightgray text-xs mb-2">Password must be at least 6 characters long with at least one number and one letter.</small>
                        <input name="password" type="password" id="register-password" class="mt-2 w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage" required>
                    </div>
                    @error('password')
                        <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="w-full bg-primary-sage text-primary-softwhite py-2 px-4 rounded-md hover:bg-primary-darksage transition duration-300">Register</button>
                </form>
            </div>
        </div>
    </div>

    @vite(['resources/js/sign-in.js'])
</main>
@endsection
