<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SeriesController extends AbstractController
{
    #[Route('/series', name: 'app_series', methods: ['GET'])]
    public function index(): Response
    {
        $seriesList =  [
            'Lost',
            'Grey\'s Anatomy',
            'Loki',
            'Suits',
        ];
        return $this->render('series/index.html.twig', [
            'seriesList' => $seriesList,
        ]);
    }
}
