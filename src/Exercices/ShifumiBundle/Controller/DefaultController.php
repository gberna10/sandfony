<?php

namespace Exercices\ShifumiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ExercicesShifumiBundle:Default:index.html.twig');
    }
}
