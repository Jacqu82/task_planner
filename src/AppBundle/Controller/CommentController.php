<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Form\CategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/comment")
 *
 * Class CategoryController
 * @package AppBundle\Controller
 */
class CommentController extends Controller
{
    /**
     * @Route("/new", name="category_new")
     *
     * @param $request
     * @return Response
     */
    public function newAction(Request $request)
    {

    }
}
