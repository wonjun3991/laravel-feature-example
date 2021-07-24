<?php

namespace App\Http\Controllers;

use App\Exceptions\IsSelectedAnswerException;
use App\Exceptions\QuestionHasAnswersMoreThanLimitException;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Services\AnswerService;
use App\Services\QuestionService;
use Illuminate\Http\Response;


class AnswerController extends Controller
{
    private AnswerService $answerService;
    private QuestionService $questionService;

    public function __construct(AnswerService $answerService, QuestionService $questionService)
    {
        $this->answerService = $answerService;
        $this->questionService = $questionService;
    }

    public function index(int $questionId)
    {
        $answerList = $this->answerService->getAnswerList($questionId);
        return AnswerResource::collection($answerList);
    }

    public function store(StoreAnswerRequest $request)
    {
        $answerDto = $request->toAnswerDto();
        try {
            $this->answerService->createAnswer($answerDto);
        } catch (QuestionHasAnswersMoreThanLimitException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['message' => '답변이 등록되었습니다.'], Response::HTTP_CREATED);
    }


    public function show(int $questionId, int $answerId)
    {
        return response()->json(['question_id' => $questionId, 'answer_id' => $answerId]);
    }

    public function update(UpdateAnswerRequest $request, int $questionId, int $answerId)
    {
        $answerDto = $request->toAnswerDto();
        try {
            $this->answerService->updateAnswer($answerId, $answerDto);
        } catch (IsSelectedAnswerException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['message' => '답변이 수정되었습니다.']);
    }

    public function destroy(int $questionId, int $answerId)
    {
        try {
            $this->answerService->deleteAnswer($answerId);
        } catch (IsSelectedAnswerException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['message' => '답변이 삭제되었습니다.']);
    }
}
