<?php

namespace Exercices\ArchiveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ExercicesArchiveBundle:Default:index.html.twig');
    }
}
