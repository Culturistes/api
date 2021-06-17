<?php

namespace App\Manager\Api;

use App\Repository\QuestionRepository;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;

class QuestionApiManager
{
    private $questionRepository;
    private $serializer;

    public function __construct(QuestionRepository $questionRepository, SerializerInterface $serializer)
    {
        $this->questionRepository = $questionRepository;
        $this->serializer = $serializer;
    }

    public function getQuestions($tag, $number)
    {
        $results = $this->questionRepository->findRandomQuestions($tag, $number);

        // Vérifie le nombre de questions retournées est bien le même que celui demandé
        if (count($results) == $number) {
            $jsonContent = $this->serializer->serialize($results, 'json', [
                AbstractNormalizer::ATTRIBUTES => ['title', 'answers', 'description']
            ]);
    
            return $jsonContent;
        } else {
            throw new \Exception('Pas assez de questions');
        }
    }
}