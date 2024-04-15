<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\ProjectOwner;
use App\Enum\GenderEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class ProjectOwnerFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $projectOwner = new ProjectOwner();
        $projectOwner
            ->setFirstName('John')
            ->setLastName('Doe')
            ->setEmail('john.doe@gmail.com')
            ->setGender(GenderEnum::Man)
            ->setCity('Bordeaux')
            ->setProject($this->getReference('project_1'));
        $manager->persist($projectOwner);
        $this->addReference('project_owner_1', $projectOwner);

        $projectOwner = new ProjectOwner();
        $projectOwner
            ->setFirstName('Jane')
            ->setLastName('Doe')
            ->setEmail('jone.doe@gmail.com')
            ->setGender(GenderEnum::Woman)
            ->setCity('Paris')
            ->setProject($this->getReference('project_2'));
        $manager->persist($projectOwner);
        $this->addReference('project_owner_2', $projectOwner);

        $projectOwner = new ProjectOwner();
        $projectOwner
            ->setFirstName('Debora')
            ->setLastName('Doe')
            ->setEmail('debora.doe@gmail.com')
            ->setGender(GenderEnum::Woman)
            ->setCity('Lyon')
            ->setProject($this->getReference('project_3'));
        $manager->persist($projectOwner);
        $this->addReference('project_owner_3', $projectOwner);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProjectFixtures::class,
        ];
    }
}