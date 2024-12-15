@extends('layouts.app')

@section('content')
<main class="bg-primary-softwhite min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md text-center">
            <svg class="w-20 h-20 text-primary-sage mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h1 class="text-3xl font-bold text-primary-sage mb-4">Success!</h1>
            <p class="text-primary-lightgray mb-6">Your horse listing has been successfully submitted. Thank you for using LoanAHorse!</p>
            <div class="space-y-4">
                <a href="{{ route('view-your-listing', ['id' => $horseListingId]) }}"
                 class="block w-full bg-primary-sage text-primary-softwhite py-2 px-4 rounded-md hover:bg-primary-darksage transition duration-300">
                    View Your Listing
                </a>
                <a href={{route('list-a-horse')}} class="block w-full bg-primary-softwhite text-primary-sage py-2 px-4 rounded-md border border-primary-sage hover:bg-primary-sage hover:text-primary-softwhite transition duration-300">
                    Submit Another Listing
                </a>
                <a href={{route('home')}} class="block text-primary-sage hover:underline">
                    Return to Homepage
                </a>
            </div>
        </div>
    </div>
</main>
@endsection
