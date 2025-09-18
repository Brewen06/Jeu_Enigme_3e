<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class JeuController extends AbstractController
{
    #[Route('/jeu', name: 'app_jeu')]
    public function index(): Response
    {
        return $this->render('jeu/index.html.twig', [
            'controller_name' => 'JeuController',
            'equipe_nom' => null,
        ]);
    }

    #[Route('/jeu/mur-enigme', name: 'app_choisir_enigme')]
    public function indexEquipe(string $equipe_nom): Response
    {
        return $this->render('jeu/index.html.twig', [
            'controller_name' => 'JeuController',
            'equipe_nom' => $equipe_nom,
        ]);
    }
}
