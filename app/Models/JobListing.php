<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobListing extends Model
{
    use HasFactory;

    // Welke velden mogen massaal worden ingevuld
    protected $fillable = [
        'employer_id',
        'title',
        'salary',
    ];
}
