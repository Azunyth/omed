<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Game;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
    * @Route("/about/{id}", requirements={"id":"\d*"}, defaults={"id":1})
    *
    */
    public function aboutAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder(new Game())
                ->add("title")
                ->add("releaseAt", DateType::class)
                ->add("pegi")
                ->add("submit", SubmitType::class, array('label' => "Ajouter"))
                ->getForm();

        $form->handleRequest($request);

        if($request->isMethod('post')) {
            $game = $form->getData();
            $em->persist($game);
            $em->flush();
        }

        return $this->render('default/about.html.twig',
                            ['formGen' => $form->createView()]);
    }
}
