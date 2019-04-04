<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{

    protected $fillable = ['file'];

    public function getFileAttribute($photo) {
        return '/images/' . $photo;
    }

    public static function addImage($file) {
        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);
        return $name;
    }
}
