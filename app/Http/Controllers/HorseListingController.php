<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\HorseImage;
use App\Models\HorseListing;

class HorseListingController extends Controller
{
    /**
     * Get the GeoJSON locations
     *
     * @return array
     */
    private function getGeoJsonLocations()
    {
        // Get the file path of your GeoJSON
        $geoJsonPath = storage_path('app/private/locations.json');

        // Check if the file exists
        if (file_exists($geoJsonPath)) {
            $geoJsonData = file_get_contents($geoJsonPath);
            $decodedData = json_decode($geoJsonData, true);

            $locations = [];
            foreach ($decodedData['objects'] as $object) {
                foreach ($object['geometries'] as $geometry) {
                    //only include where property value doesnt contain any numbers and is not null
                     foreach ($geometry['properties'] as $id => $name) {
                        if (!preg_match('/\d/', $name) && $name !== null) { // Exclude names with numbers
                            $locations[] = ['id' => $id, 'name' => $name]; // Include id and name
                        }
                    }
                }
            }

            return $locations;
        }

        return []; // If file doesn't exist, return an empty array
    }

    /**
     * Show the horse listing form
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showHorseListingForm()
    {
        //if the user isnt logged in show the sign-in page
        if (!auth()->check()) {
            return redirect()->route('sign-in');
        }
        // Get the GeoJSON locations
        $locations = $this->getGeoJsonLocations();

        // Pass the locations data to the view
        return view('list-a-horse', ['locations' => $locations]);
    }

    /**
     * List a horse
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function listHorse(Request $request)
    {
        // Validate the request
        $validator = \Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'horse_name' => 'required|string',
            'horse_age' => 'required|numeric',
            'horse_breed' => 'required|string',
            'horse_height' => 'required|numeric',
            'horse_gender' => 'required|string',
            'description' => 'required|string',
            'loan_terms' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additional_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'active' => 'required|in:on,off',
        ], [
            'user_id.required' => 'You need to be logged in to list a horse',
            'horse_name.required' => 'The horse name is required',
            'horse_age.required' => 'The horse age is required',
            'horse_age.numeric' => 'The horse age must be a number',
            'horse_breed.required' => 'The horse breed is required',
            'horse_height.required' => 'The horse height is required',
            'horse_height.numeric' => 'The horse height must be a number',
            'horse_gender.required' => 'The horse gender is required',
            'horse_gender.in' =>   'The horse gender must be either mare, gelding, colt, filly, or stallion',
            'description.required' => 'The description is required',
            'loan_terms.required' => 'The loan terms are required',
            'price.required' => 'The price is required',
            'price.numeric' => 'The price must be a number',
            'location.required' => 'The location is required',
            'main_image.required' => 'The main image is required',
            'main_image.image' => 'The main image must be an image',
            'main_image.mimes' => 'The main image must be a file of type: jpeg, png, jpg, gif, svg',
            'main_image.max' => 'The main image may not be greater than 2048 kilobytes',
            'additional_images.*.image' => 'The additional images must be images',
            'additional_images.*.mimes' => 'The additional images must be a file of type: jpeg, png, jpg, gif, svg',
            'additional_images.*.max' => 'The additional images may not be greater than 2048 kilobytes',
            'active.required' => 'The active field is required',
            'active.in' => 'The active field must be either on or off',
        ]);

        // If the validation fails, return the errors
        if ($validator->fails()) {
            return back()->withErrors($validator->errors())->withInput();
        }


        // Create a new HorseListing record
        $horseListingId = HorseListing::createHorseListing([
            'user_id' => auth()->id(),
            'horse_name' => $request->input('horse_name'),
            'horse_breed' => $request->input('horse_breed'),
            'horse_age' => $request->input('horse_age'),
            'horse_gender' => $request->input('horse_gender'),
            'horse_height' => $request->input('horse_height'),
            'description' => $request->input('description'),
            'loan_terms' => $request->input('loan_terms'),
            'price' => $request->input('price'),
            'location' => $request->input('location'),
            'active' => $request->input('active'),
        ]);
        \Log::info('Horse listing created');


        // upload the main image
        $mainImage = $request->file('main_image');
        $mainImageFileName = HorseImage::uploadImage($mainImage, $horseListingId, true);

        $additionalImages = [];
        //upload the additional images if any
        if ($request->hasFile('additional_images')) {
            \Log::info('Uploading additional images');
            \Log::info($request->file('additional_images'));
            \Log::info('Post Max Size: ' . ini_get('post_max_size'));
            \Log::info('Upload Max Files: ' . ini_get('max_file_uploads'));
            $additionalImagez = $request->file('additional_images');
            if (!is_array($additionalImagez)) {
                $additionalImagez = [$additionalImagez]; // wrap in array if only one image is uploaded
            }

            foreach ($additionalImagez as $additionalImage) {
                \Log::info('Uploading additional image');
                $additionalImageFileName = HorseImage::uploadImage($additionalImage, $horseListingId);
                $additionalImages[] = $additionalImageFileName;
            }
        }
        // if the main image or additional images fail to upload, delete the horse listing
        if (!$mainImageFileName || in_array(false, $additionalImages)) {
            HorseListing::find($horseListingId)->delete();

            return back()->withErrors(['error' => 'An error occurred while uploading the images. Please try again.'])->withInput();
        }

        return view('listing-success', ['horseListingId' => $horseListingId]);
    }

    /**
     * View a horse listing
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function viewListing($id)
    {
        // Get the horse listing
        $horseListing = HorseListing::find($id);

        // If the horse listing doesn't exist, return a 404
        if (!$horseListing) {
            abort(404);
        }

        // Get the main image
        $mainImage = HorseImage::where('horse_listing_id', $id)->where('is_main', true)->first();

        // Get the additional images
        $additionalImages = HorseImage::where('horse_listing_id', $id)->where('is_main', false)->get();

        return view('view-your-listing', ['horseListing' => $horseListing, 'mainImage' => $mainImage, 'additionalImages' => $additionalImages]);
    }
}
