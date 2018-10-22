<?php

namespace Exercices\ArchiveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Exercices\ArchiveBundle\Entity\Archive;
use Exercices\ArchiveBundle\Form\ArchiveType;
use Symfony\Component\HttpFoundation\File\File;


class ArchiveController extends Controller
{
	
	/**
	 * @route("/archive", name="archive_list")
	 */
	public function indexAction(Request $request)
	{
		$repository = $this->getDoctrine()
		->getManager()
		->getRepository('Exercices\ArchiveBundle\Entity\Archive');

		$archives = $repository->findAll();

		//dump($archives);

		return $this->render('@archive/Archive/list.html.twig', array(
			'archives' => $archives
		));


	}

	/**
     * @Route("/archive/upload", name="archive_upload_file")
     */
	public function newFileAction(Request $request)
	{
		 
   
        $archive = new Archive();
        //$form = $this->createForm(ArchiveType::class, $archive);
        $form   = $this->get('form.factory')->create(ArchiveType::class, $archive);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        	 /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
        	$file = $archive->getLink();

        	$extension = $file->guessExtension();
        	$size = $file->getClientSize();

            $fileName = md5(uniqid()).'.'.$extension;


           

            // Move the file to the directory 
            try {
                $file->move(
                    $this->getParameter('archives_directory'),
                    $fileName
                );
                $archive->setLink($this->getParameter('archives_directory').$fileName);
            } catch (FileException $e) {
               
            }

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $archive->setExtension($extension);
            $archive->setSize($size);

            $em = $this->getDoctrine()->getManager();
      		$em->persist($archive);
      		$em->flush();
      		$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

            // ... persist the $product variable or any other work

            return $this->redirect($this->generateUrl('archive_list'));
        }

        return $this->render('@archive/Archive/upload.html.twig', array(
            'form' => $form->createView(),
        ));
    }


	/**
	 * @route("/archive/dowload", name="archive_download_file")
	 **/
	public function getFileAction(Request $request)
	{

		$id = $request->query->get('id');

		$repository = $this->getDoctrine()
		->getManager()
		->getRepository('Exercices\ArchiveBundle\Entity\Archive');

		$archives = $repository->find($id);

		echo $archives->getLink();

		$pdfPath = $archives->getLink();

		$pdfPath = new File($archives->getLink());

        return $this->file($pdfPath);
		//return new Response("toto");
	}

	/**
     * @Route("/test", name="test")
     */
	public function testAction(Request $request)
	{
		return $this->render('@archive/Archive/test.html.twig',array(
			'test' => 'test'
		));


	}
	
}
