<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Form\ProgramType;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Repository\ProgramRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;
use App\Entity\User;
use App\Form\SearchProgramType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function program(Request $request, ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        $form = $this->createForm(SearchProgramType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $searchProgram = $form->getData()['Serie'];
            $searchActor = $form->getData()['Acteur'];
            $programs = $programRepository->findLikeName($searchProgram, $searchActor);
        } else {
            $programs = $programRepository->findAll();
        }

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
            'form' => $form,
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, MailerInterface $mailer, ProgramRepository $programRepository, SluggerInterface $slugger): Response
    {
        // Create a new Category Object
        $program = new Program();
        // Create the associated Form
        $form = $this->createForm(ProgramType::class, $program);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {

            $slug = $slugger->slug($program->getTitle());
            $program->setSlug($slug);
            // Set the program's owner
            $program->setOwner($this->getUser());
            $programRepository->save($program, true);

            // Once the form is submitted, valid and the data inserted in database, you can define the success flash message
            $this->addFlash('success', 'The new program has been created');

            // Envoi mail automatique
            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to('caroline.le.nalio@hotmail.fr')
                ->subject('Une nouvelle série vient d\'être publiée !')
                ->html($this->renderView('Program/newProgramEmail.html.twig', ['program' => $program]));

            $mailer->send($email);

            // Redirect to program list
            return $this->redirectToRoute('program_index');
        }

        // Render the form
        return $this->render('program/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/show/{slug}', requirements: ['page' => '\d+'], methods: ['GET'], name: 'show')]
    public function show(Program $program): Response
    {
        if (!$program) {
            throw $this->createNotFoundException(
                'No program found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', ['program' => $program]);
    }

    #[Route('/{slug}/edit', name: 'edit', methods: ['GET', 'POST'])]
    #[Route('/', name: 'app_home')]
    public function edit(Request $request, Program $program, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        // Check wether the logged in user is the owner of the program
        if ($this->getUser() !== $program->getOwner()) {
            // If not the owner, throws a 403 Access Denied exception
            throw $this->createAccessDeniedException('Only the owner can edit the program!');
        }

        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($program->getTitle());
            $program->setSlug($slug);

            $entityManager->flush();

            return $this->redirectToRoute('program_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('program/edit.html.twig', [
            'program' => $program,
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Program $program, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        if ($this->isCsrfTokenValid('delete' . $program->getSlug(), $request->request->get('_token'))) {
            $entityManager->remove($program);
            $entityManager->flush();
        }

        return $this->redirectToRoute('program_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{slug}/season{season_number<\d+>}', methods: ['GET'], name: 'season_show')]
    #[Entity('season', options: ['mapping' => ['season_number' => 'number']])]
    public function showSeason(Program $program, Season $season): Response
    {
        if (!$program) {
            throw $this->createNotFoundException(
                'No program found in program\'s table.'
            );
        }

        if (!$season) {
            throw $this->createNotFoundException(
                'No season found in season\'s table.'
            );
        }

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }

    #[Route('/{slug}/season{season_number<\d+>}/episode{episode_number<\d+>}', methods: ['GET'], name: 'episode_show')]
    #[Entity('season', options: ['mapping' => ['season_number' => 'number']])]
    #[Entity('episode', options: ['mapping' => ['episode_number' => 'number']])]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        if (!$program) {
            throw $this->createNotFoundException(
                'No program found in program\'s table.'
            );
        }

        if (!$season) {
            throw $this->createNotFoundException(
                'No season found in season\'s table.'
            );
        }

        if (!$episode) {
            throw $this->createNotFoundException(
                'No episode found in episode\'s table.'
            );
        }

        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }

    #[Route('/{slug}/watchlist', name: 'watchlist', methods: ['GET', 'POST'])]
    public function addToWatchlist(Program $program, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {

        $slug = $slugger->slug($program->getTitle());
        $program->setSlug($slug);

        /** @var \App\Entity\User */
        $user = $this->getUser();
        if ($user->isInWatchlist($program)) {
            $user->removeFromWatchlist($program);
        } else {
            $user->addToWatchlist($program);
        }

        $entityManager->persist($program);
        $entityManager->flush();

        return $this->render('program/show.html.twig', ['program' => $program]);
    }
}
