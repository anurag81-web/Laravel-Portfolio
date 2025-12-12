<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $table = 'social_links'; // Make sure this matches your table name
    protected $fillable = ['platform', 'url']; // Your columns
}

