<?php

namespace App\Controller;

use App\Repository\EquipeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class JeuController extends AbstractController
{
    private EquipeRepository $equipeRepository;

    public function __construct(EquipeRepository $equipeRepository)
    {
        $this->equipeRepository = $equipeRepository;
    }
    #[Route(path:"/", name:"accueil")]
    public function accueil(Request $request): Response
    {
        return $this->render('base.html.twig');

    }

    #[Route('/jeu', name: 'app_jeu')]
    public function index(): Response
    {
        return $this->render('jeu/index.html.twig', [
            'controller_name' => 'JeuController',
            'equipe_nom' => null,
        ]);
    }

    #[Route('/jeu/mur-enigme/{id}', name: 'app_choisir_enigme')]
    public function choisirEnigme(int $id, EquipeRepository $equipeRepository): Response
    {
        $equipe = $equipeRepository->find($id);

    if (!$equipe) {
        throw $this->createNotFoundException("Équipe non trouvée");
    }

    return $this->render('jeu/mur-enigme.html.twig', [
        'equipe_nom' => $equipe->getNom(),
        'id' => $id,
    ]);
    }
}
