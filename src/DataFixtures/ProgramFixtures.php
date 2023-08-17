<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $program = new Program();
        $program->setTitle('Walking dead');
        $program->setPoster('https://www.ecranlarge.com/uploads/image/001/457/the-walking-dead-photo-1457455.jpg');
        $program->setSynopsis('Des zombies envahissent la terre');
        $program->setCategory($this->getReference('category_Action'));
        $program->setOwner($this->getReference('contributor1'));
        $this->addReference('program_1', $program);
        $program->setSlug($this->slugger->slug($program->getTitle()));

        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Vikings');
        $program->setPoster('https://www.ecranlarge.com/media/cache/1600x1200/uploads/image/001/361/okttnfm8pzdseik1x0e0xhb6lvp-749.jpg');
        $program->setSynopsis('Ragnar Lodbrok, un jeune guerrier viking, lassé des pillages sur les terres de l Est, se met en tête d explorer l Ouest');
        $program->setCategory($this->getReference('category_Action'));
        $program->setOwner($this->getReference('contributor1'));
        $this->addReference('program_2', $program);
        $program->setSlug($this->slugger->slug($program->getTitle()));

        $manager->persist($program);

        $program = new Program();
        $program->setTitle('The Last Of Us');
        $program->setPoster('https://fr.web.img2.acsta.net/pictures/23/01/12/12/36/0727474.jpg');
        $program->setSynopsis('L adaptation du jeu vidéo The Last Of Us en série');
        $program->setCategory($this->getReference('category_Aventure'));
        $program->setOwner($this->getReference('contributor1'));
        $this->addReference('program_3', $program);
        $program->setSlug($this->slugger->slug($program->getTitle()));

        $manager->persist($program);

        $program = new Program();
        $program->setTitle('The Good Place');
        $program->setPoster('https://fr.web.img6.acsta.net/pictures/18/11/26/12/29/3770421.jpg');
        $program->setSynopsis('Percutée par un semi-remorque, Eleanor se réveille dans l au-delà');
        $program->setCategory($this->getReference('category_Aventure'));
        $program->setOwner($this->getReference('contributor1'));
        $this->addReference('program_4', $program);
        $program->setSlug($this->slugger->slug($program->getTitle()));

        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Arcane');
        $program->setPoster('https://fr.web.img6.acsta.net/pictures/21/11/02/11/12/2878509.jpg');
        $program->setSynopsis('Série animée qui se déroule dans l univers de la franchise de jeu vidéo "League of Legends"');
        $program->setCategory($this->getReference('category_Animation'));
        $program->setOwner($this->getReference('contributor1'));
        $this->addReference('program_5', $program);
        $program->setSlug($this->slugger->slug($program->getTitle()));

        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Hunter X Hunter');
        $program->setPoster('https://fr.web.img2.acsta.net/pictures/19/07/31/13/28/3312695.jpg');
        $program->setSynopsis('Abandonné par son père, un aventurier et chasseur de primes, le jeune Gon décide à de partir pour devenir un Hunter');
        $program->setCategory($this->getReference('category_Animation'));
        $program->setOwner($this->getReference('contributor1'));
        $this->addReference('program_6', $program);
        $program->setSlug($this->slugger->slug($program->getTitle()));

        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Game of Thrones');
        $program->setPoster('https://fr.web.img3.acsta.net/c_310_420/pictures/23/01/03/14/13/0717778.jpg');
        $program->setSynopsis('Dans un pays où l été peut durer plusieurs années et l hiver toute une vie, des forces sinistres et surnaturelles se pressent aux portes du Royaume des Sept Couronnes');
        $program->setCategory($this->getReference('category_Fantastique'));
        $program->setOwner($this->getReference('contributor1'));
        $this->addReference('program_7', $program);
        $program->setSlug($this->slugger->slug($program->getTitle()));

        $manager->persist($program);

        $program = new Program();
        $program->setTitle('Stranger Things');
        $program->setPoster('');
        $program->setSynopsis('1983, à Hawkins dans l Indiana. Après la disparition d un garçon de 12 ans dans des circonstances mystérieuses');
        $program->setCategory($this->getReference('category_Fantastique'));
        $program->setOwner($this->getReference('contributor1'));
        $this->addReference('program_8', $program);
        $program->setSlug($this->slugger->slug($program->getTitle()));

        $manager->persist($program);

        $program = new Program();
        $program->setTitle('The Haunting of Hill House');
        $program->setPoster('https://fr.web.img4.acsta.net/pictures/22/05/18/14/31/5186184.jpg');
        $program->setSynopsis('La famille doit enfin affronter les fantômes de son passé, dont certains sont encore bien présents dans leurs esprits alors que d’autres continuent de traquer Hill House');
        $program->setCategory($this->getReference('category_Horreur'));
        $program->setOwner($this->getReference('contributor1'));
        $this->addReference('program_9', $program);
        $program->setSlug($this->slugger->slug($program->getTitle()));

        $manager->persist($program);

        $program = new Program();
        $program->setTitle('The Originals');
        $program->setPoster('https://fr.web.img5.acsta.net/pictures/18/04/12/10/49/5377636.jpg');
        $program->setSynopsis('Spin-off de Vampire Diaries centré autour du personnage de Klaus');
        $program->setCategory($this->getReference('category_Horreur'));
        $program->setOwner($this->getReference('contributor1'));
        $this->addReference('program_10', $program);
        $program->setSlug($this->slugger->slug($program->getTitle()));

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
