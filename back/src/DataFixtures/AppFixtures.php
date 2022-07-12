<?php

namespace App\DataFixtures;

use App\Entity\Guitars;
use App\Entity\Usuario;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $usuario = new Usuario();
        $usuario->setEmail('user@user.com');
        $usuario->setPassword('$2y$13$q72Y0UknX8yvIzbV9CE8lO3PoajiHVQM7r8LbLkXp5ewQKImMk3zK');
        $usuario->setNombre('usuario');
        $usuario->setPerfil('perfil');
        $manager->persist($usuario);

        for ($i=0; $i <4 ; $i++) { 
            $guitars = new Guitars;
            $guitars->setNombre('Guitarra');
            $guitars->setCaracteristicas('Guitarra');
            $guitars->setPrice(150);
            $guitars->setImagen('Guitarra');
            $guitars->setUsuarios($usuario);
            $manager->persist($guitars);
            
            
        }
        

        $manager->flush();
    }
}
