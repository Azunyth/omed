<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ArticleController extends Controller
{
    /**
     * @Route("/articles")
     */
    public function allAction()
    {
        return $this->render('AppBundle:Article:all.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/article/{id}")
     */
    public function detailAction($id)
    {
        return $this->render('AppBundle:Article:detail.html.twig', array(
            // ...
        ));
    }

}
