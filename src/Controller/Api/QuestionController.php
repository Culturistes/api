<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Manager\Api\QuestionApiManager;
use App\Manager\Api\FunCityNameApiManager;

/**
 * @Route("/api/{tag}", name="api_question_")
 */
class QuestionController extends AbstractController
{
    private $questionApiManager;
    private $funCityNameApiManager;

    public function __construct(QuestionApiManager $questionApiManager, FunCityNameApiManager $funCityNameApiManager)
    {
        $this->questionApiManager = $questionApiManager;
        $this->funCityNameApiManager = $funCityNameApiManager;
    }
    
    /**
     * @Route("/get", name="get")
     */
    public function getQuestions(Request $request, string $tag): Response
    {
        $number = $request->query->get('n');
        if($tag && $number) {
            if (in_array($tag, ['lme', 'quiz'])) {
                $jsonContent = $this->questionApiManager->getQuestions($tag, $number);
                return JsonResponse::fromJsonString($jsonContent);
            } else if (in_array($tag, ['coc'])) {
                $jsonContent = $this->funCityNameApiManager->getQuestions($number);
                return JsonResponse::fromJsonString($jsonContent);
            } else {
                throw new \Exception('Le Tag n\'existe pas');
            }
        }

        throw new \Exception('Tag ou Number n\'existe pas');
    }
}