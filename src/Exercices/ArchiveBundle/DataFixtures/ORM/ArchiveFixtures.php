<?php

namespace Exercices\ArchiveBundle\DataFixtures\ORM;

use Exercices\ArchiveBundle\Entity\Archive;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArchiveFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $archive = new Archive();
        $archive->setTitle('Title ');
        $archive->setDescription('Description ');
        $archive->setLink('ok');
        $archive->setSize(142);
        $archive->setExtension('pdf');
        
        $manager->persist($archive);
        $manager->flush();
    }
}