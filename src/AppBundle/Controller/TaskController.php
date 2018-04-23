<?php

namespace AppBundle\Controller;

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

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/list", name="task_list")
     *
     * @return Response
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tasks = $em->getRepository(Task::class)->findAll();

        return $this->render('task/list.html.twig', ['tasks' => $tasks]);
    }

    /**
     * @Route("/show/{slug}", name="task_show")
     *
     * @param Task $task
     * @return Response
     */
    public function showAction(Task $task)
    {
        return $this->render('task/show.html.twig', ['task' => $task]);
    }

    /**
     * @Route("/edit/{slug}", name="task_edit")
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function editAction(Request $request, Task $task)
    {
        $form = $this->createForm(TaskType::class, $task, ['user' => $this->getUser()]);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('task_show', ['slug' => $task->getSlug()]);
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="task_delete")
     *
     * @param Task $task
     * @return Response
     */
    public function deleteAction(Task $task)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($task);
        $em->flush();

        return new Response(null, 204);
    }
}
