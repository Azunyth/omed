<?php

namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Article;

class ArticleController extends Controller
{
    /**
     * @Route("/article/add", name="addArticle")
     */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $form = $this->createFormBuilder(new Article())
                ->add("title")
                ->add("author")
                ->add("content")
                ->add("submit", SubmitType::class, array('label' => 'Ajouter'))
                ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $article = $form->getData();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute("listArticles");
        }

        return $this->render('AdminBundle:Article:add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/articles", name="listArticles")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articleRepo = $em->getRepository("AppBundle:Article");
        $articles = $articleRepo->findAll();

        return $this->render('AdminBundle:Article:list.html.twig', array(
            'articles' => $articles
        ));
    }

    /**
     * @Route("/article/delete/{id}", name="deleteArticle")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $articleRepo = $em->getRepository("AppBundle:Article");
        $article = $articleRepo->find($id);
        $em->remove($article);
        $em->flush();

        return $this->redirectToRoute("listArticles");
    }

}
