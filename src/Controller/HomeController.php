<?php

namespace App\Controller;

use App\Repository\MotoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/about', name: 'about')]
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }

    #[Route('/hello/{name}', name: 'hello')]
    public function hello(string $name): Response
    {
        return $this->render('home/hello.html.twig', [
            'name' => ucfirst($name)
        ]);
    }

    #[Route('/models', name: 'models')]
    public function models(MotoRepository $motoRepository): Response
    {
        $motos = $motoRepository->findBy(
            ['brand' => 'Ducati'],
            ['year' => 'DESC']
        );

        return $this->render('home/models.html.twig', [
            'motos' => $motos
        ]);
    }
}
