<?php

namespace UserBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

class UserFixtures implements Fixture
{
    public function load(ObjectManager $manager)
    {
        // On crée l'utilisateur
        $user = new User;

        // Le nom d'utilisateur et le mot de passe sont identiques pour l'instant
        $user->setUsername('studeal');
        $user->setPassword('studeal');

        // On ne se sert pas du sel pour l'instant
        $user->setSalt('');
        // On définit uniquement le role ROLE_USER qui est le role de base
        $user->setRoles(array('ROLE_USER'));

        // On le persiste
        $manager->persist($user);
        $manager->flush();
    }
}