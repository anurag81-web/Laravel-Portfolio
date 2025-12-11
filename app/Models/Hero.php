<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    // Table name doesn't follow Laravel pluralization, set explicitly
    protected $table = 'hero_section';

    protected $fillable = [
        'title',
        'name',
        'subtitle',
        'description',
        'profile_image',
        'cv_link',
    ];
}
