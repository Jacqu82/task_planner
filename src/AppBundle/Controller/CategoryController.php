<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Task;
use AppBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/category")
 *
 * Class CategoryController
 * @package AppBundle\Controller
 */
class CategoryController extends Controller
{
    /**
     * @Route("/new", name="category_new")
     *
     * @param $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $form = $this->createForm(CategoryType::class);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted()) {
            $em->persist($form->getData());
            $em->flush();
        }

        return $this->render('category/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/list", name="list_category")
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('category/list.html.twig', [
            'categories' => $categories
        ]);
    }
}
