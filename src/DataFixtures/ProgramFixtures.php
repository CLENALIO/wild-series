<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $program = new Program();
        $program->setTitle('Walking dead');
        $program->setSynopsis('Des zombies envahissent la terre');
        $program->setCategory($this->getReference('category_Action'));
        $this->addReference('program_1', $program);
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Vikings');
        $program->setSynopsis('Ragnar Lodbrok, un jeune guerrier viking, lassé des pillages sur les terres de l Est, se met en tête d explorer l Ouest');
        $program->setCategory($this->getReference('category_Action'));
        $this->addReference('program_2', $program);
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('The Last Of Us');
        $program->setSynopsis('L adaptation du jeu vidéo The Last Of Us en série');
        $program->setCategory($this->getReference('category_Aventure'));
        $this->addReference('program_3', $program);
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('The Good Place');
        $program->setSynopsis('Percutée par un semi-remorque, Eleanor se réveille dans l au-delà');
        $program->setCategory($this->getReference('category_Aventure'));
        $this->addReference('program_4', $program);
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Arcane');
        $program->setSynopsis('Série animée qui se déroule dans l univers de la franchise de jeu vidéo "League of Legends"');
        $program->setCategory($this->getReference('category_Animation'));
        $this->addReference('program_5', $program);
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Hunter X Hunter');
        $program->setSynopsis('Abandonné par son père, un aventurier et chasseur de primes, le jeune Gon décide à de partir pour devenir un Hunter');
        $program->setCategory($this->getReference('category_Animation'));
        $this->addReference('program_6', $program);
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Game of Thrones');
        $program->setSynopsis('Dans un pays où l été peut durer plusieurs années et l hiver toute une vie, des forces sinistres et surnaturelles se pressent aux portes du Royaume des Sept Couronnes');
        $program->setCategory($this->getReference('category_Fantastique'));
        $this->addReference('program_7', $program);
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('Stranger Things');
        $program->setSynopsis('1983, à Hawkins dans l Indiana. Après la disparition d un garçon de 12 ans dans des circonstances mystérieuses');
        $program->setCategory($this->getReference('category_Fantastique'));
        $this->addReference('program_8', $program);
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('The Haunting of Hill House');
        $program->setSynopsis('La famille doit enfin affronter les fantômes de son passé, dont certains sont encore bien présents dans leurs esprits alors que d’autres continuent de traquer Hill House');
        $program->setCategory($this->getReference('category_Horreur'));
        $this->addReference('program_9', $program);
        $manager->persist($program);
        $manager->flush();

        $program = new Program();
        $program->setTitle('The Originals');
        $program->setSynopsis('Spin-off de Vampire Diaries centré autour du personnage de Klaus');
        $program->setCategory($this->getReference('category_Horreur'));
        $this->addReference('program_10', $program);
        $manager->persist($program);
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
