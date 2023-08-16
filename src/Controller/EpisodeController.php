<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Season;
use App\Form\EpisodeType;
use App\Repository\EpisodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[Route('/episode')]
class EpisodeController extends AbstractController
{
    #[Route('/', name: 'app_episode_index', methods: ['GET'])]
    public function index(EpisodeRepository $episodeRepository, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();

        return $this->render('episode/index.html.twig', [
            'episodes' => $episodeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_episode_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
    {
        $episode = new Episode();
        $form = $this->createForm(EpisodeType::class, $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $season = $episode->getSeason();
            $season->addEpisode($episode);
            $entityManager->persist($season);

            $entityManager->persist($episode);
            $entityManager->flush();

            // Envoi mail automatique
            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to('caroline.le.nalio@hotmail.fr')
                ->subject('Un nouvel épisode vient d\'être publié !')
                ->html($this->renderView('Episode/newEpisodeEmail.html.twig', ['episode' => $episode]));

            $mailer->send($email);

            // Once the form is submitted, valid and the data inserted in database : flash message
            $this->addFlash('success', 'The new episode has been created');

            return $this->redirectToRoute('app_episode_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('episode/new.html.twig', [
            'episode' => $episode,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_episode_show', methods: ['GET'])]
    public function show(Episode $episode): Response
    {
        return $this->render('episode/show.html.twig', [
            'episode' => $episode,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_episode_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Episode $episode, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EpisodeType::class, $episode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            // Once the form is submitted, valid and the data inserted in database : flash message
            $this->addFlash('success', 'The episode has been updated');

            return $this->redirectToRoute('app_episode_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('episode/edit.html.twig', [
            'episode' => $episode,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_episode_delete', methods: ['POST'])]
    public function delete(Request $request, Episode $episode, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $episode->getId(), $request->request->get('_token'))) {
            $entityManager->remove($episode);
            $entityManager->flush();

            // Once the form is submitted, data removed from database : flash message
            $this->addFlash('danger', 'Episode has been deleted');
        }

        return $this->redirectToRoute('app_episode_index', [], Response::HTTP_SEE_OTHER);
    }
}
