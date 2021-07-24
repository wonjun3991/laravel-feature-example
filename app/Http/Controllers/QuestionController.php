<?php

namespace App\Http\Controllers;

use App\Exceptions\HasAnswerException;
use App\Exceptions\QuestionHasSelectedAnswerException;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionCollection;
use App\Http\Resources\QuestionResource;
use App\Services\QuestionService;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    private QuestionService $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function index()
    {
        $questionList = $this->questionService->getQuestionList();
        return new QuestionCollection($questionList);
    }

    public function store(StoreQuestionRequest $request)
    {
        $questionDto = $request->toQuestionDto();
        $this->questionService->createQuestion($questionDto);
        return response()->json(['message' => '질문이 등록되었습니다.'], Response::HTTP_CREATED);
    }

    public function show(int $id)
    {
        $question = $this->questionService->findQuestion($id);
        return new QuestionResource($question);
    }

    public function update(UpdateQuestionRequest $request, int $id)
    {
        $questionDto = $request->toQuestionDto();
        try {
            $this->questionService->updateQuestion($id, $questionDto);
        } catch (HasAnswerException | QuestionHasSelectedAnswerException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['message' => '질문이 수정되었습니다.']);
    }

    public function destroy(int $id)
    {
        try {
            $this->questionService->deleteQuestion($id);
        } catch (HasAnswerException $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
        return response()->json(['message' => '질문이 삭제되었습니다.']);
    }
}
