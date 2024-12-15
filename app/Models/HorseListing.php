<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorseListing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'horse_name', 'breed', 'age', 'gender', 'height', 'description', 'loan_terms', 'availability', 'price', 'location',
    ];

    // Define the relationship with HorseImages
    public function horseImages()
    {
        return $this->hasMany(HorseImage::class);
    }

    // To get the main image for the horse listing
    public function mainImage()
    {
        return $this->hasOne(HorseImage::class)->where('is_main', true);
    }

    /**
     * Create a new HorseListing record
     *
     * @param array $data
     * @return int
     */
    public static function createHorseListing($data)
    {
        $horseListing = new HorseListing();
        $horseListing->user_id = $data['user_id'];
        $horseListing->horse_name = $data['horse_name'];
        $horseListing->breed = $data['horse_breed'];
        $horseListing->age = $data['horse_age'];
        $horseListing->gender = $data['horse_gender'];
        $horseListing->height = $data['horse_height'];
        $horseListing->description = $data['description'];
        $horseListing->loan_terms = $data['loan_terms'];
        $horseListing->availability = $data['active'];
        $horseListing->price = $data['price'];
        $horseListing->location = $data['location'];
        $horseListing->save();

        //return the listing id
        return $horseListing->id;
    }
}
