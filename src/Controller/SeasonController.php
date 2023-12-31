<?php

namespace App\Controller;

use App\Entity\Season;
use App\Entity\Program;
use App\Form\SeasonType;
use App\Repository\SeasonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/season')]
class SeasonController extends AbstractController
{
    #[Route('/', name: 'season_index', methods: ['GET'])]
    public function index(SeasonRepository $seasonRepository, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        return $this->render('season/index.html.twig', [
            'seasons' => $seasonRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'season_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $season = new Season();
        $form = $this->createForm(SeasonType::class, $season);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $program = $season->getProgram();
            $program->addSeason($season);
            $entityManager->persist($program);

            $entityManager->persist($season);
            $entityManager->flush();

            // Once the form is submitted, valid and the data inserted in database : flash message
            $this->addFlash('success', 'The new season has been created');

            return $this->redirectToRoute('season_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('season/new.html.twig', [
            'season' => $season,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'season_show', methods: ['GET'])]
    public function show(Season $season): Response
    {
        return $this->render('season/show.html.twig', [
            'season' => $season,
        ]);
    }

    #[Route('/{id}/edit', name: 'season_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Season $season, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SeasonType::class, $season);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Once the form is submitted, valid and the data inserted in database : flash message
            $this->addFlash('success', 'The season has been updated');

            return $this->redirectToRoute('season_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('season/edit.html.twig', [
            'season' => $season,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'season_delete', methods: ['POST'])]
    public function delete(Request $request, Season $season, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $season->getId(), $request->request->get('_token'))) {
            $entityManager->remove($season);
            $entityManager->flush();

            // Once the form is submitted, data removed from database : flash message
            $this->addFlash('danger', 'Season has been deleted');
        }

        return $this->redirectToRoute('season_index', [], Response::HTTP_SEE_OTHER);
    }
}
