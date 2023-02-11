<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OlaMundoController extends AbstractController
{
    #[Route('/ola_mundo', name: 'app_ola_mundo')]
    public function index(): Response
    {
        return new Response("Olá, mundo!"); 
    }
}
