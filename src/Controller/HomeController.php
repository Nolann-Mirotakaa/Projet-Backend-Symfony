<?php

namespace App\Controller;

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
    public function models(): Response
    {
        $models = [
            [
                'name' => 'Panigale V2',
                'engine' => 'V-Twin',
                'power' => 155,
                'flagship' => false
            ],
            [
                'name' => 'Panigale V2 S',
                'engine' => 'V-Twin',
                'power' => 185,
                'flagship' => true
            ],
            [
                'name' => 'Panigale V4',
                'engine' => 'V4',
                'power' => 215,
                'flagship' => true
            ],
            [
                'name' => 'Panigale V4 S',
                'engine' => 'V4',
                'power' => 215,
                'flagship' => true
            ],
            [
                'name' => 'Panigale V4 R',
                'engine' => 'V4',
                'power' => 240,
                'flagship' => true
            ]
        ];

        $quotes = [
            "« Ducati ne fabrique pas seulement des motos, mais des émotions. »",
            "« La Panigale est l'expression ultime de la performance. »",
            "« Le style italien au service de la compétition. »",
            "« Une Panigale ne se conduit pas, elle se ressent. »"
        ];

        $quote = $quotes[array_rand($quotes)];

        return $this->render('home/models.html.twig', [
            'models' => $models,
            'quote' => $quote
        ]);
    }
}
