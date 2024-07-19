<?php

namespace App\Observers;

use App\Models\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoObserver
{
    public function deleting(Photo $photo)
    {
        Storage::delete($photo->path);
    }
}
