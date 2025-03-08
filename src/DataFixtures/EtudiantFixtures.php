<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EtudiantFixtures extends Fixture

{
    public function __construct(

        private UserPasswordHasherInterface $passwordHasher){}

    public function load(ObjectManager $manager): void
    {
        /*
        $etudiant = new Etudiant();
        $etudiant->setEmail("mehdibaggar7@gmail.com");
        $etudiant->setPassword($this->passwordHasher->hashPassword($etudiant, "mehdi123M"));
        $etudiant->setRoles(["ROLE_ADMIN"]);
        $manager->persist($etudiant);
        $manager->flush();*/


        // $product = new Product();
        // $manager->persist($product);


    }
}
