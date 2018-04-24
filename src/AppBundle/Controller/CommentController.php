<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Form\CommentType;
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
     * @Route("/delete/{id}", name="comment_delete")
     *
     * @param Comment $comment
     * @return Response
     */
    public function deleteAction(Comment $comment)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        return new Response(null, 204);
    }

    /**
     * @Route("/edit/{id}", name="comment_edit")
     *
     * @param Comment $comment
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function editAction(Comment $comment, Request $request)
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('task_show', ['slug' => $comment->getTask()->getSlug()]);
        }

        return $this->render('comment/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
