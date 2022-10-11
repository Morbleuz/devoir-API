<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Professeur;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class ProfesseurFixtures extends Fixture
{
    private $faker;
   

    public function __construct(){
        $this->faker=Factory::create("fr_FR");
       
 }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<100;$i++){
            $professeur = new Professeur();
            $professeur->setNom($this->faker->lastName())
            ->setPrenom($this->faker->firstName())
            ->setRue(substr($this->faker->streetAddress(),0,30))
            ->setVille($this->faker->city())
            ->setCodePostal($this->faker->postcode());
            $this->addReference('prof'.$i, $professeur);
            $manager->persist($professeur);
        }
        $manager->flush();
    }
}