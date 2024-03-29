<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = ['title', 'slug', 'user_id', 'description',];

    public function getRouteKeyName()
    {
        return "slug";
    }
    use HasFactory;

    public function files()
    {
        return $this->hasMany(File::class);
    }
}
