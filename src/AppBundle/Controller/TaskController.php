<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/task")
 *
 * Class TaskController
 * @package AppBundle\Controller
 */
class TaskController extends Controller
{
    /**
     * @Route("/new", name="task_new")
     *
     * @param $request
     * @return Response
     */
    public function newAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task, ['user' => $this->getUser()]);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        if ($form->isSubmitted()) {
            $task->setUser($this->getUser());
            $em->persist($form->getData());
            $em->flush();
        }

        return $this->render('task/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
