<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AnnonceMotoRepository;
use App\Repository\UserRepository;
use App\Repository\MotoRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Moto;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('', name: 'admin_dashboard')]
    public function dashboard(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/dashboard.html.twig');
    }

    #[Route('/annonces', name: 'admin_panel')]
    public function annonces(AnnonceMotoRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/panel.html.twig', [
            'annonces' => $repo->findAll()
        ]);
    }

    #[Route('/users', name: 'admin_users')]
    public function users(UserRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/users.html.twig', [
            'users' => $repo->findAll()
        ]);
    }

    #[Route('/users/{id}/promote', name: 'admin_user_promote')]
    public function promote(User $user, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $user->setRoles(['ROLE_ADMIN']);
        $em->flush();
        $this->addFlash('success', 'Utilisateur promu admin');
        return $this->redirectToRoute('admin_users');
    }

    #[Route('/admin/user/delete/{id}', name: 'admin_user_delete')]
    public function delete(
        User $user,
        EntityManagerInterface $em,
        Security $security
    ): Response {

        $currentUser = $security->getUser();
        if ($user === $this->getUser()) {
            $this->addFlash('danger', 'Vous ne pouvez pas supprimer votre propre compte.');
            return $this->redirectToRoute('admin_users');
        }
        if ($user->getId() === 1) {
            $this->addFlash('danger', 'Le compte administrateur principal ne peut pas être supprimé.');
            return $this->redirectToRoute('admin_users');
        }
        $em->remove($user);
        $em->flush();
        $this->addFlash('success', 'Utilisateur supprimé.');
        return $this->redirectToRoute('admin_users');
    }

    #[Route('/motos', name: 'admin_motos')]
    public function motos(MotoRepository $repo): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/motos.html.twig', [
            'motos' => $repo->findAll()
        ]);
    }

    #[Route('/motos/edit/{id}', name: 'admin_moto_edit')]
    public function editMoto(
        Moto $moto,
        Request $request,
        EntityManagerInterface $em
    ): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        if ($request->isMethod('POST')) {
            $moto->setName($request->request->get('name'));
            $moto->setBrand($request->request->get('brand'));
            $moto->setCategory($request->request->get('category'));
            $moto->setYear((int)$request->request->get('year'));
            $moto->setPower((int)$request->request->get('power'));
            $moto->setDisplacement((int)$request->request->get('displacement'));
            $moto->setEngineType($request->request->get('engineType'));
            $em->flush();
            $this->addFlash('succes', 'model mis à jour');
            return $this->redirectToRoute('admin_motos');
        }
        return $this->render('admin/moto_edit.html.twig', [
            'moto' => $moto
        ]);
    }

    #[Route('/motos/delete/{id}', name: 'admin_moto_delete')]
    public function deleteMoto(
        Moto $moto,
        EntityManagerInterface $em
    ): RedirectResponse {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $em->remove($moto);
        $em->flush();
        $this->addFlash('success', 'Model deleted');
        return $this->redirectToRoute('admin_motos');
    }
}
