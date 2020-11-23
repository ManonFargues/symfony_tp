<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class GameFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for($i = 0; $i < 60; $i++) {
            $game = new Game();

            $game->setName($faker->text(25));
            $game->setDateAdd($faker->dateTimeBetween('-2 years', 'now'));
            $game->setDescription($faker->text(300));
            $game->setUser($this->getReference('user'.random_int(0, UserFixtures::USER_COUNT - 1)));
            $manager->persist($game);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}