<?php

namespace Exercices\ShifumiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ShifumiController extends Controller
{
	/**
	 * @route("/shifumi/salut", name="shifumi_salut")
	 **/
	public function Salut(Request $request)
	{
		return new Response("salut");
	}
}
