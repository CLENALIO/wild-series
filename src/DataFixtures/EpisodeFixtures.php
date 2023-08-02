<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $episode = new Episode();
        $episode->setTitle('Episode 1');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_Walking dead'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 2');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_Walking dead'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 3');
        $episode->setNumber(3);
        $episode->setSeason($this->getReference('season1_Walking dead'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 1');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season2_Walking dead'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 2');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season2_Walking dead'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 1');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_Vikings'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 2');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_Vikings'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 1');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_The Last Of Us'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 2');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_The Last Of Us'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 1');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_The Good Place'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 2');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_The Good Place'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 1');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 2');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_Arcane'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 1');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_Hunter X Hunter'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 2');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_Hunter X Hunter'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 1');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_Game of Thrones'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 2');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_Game of Thrones'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 1');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_Stranger Things'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 2');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_Stranger Things'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 1');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_The Haunting of Hill House'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 2');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_The Haunting of Hill House'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 1');
        $episode->setNumber(1);
        $episode->setSeason($this->getReference('season1_The Originals'));
        $manager->persist($episode);
        $manager->flush();

        $episode = new Episode();
        $episode->setTitle('Episode 2');
        $episode->setNumber(2);
        $episode->setSeason($this->getReference('season1_The Originals'));
        $manager->persist($episode);
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont EpisodeFixtures dépend
        return [
            SeasonFixtures::class,
        ];
    }
}
