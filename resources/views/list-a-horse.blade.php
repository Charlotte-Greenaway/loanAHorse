@extends('layouts.app')

@section('content')
<main class="bg-primary-softwhite min-h-screen py-12">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold text-primary-sage mb-8 text-center">Upload Horse Listing</h1>
        <form id="horse-listing-form" class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md" action="{{ route('list-horse-submit') }}"  method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="horse-name" class="block text-primary-lightgray mb-2">Horse Name</label>
                <input type="text" id="horse-name" name="horse_name" placeholder="Enter horse's name" required pattern="[a-zA-Z0-9\s]+" class="w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage">
            </div>

            @error('horse_name')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            <div class="mb-6">
                <label for="horse-breed" class="block text-primary-lightgray mb-2">Horse's Breed</label>
                <input type="text" id="horse-breed" name="horse_breed" placeholder="Connemara pony" required pattern="[a-zA-Z0-9\s]+" class="w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage">
            </div>
            @error('horse_breed')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            <!-- horse age -->
            <div class="mb-6">
                <label for="horse-age" class="block text-primary-lightgray mb-2">Horse's Age</label>
                <input type="number" id="horse-age" name="horse_age" placeholder="Enter horse's age" required min="0" class="w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage">
            </div>
            @error('horse_age')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            <div class="mb-6">
                <label for="horse-height" class="block text-primary-lightgray mb-2">Horse's Height (in hands)</label>
                <input type="number" id="horse-height" name="horse_height" placeholder="Enter horse's height in hands" required min="0" step="0.1" class="w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage">
            </div>
            @error('horse_height')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            <div class="mb-6">
                <label for="horse-gender" class="block text-primary-lightgray mb-2">Horse Gender</label>
                <select id="horse-gender" name="horse_gender" required class="w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage">
                    <option value="" disabled selected>Select the gender of the horse</option>
                    <option value="mare">Mare</option>
                    <option value="gelding">Gelding</option>
                    <option value="stallion">Stallion</option>
                    <option value="filly">Filly</option>
                    <option value="colt">Colt</option>
                </select>
            </div>
            @error('horse_gender')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            <div class="mb-6">
                <label for="description" class="block text-primary-lightgray mb-2">Description</label>
                <textarea id="description" name="description" placeholder="Enter a detailed description of the horse" required minlength="50" rows="6" class="w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage"></textarea>
            </div>
            @error('description')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            <div class="mb-6">
                <label for="loan-terms" class="block text-primary-lightgray mb-2">Loan Terms</label>
                <textarea id="loan-terms" name="loan_terms" placeholder="Enter the loan terms for the horse" required minlength="20" rows="6" class="w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage"></textarea>
            </div>
            @error('loan_terms')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            <div class="mb-6">
                <label for="price" class="block text-primary-lightgray mb-2">Price (GBP) / per month</label>
                <input type="number" id="price" name="price" placeholder="Enter price in GBP" required min="0" step="0.01" class="w-full px-3 py-2 border border-primary-lightgray/30 rounded-md focus:outline-none focus:ring-2 focus:ring-primary-sage">
            </div>
            @error('price')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            <div class="mb-6">
                <label for="main-image" class="block text-primary-lightgray mb-2">Main Image</label>
                <div class="flex items-center justify-center w-full">
                    <label for="main-image" class="flex flex-col items-center justify-center w-full h-64 border-2 border-primary-lightgray border-dashed rounded-lg cursor-pointer bg-primary-softwhite hover:bg-primary-softwhite/80">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-primary-sage" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-primary-lightgray"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-primary-lightgray">PNG, JPG or JPEG (MAX. 800x400px)</p>
                        </div>
                        <input id="main-image" name="main_image" type="file" accept="image/png, image/jpeg, image/jpg" required class="hidden" />
                    </label>
                </div>
                <div id="main-image-preview" class="mt-4 hidden">
                    <img src="" alt="Main image preview" class="max-w-full h-auto rounded-lg">
                </div>
            </div>
            @error('main_image')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            <div class="mb-6">
                <label for="additional-images" class="block text-primary-lightgray mb-2">Additional Images</label>
                <div class="flex items-center justify-center w-full">
                    <label for="additional-images" class="flex flex-col items-center justify-center w-full h-32 border-2 border-primary-lightgray border-dashed rounded-lg cursor-pointer bg-primary-softwhite hover:bg-primary-softwhite/80">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-primary-sage" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-primary-lightgray"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-primary-lightgray">PNG, JPG or JPEG (MAX. 800x400px)</p>
                        </div>
                        <input id="additional-images" name="additional_images[]" type="file" accept="image/png, image/jpeg, image/jpg" multiple class="hidden" limit="5" />
                    </label>
                </div>
                <div id="additional-images-preview" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4"></div>
            </div>
            @error('additional_images')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            <!-- add a searchable dropdown for location using $locations array which is an array of id= id  name= name -->
            <div class="mb-6">
                <label for="location" class="block text-primary-lightgray mb-2">Location</label>
                <select id="location-select" name="location" required >
                    <option value="" disabled selected>Select the location of the horse</option>
                    @foreach($locations as $location)
                        <option value="{{ $location['name'] }}">{{ $location['name'] }}</option>
                    @endforeach
                </select>
            </div>
            @error('location')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            <!-- add a checkbox for make listing active or inactive -->
            <div class="mb-6 flex space-x-2 items-center">
                <input checked type="checkbox" id="active" name="active" class="w-4 h-4 text-primary-sage focus:outline-none focus:ring-2 focus:ring-primary-sage">
                <label for="active" class="block text-primary-lightgray">Active</label>
            </div>

            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

            @error('error')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            @error('user_id')
                <div class="text-red-500 text-sm mb-1">{{ $message }}</div>
            @enderror

            <button type="submit" class="w-full bg-primary-sage text-primary-softwhite py-3 px-4 rounded-md hover:bg-primary-darksage transition duration-300 text-lg font-semibold">
                Submit Horse Listing
            </button>
        </form>
    </div>
    @vite(['resources/js/list-a-horse.js'])
</main>
@endsection
