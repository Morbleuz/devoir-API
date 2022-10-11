<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Etablissement;
use App\Entity\Professeur;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EtablissementFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;
    

    public function __construct(){
        $this->faker=Factory::create("fr_FR");
       
    }

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<5;$i++){
            $etablissement = new Etablissement();
            $etablissement->setRne($this->faker->sentence(1));
            $etablissement->setNom(($this->faker->firstName(). ' '.$this->faker->lastName()));
            $etablissement->setType($this->faker->sentence(1));
            $etablissement->setReferent($this->getReference('prof'.mt_rand(0,99)));
            for($j=0;$j<mt_rand(10,50);$j++){
                $etablissement->addProfesseur($this->getReference('prof'.mt_rand(0,99)));
            }
            $manager->persist($etablissement);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProfesseurFixtures::class,
        ];
    }
}