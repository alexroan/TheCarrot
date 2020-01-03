<?php

namespace App\Data;

use App\FrequentlyAskedQuestion;

class FrequentlyAskedQuestionsDataAccessor{

    public function getAll()
    {
        return FrequentlyAskedQuestion::all();
    }
}