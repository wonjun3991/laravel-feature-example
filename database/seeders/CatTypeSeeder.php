<?php

namespace Database\Seeders;

use App\Models\CatType;
use Illuminate\Database\Seeder;

class CatTypeSeeder extends Seeder
{
    private const CAT_TYPE_ARRAY = [
        '터키쉬 앙고라',
        '샴',
        '스코티쉬 폴드',
        '러시안 블루',
        '먼치킨',
        '코리안 숏헤어',
        '스노우슈',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::CAT_TYPE_ARRAY as $catType) {
            $ct = new CatType();
            $ct->type = $catType;
            $ct->save();
        }
    }
}
