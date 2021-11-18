<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Office;
use App\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $office = new Office();
        $office->setName('Bureau Executive');
        $manager->persist($office);

        $office = new Office();
        $office->setName('Bureau Politique');
        $manager->persist($office);

        $office = new Office();
        $office->setName('Conseil National');
        $manager->persist($office);

        $role = new Role();
        $role->setRole('SG');
        $manager->persist($role);

        $role = new Role();
        $role->setRole('SE');
        $manager->persist($role);

        $role = new Role();
        $role->setRole('SD');
        $manager->persist($role);

        $manager->flush();
    }
}
