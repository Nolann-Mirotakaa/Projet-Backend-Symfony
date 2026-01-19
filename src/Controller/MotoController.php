<?php

namespace App\Controller;

use App\Entity\Moto;
use App\Form\MotoType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MotoController extends AbstractController
{
    #[Route('/moto/ajouter', name: 'moto_create')]
    public function create(Request $request): Response
    {
        $moto = new Moto();

        $form = $this->createForm(MotoType::class, $moto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            dump($moto);

            $this->addFlash('success', 'Moto Ducati ajoutée avec succès !');
        }

        return $this->render('moto/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
