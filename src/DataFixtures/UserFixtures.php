<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
class UserFixtures extends Fixture
{
    private $faker;
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->faker=Factory::create("fr_FR");
        $this->passwordHasher= $passwordHasher;
 }

    public function load(ObjectManager $manager): void
    {
       
            $user = new User();
            $user
            
            ->setRoles(array('ROLE_ADMIN'))
            ->setEmail(strtolower('test@gmail.com'))
            ->setPassword($this->passwordHasher->hashPassword($user, 'test'));
    
            $manager->persist($user);
        
        $manager->flush();
    }
}