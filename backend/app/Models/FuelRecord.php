<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelRecord extends Model
{
    use HasFactory; // Factory သုံးဖို့ ဒါလေး လိုအပ်ပါတယ်

    protected $fillable = [
        'region',
        'plate_prefix',
        'plate_letter',
        'plate_number',
        'oil_type',
        'liter',
        'total_price',
        'times',
    ];

    // မှတ်ချက် - Vehicle Model မရှိသေးရင် ဒီနေရာမှာ Relationship ခဏပိတ်ထားပါ
}
