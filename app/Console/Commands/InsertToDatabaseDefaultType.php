<?php

namespace App\Console\Commands;

use App\Models\CatPatternType;
use App\Models\CatType;
use App\Models\QuestionType;
use DB;
use Illuminate\Console\Command;
use Throwable;

class InsertToDatabaseDefaultType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insertDefaultData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cat_pattern_types, cat_types, question_types 데이터베이스를 초기화 시킨 후 기본값을 입력';

    private const CAT_PATTERN_TYPE_ARRAY = [
        '흰색',
        '회색',
        '검정색',
        '삼색',
        '턱시도',
        '고등어',
        '치즈',
    ];

    private const CAT_TYPE_ARRAY = [
        '터키쉬 앙고라',
        '샴',
        '스코티쉬 폴드',
        '러시안 블루',
        '먼치킨',
        '코리안 숏헤어',
        '스노우슈',
    ];

    private const QUESTION_TYPE_ARRAY = [
        '사료',
        '그루밍',
        '집사후기'
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::beginTransaction();
        try {
            CatType::query()->delete();
            CatPatternType::query()->delete();
            QuestionType::query()->delete();

            foreach (self::CAT_TYPE_ARRAY as $catType) {
                $ct = new CatType();
                $ct->type = $catType;
                $ct->save();
            }
            foreach (self::CAT_PATTERN_TYPE_ARRAY as $catPatternType) {
                $cpt = new CatPatternType();
                $cpt->type = $catPatternType;
                $cpt->save();
            }
            foreach(self::QUESTION_TYPE_ARRAY as $questionType){
                $qt = new QuestionType();
                $qt->type = $questionType;
                $qt->save();
            }
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            $this->info($e->getMessage());
            $this->info('트랜잭션 처리중 오류 발생');
        }
        $this->info('해당 테이블들에 기본값 입력이 완료되었습니다.');
    }
}
