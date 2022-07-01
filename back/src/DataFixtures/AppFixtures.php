<?php

namespace App\DataFixtures;

use App\Entity\BassGuitar;
use App\Entity\Guitars;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User;
        $user->setUsername('Guillermo');
        $user->setPassword('$2y$13$iKZGkhpaUfnsPLrKDB/jl.16byUd9AKdifxrY4H3hL6ncuvjSpIN.');
        $manager->persist($user);

        for ($i = 0; $i < 2; $i++) {
            $bajo = new BassGuitar;
            $bajo->setNombre('Bajo númeroo: ' . $i);
            $bajo->setImagen('imagen.jpg');
            $bajo->setCaracteristicas('Caracteristicas: ' . $i);
            $manager->persist($bajo);

            for ($j = 0; $j < 2; $j++) {
                $guitarra = new Guitars;
                $guitarra->setNombre('Guitarra número: ' . $j);
                $guitarra->setImagen('imagen.jpg');
                $guitarra->setCaracteristicas('Caracteristicas: ' . $j);
                $manager->persist($guitarra);
            }
     
        };

        $manager->flush();
    }
}
