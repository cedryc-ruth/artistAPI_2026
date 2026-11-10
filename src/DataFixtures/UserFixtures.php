<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $uph)
    {
        $this->passwordHasher = $uph;
    }

    public function load(ObjectManager $manager): void
    {
        $data = [
            [
                "email"=>"bob@sull.com",
                "login"=>"bob",
                "firstname"=>"Bob",
                "lastname"=>"Sull",
                "langue"=>"fr",
                "password"=>"epfc",
                "role"=>["ROLE_ADMIN"],
            ],
            [
                "email"=>"lydia@sull.com",
                "login"=>"lydia",
                "firstname"=>"Lydia",
                "lastname"=>"Sull",
                "langue"=>"nl",
                "password"=>"epfc",
                "role"=>["ROLE_USER"],
            ],
            [
                "email"=>"fred@sull.com",
                "login"=>"fred",
                "firstname"=>"Fred",
                "lastname"=>"Sull",
                "langue"=>"en",
                "password"=>"epfc",
                "role"=>["ROLE_USER"],
            ],
        ];

        foreach($data as $row) {
            $user = new User();
            $user->setEmail($row["email"]);
            $user->setLogin($row["login"]);
            $user->setFirstname($row["firstname"]);
            $user->setLastname($row["lastname"]);
            $user->setLangue($row["langue"]);

            $hashedPassword = $this->passwordHasher->hashPassword(
                $user,
                $row["password"]
            );

            $user->setPassword($hashedPassword);

            $user->setRoles($row["role"]);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
