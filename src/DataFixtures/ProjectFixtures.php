<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Status;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $project = new Project();
        $project
            ->setName('Project 1')
            ->setPresentation('Présentation 1')
            ->setCreatedAt(new \DateTimeImmutable('2023-01-01'))
            ->setActivity('Activité 1')
            ->setStatus($this->getReference(StatusFixtures::STATUT_EI));

        $manager->persist($project);
        $this->addReference('project_1', $project);

        $project = new Project();
        $project
            ->setName('Project 2')
            ->setPresentation('Présentation 2')
            ->setCreatedAt(new \DateTimeImmutable('2024-01-01'))
            ->setActivity('Activité 2')
            ->setStatus($this->getReference(StatusFixtures::STATUT_EURL));

        $manager->persist($project);
        $this->addReference('project_2', $project);

        $project = new Project();
        $project
            ->setName('Project 3')
            ->setPresentation('Présentation 3')
            ->setCreatedAt(new \DateTimeImmutable('2024-03-03'))
            ->setActivity('Activité 2')
            ->setStatus($this->getReference(StatusFixtures::STATUT_SA));

        $manager->persist($project);
        $this->addReference('project_3', $project);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            StatusFixtures::class,
        ];
    }
}
