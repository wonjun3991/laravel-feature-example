<?php

namespace Database\Seeders;

use App\Models\CatPatternType;
use Illuminate\Database\Seeder;

class CatPatternTypeSeeder extends Seeder
{

    private const CAT_PATTERN_TYPE_ARRAY = [
        '흰색',
        '회색',
        '검정색',
        '삼색',
        '턱시도',
        '고등어',
        '치즈',
    ];

    public function run()
    {
        foreach (self::CAT_PATTERN_TYPE_ARRAY as $catPatternType) {
            $cpt = new CatPatternType();
            $cpt->type = $catPatternType;
            $cpt->save();
        }
    }
}
