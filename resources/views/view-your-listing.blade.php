@extends('layouts.app')

@section('content')
<main class="bg-primary-softwhite min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-primary-sage text-primary-softwhite p-6">
                <h1 class="text-3xl font-bold">
                    <?= $horseListing->horse_name ?>
                </h1>
                <p class="text-xl mt-2">
                    <?= $horseListing->breed ?>
                </p>
            </div>

            <!-- Main Image -->
            <div class="relative h-full">
                <img src="{{ asset('storage/horse_images/' . $mainImage->image_path) }}" alt="<?= $horseListing->horse_name?>" class="w-full h-full object-cover">
            </div>

            <!-- Image Gallery -->
            <div class="p-6 bg-primary-softwhite">
                <h2 class="text-xl font-semibold text-primary-sage mb-4">Image Gallery</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <?php foreach ($additionalImages as $image): ?>
                        <img src="{{ asset('storage/horse_images/' . $image->image_path) }}" alt="<?= $horseListing->horse_name?>" class="w-full h-40 object-cover rounded-lg">
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Description and Details -->
            <div class="p-6">
                <h2 class="text-2xl font-semibold text-primary-sage mb-4">About Thunderbolt</h2>
                <p class="text-primary-lightgray mb-6">
                    <?= $horseListing->description ?>
                </p>
                <div class="grid grid-cols-2 gap-4 text-primary-lightgray">
                    <div>
                        <strong class="text-primary-sage">Breed:</strong> <?= $horseListing->breed ?>
                    </div>
                    <div>
                        <strong class="text-primary-sage">Age:</strong> <?= $horseListing->age ?> years
                    </div>
                    <div>
                        <strong class="text-primary-sage">Height:</strong> <?= $horseListing->height ?> hands
                    </div>
                    <div>
                        <strong class="text-primary-sage">PPM:</strong> £<?= $horseListing->price ?>
                    </div>
                </div>
            </div>
            <!-- Loan terms -->
            <div class="p-6 bg-primary-softwhite">
                <h2 class="text-xl font-semibold text-primary-sage mb-4">Loan Terms</h2>
                <p class="text-primary-lightgray">
                    <?= $horseListing->loan_terms ?>
                </p>
            </div>

            <!-- Location -->
            <div class="p-6 bg-primary-softwhite">
                <h2 class="text-xl font-semibold text-primary-sage mb-4">Location</h2>
                <p class="text-primary-lightgray">
                    <?= $horseListing->location ?>
                </p>
            </div>
        </div>
    </div>
</main>
@endsection
