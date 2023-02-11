<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OlaMundoController extends AbstractController
{
    #[Route('/ola_mundo')]
    public function index(Request $request): Response
    {
        return new Response(
            "<h1>Olá, mundo!</h1>" . $_GET['id']
        ); 
    }
}
