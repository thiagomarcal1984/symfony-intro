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
        $html = '<ul>';
        foreach ($seriesList as $serie) {
            $html .= '<li>' . $serie . '</li>';
        }
        $html .= '</ul>';
        // return new Response($html);
        return new JsonResponse($seriesList);
    }
}
