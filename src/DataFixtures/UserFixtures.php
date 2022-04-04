<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    //-----PROPRIÉtER------------//
    private $encoder;
    //---------CONSTRUCTEUR-------------// 
    public function __construct(UserPasswordHasherInterface $userPassewordHasherInterface)
    {
        $this->encoder = $userPassewordHasherInterface;
    }
            //-------METHODES---------//
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setPrenom("alexandre");
        $user->setNom("champ");
        $user->setEmail("test@test.com");
        $user->setRoles(['ROLE_USER', 'ROLE_ADMIN']);
        $user->setAbonnementNewsletter('true');
        $password = $this->encoder->hashPassword($user, "pass");
        $user->setPassword($password);
        $user->setIsVerified(true);
        $manager->persist($user);
        //

        $user = new User();
        $user->setPrenom("jean");
        $user->setNom("test ");
        $user->setEmail("jeantest@test.com");
        $user->setRoles(['ROLE_USER']);
        $user->setAbonnementNewsletter('false');
        $password = $this->encoder->hashPassword($user, "pass");
        $user->setPassword($password);
        $user->setIsVerified(true);
        $manager->persist($user);

        $manager->flush();
    }
}
