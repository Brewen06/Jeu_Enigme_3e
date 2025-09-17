<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class EquipeController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private FormFactoryInterface $formFactory;
    private EquipeRepository $EquipeRepository;

    public function __construct(EquipeRepository $EquipeRepository, EntityManagerInterface $entityManager, FormFactoryInterface $formFactory)
    {
        $this->EquipeRepository = $EquipeRepository;
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
    }

    #[Route('/equipe', name: 'app_equipe')]
    public function index(): Response
    {
        $equipes = $this->EquipeRepository->findAll();

        return $this->render('equipe/index.html.twig', [
            'equipes' => $equipes,
        ]);
    }

    #[Route('/equipe/creer', name: 'creer_equipe')]
    public function creation(Request $Request): Response
    {
        $equipe = new Equipe();
        $form = $this->formFactory->create(EquipeType::class, $equipe);
        $form->handleRequest($Request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($equipe);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_equipe');
         }

            return $this->render('equipe/creer.html.twig', [
             'form' => $form->createView(),
        ]);
    }
}
