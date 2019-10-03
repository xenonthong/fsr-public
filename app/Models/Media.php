<?php
namespace App\Models;

use Spatie\MediaLibrary\Models\Media as BaseMedia;

class Media extends BaseMedia {
    protected $appends = ['full_url'];

    public function getFullUrlAttribute() {
        return $this->getFullUrl();
    }
}
