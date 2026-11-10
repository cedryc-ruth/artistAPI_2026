<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArtistFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $data = [
            [
                "firstname" => "Bob",
                "lastname" => "Dylan",
            ],
            [
                "firstname" => "Céline",
                "lastname" => "Dion",
            ],
            [
                "firstname" => "Claude",
                "lastname" => "MC Solaar",
            ],
            [
                "firstname" => "Eros",
                "lastname" => "Ramazzotti",
            ],
        ];

        foreach($data as $row) {
            $artist = new Artist();
            $artist->setFirstname( $row["firstname"]  );
            $artist->setLastname(  $row["lastname"]   );

            $manager->persist($artist);
        }      

        $manager->flush();
    }
}
