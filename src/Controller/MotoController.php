<?php

namespace App\Controller;

use App\Entity\AnnonceMoto;
use App\Form\AnnonceMotoType;
use App\Repository\AnnonceMotoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MotoController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/annonce/ajouter', name: 'annonce_create')]
    public function createAnnonce(Request $request, EntityManagerInterface $em): Response
    {
        $annonce = new AnnonceMoto();

        $form = $this->createForm(AnnonceMotoType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $annonce->setAuteur($this->getUser());

            $annonce->setDateCreation(new \DateTimeImmutable());

            $imageFile = $form->get('image')->getData();
            if ($imageFile) {
                $extension = $imageFile->guessExtension();
                $newFilename = uniqid() . '.' . $extension;

                $imageFile->move(
                    $this->getParameter('uploads_directory'),
                    $newFilename
                );

                $annonce->setImage($newFilename);
            }

            $em->persist($annonce);
            $em->flush();

            $this->addFlash('success', 'Annonce ajoutée avec succès !');
            return $this->redirectToRoute('annonce_list');
        }

        return $this->render('annonce/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/annonces', name: 'annonce_list')]
    public function list(AnnonceMotoRepository $repo): Response
    {
        $annonces = $repo->findLatest();

        return $this->render('annonce/list.html.twig', [
            'annonces' => $annonces,
        ]);
    }

    #[Route('/annonce/{id}', name: 'annonce_show')]
    public function show(AnnonceMoto $annonce): Response
    {
        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
        ]);
    }

    #[Route('/annonce/{id}/modifier', name: 'annonce_edit')]
    public function edit(
        AnnonceMoto $annonce,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $form = $this->createForm(AnnonceMotoType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                $newFilename = uniqid() . '.' . $imageFile->guessExtension();

                $imageFile->move(
                    $this->getParameter('uploads_directory'),
                    $newFilename
                );

                $annonce->setImage($newFilename);
            }

            $em->flush();

            $this->addFlash('success', 'Annonce modifiée avec succès');
            return $this->redirectToRoute('annonce_show', [
                'id' => $annonce->getId()
            ]);
        }

        return $this->render('annonce/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/annonce/{id}/supprimer', name: 'annonce_delete')]
    public function delete(
        AnnonceMoto $annonce,
        EntityManagerInterface $em
    ): Response {
        $em->remove($annonce);
        $em->flush();

        $this->addFlash('success', 'Annonce supprimée');
        return $this->redirectToRoute('annonce_list');
    }
}
