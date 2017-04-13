<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

        /*$game = new Game();
        $game->setTitle('Crash Bandicoot');
        $game->setReleaseAt(new \DateTime('02/03/1997'));
        $game->setPegi(3);

        $em->persist($game);
        $em->flush();*/

        $gameRepo = $em->getRepository("AppBundle:Game");
        $game = $gameRepo->find(1);

        return $this->render('default/about.html.twig',
                            ['game' => $game]);
    }
}
