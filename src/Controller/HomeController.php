<?php

namespace App\Controller;

use App\Repository\MotoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
    $citations = [
        "La vitesse n'est rien sans contrôle.",
        "Les Ducati ne se conduisent pas, elles se ressentent.",
        "La passion est rouge.",
        "Une moto n'est pas un véhicule, c'est une émotion.",
        "La performance commence là où la peur s'arrête."
    ];

    $citation = $citations[array_rand($citations)];

     return $this->render('home/about.html.twig', [
        'citation' => $citation
    ]);
    }

    #[Route('/models', name: 'models')]
    public function models(Request $request, MotoRepository $repo): Response
    {
        $search = $request->query->get('search');
        $categorie = $request->query->get('categorie');
        $tri = $request->query->get('tri');

        $motos = $repo->searchModels($search, $categorie, $tri);
        $categories = $repo->findAllCategories();

        return $this->render('home/models.html.twig', [
            'motos' => $motos,
            'categories' => $categories
        ]);
    }
}
