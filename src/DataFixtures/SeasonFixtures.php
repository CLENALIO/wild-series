<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2010);
        $season->setDescription('Reveille d un profond coma, Rick Grimes se rend compte qu une epidemie post apocalyptique a transforme la quasi totalite de la population americaine en zombie');
        $season->setProgram($this->getReference('program_Walking dead'));
        $this->addReference('season1_Walking dead', $season);
        $manager->persist($season);
        $manager->flush();

        $season = new Season();
        $season->setNumber(2);
        $season->setYear(2011);
        $season->setDescription('Tous les survivants se retrouvent à la ferme des Greene. Maggie et Glenn, profitant d une escapade au bourg voisin, se laissent aller a leur attirance mutuelle.');
        $season->setProgram($this->getReference('program_Walking dead'));
        $this->addReference('season2_Walking dead', $season);
        $manager->persist($season);
        $manager->flush();

        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2013);
        $season->setDescription('Scandinavie, à la fin du VIII siècle. Ragnar Lodbrok, un jeune guerrier viking, est avide d aventures et de nouvelles conquetes.');
        $season->setProgram($this->getReference('program_Vikings'));
        $this->addReference('season1_Vikings', $season);
        $manager->persist($season);
        $manager->flush();

        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2023);
        $season->setDescription('xxxxxxxxxxxxxx');
        $season->setProgram($this->getReference('program_The Last Of Us'));
        $this->addReference('season1_The Last Of Us', $season);
        $manager->persist($season);
        $manager->flush();

        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2017);
        $season->setDescription('xxxxxxxxxxxxxx');
        $season->setProgram($this->getReference('program_The Good Place'));
        $this->addReference('season1_The Good Place', $season);
        $manager->persist($season);
        $manager->flush();

        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2021);
        $season->setDescription('xxxxxxxxxxxxxx');
        $season->setProgram($this->getReference('program_Arcane'));
        $this->addReference('season1_Arcane', $season);
        $manager->persist($season);
        $manager->flush();

        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2011);
        $season->setDescription('xxxxxxxxxxxxxx');
        $season->setProgram($this->getReference('program_Hunter X Hunter'));
        $this->addReference('season1_Hunter X Hunter', $season);
        $manager->persist($season);
        $manager->flush();

        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2011);
        $season->setDescription('xxxxxxxxxxxxxx');
        $season->setProgram($this->getReference('program_Game of Thrones'));
        $this->addReference('season1_Game of Thrones', $season);
        $manager->persist($season);
        $manager->flush();

        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2016);
        $season->setDescription('xxxxxxxxxxxxxx');
        $season->setProgram($this->getReference('program_Stranger Things'));
        $this->addReference('season1_Stranger Things', $season);
        $manager->persist($season);
        $manager->flush();

        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2018);
        $season->setDescription('xxxxxxxxxxxxxx');
        $season->setProgram($this->getReference('program_The Haunting of Hill House'));
        $this->addReference('season1_The Haunting of Hill House', $season);
        $manager->persist($season);
        $manager->flush();

        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2013);
        $season->setDescription('xxxxxxxxxxxxxx');
        $season->setProgram($this->getReference('program_The Originals'));
        $this->addReference('season1_The Originals', $season);
        $manager->persist($season);
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont SeasonFixtures dépend
        return [
            ProgramFixtures::class,
        ];
    }
}
