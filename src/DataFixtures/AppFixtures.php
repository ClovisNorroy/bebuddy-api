<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setRoles(["ROLE_USER"]);
            $user->setUsername($faker->userName());
            $password = $faker->password();
            $user->setPasswordView($password);
            $user->setPassword($this->userPasswordHasher->hashPassword($user, $password));
            $manager->persist($user);
        }
        $user = new User();
        $user->setEmail("engywook@gmail.com");
        $user->setUsername("Engywook");
        $user->setRoles(["ROLE_USER"]);
        $password = "123456789";
        $user->setPasswordView($password);
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $password));
        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $activity = new Activity();
            $activity->setTitle($faker->words(4, true));
            $activity->setDescription($faker->paragraph(2));
            $activity->setPlace($faker->city());
            $activity->setDate($faker->dateTime());
            $activity->setIsPublic($faker->boolean());
            $manager->persist($activity);
        }
        $manager->flush();
    }
}
