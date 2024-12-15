<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorseImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'horse_listing_id', 'image_path', 'is_main',
    ];

    // Define the relationship with HorseListing
    public function horseListing()
    {
        return $this->belongsTo(HorseListing::class);
    }

    /**
     * Upload an image
     *
     * @param \Illuminate\Http\UploadedFile $image
     * @param int $horseListingId
     * @param bool $isMain
     * @return string
     */
    public static function uploadImage($image, $horseListingId, $isMain = false)
    {
        // Get the file name
        $fileName = $image->getClientOriginalName();
        //create a random 8 character string
        $randomString = bin2hex(random_bytes(4));
        $newFile = $randomString . '_' . $fileName;

        // Store the image in the 'public' disk with
        $image->storeAs('horse_images', $newFile, 'public');

        // Create a new HorseImage record
        $horseImage = new HorseImage();
        $horseImage->horse_listing_id = $horseListingId;
        $horseImage->image_path = $newFile;
        $horseImage->is_main = $isMain;
        $horseImage->save();

        return $fileName;
    }
}
