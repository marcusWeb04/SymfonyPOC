<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

final class EmployeeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $employee = new Employee();
        $employee
            ->setFirstName('Jeff')
            ->setLastName('Martins')
            ->addProjectOwner($this->getReference('project_owner_1'))
            ->addProjectOwner($this->getReference('project_owner_2'));

        $manager->persist($employee);
        $this->addReference('employee_1', $employee);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProjectOwnerFixtures::class,
        ];
    }
}