<?php

namespace App\Data;

use App\GoogleFont;

class FontDataAccessor
{

    public function getAll()
    {
        return GoogleFont::orderBy('family', 'ASC')->get();
    }
}
