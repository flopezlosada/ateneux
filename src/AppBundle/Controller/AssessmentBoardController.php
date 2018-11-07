<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AssessmentBoard;
use AppBundle\Entity\Course;
use AppBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Assessmentboard controller.
 *
 */
class AssessmentBoardController extends Controller
{
    /**
     * Lists all assessmentBoard entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $assessmentBoards = $em->getRepository('AppBundle:AssessmentBoard')->findAll();

        return $this->render('assessmentboard/index.html.twig', array(
            'assessmentBoards' => $assessmentBoards,
        ));
    }

    /**
     * Creates a new assessmentBoard entity.
     *
     */
    public function newAction($course_id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $course = $em->getRepository('AppBundle:Course')->find($course_id);
        $assessmentBoard = new Assessmentboard();
        $form = $this->createForm('AppBundle\Form\AssessmentBoardType', $assessmentBoard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $assessmentBoard->setCourse($course);
            $em->persist($assessmentBoard);
            $assessmentBoard->setDate(new \DateTime($assessmentBoard->getDate()));
            $em->persist($assessmentBoard);
            $em->flush();

            return $this->redirectToRoute('assessmentboard_show', array('id' => $assessmentBoard->getId()));
        }

        return $this->render('assessmentboard/new.html.twig', array(
            'assessmentBoard' => $assessmentBoard,
            'form' => $form->createView(),
            'course' => $course
        ));
    }

    /**
     * Finds and displays a assessmentBoard entity.
     *
     */
    public function showAction(AssessmentBoard $assessmentBoard)
    {
        $deleteForm = $this->createDeleteForm($assessmentBoard);

        return $this->render('assessmentboard/show.html.twig', array(
            'assessmentBoard' => $assessmentBoard,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing assessmentBoard entity.
     *
     */
    public function editAction(Request $request, AssessmentBoard $assessmentBoard)
    {
        $deleteForm = $this->createDeleteForm($assessmentBoard);
        $assessmentBoard->setDate($assessmentBoard->getDate()->format('Y-m-d'));
        $editForm = $this->createForm('AppBundle\Form\AssessmentBoardType', $assessmentBoard);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $assessmentBoard->setDate(new \DateTime($assessmentBoard->getDate()));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('assessmentboard_show', array('id' => $assessmentBoard->getId()));
        }

        return $this->render('assessmentboard/edit.html.twig', array(
            'assessmentBoard' => $assessmentBoard,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a assessmentBoard entity.
     *
     */
    public function deleteAction(Request $request, AssessmentBoard $assessmentBoard)
    {
        $form = $this->createDeleteForm($assessmentBoard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($assessmentBoard);
            $em->flush();
        }

        return $this->redirectToRoute('assessmentboard_index');
    }

    /**
     * Creates a form to delete a assessmentBoard entity.
     *
     * @param AssessmentBoard $assessmentBoard The assessmentBoard entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AssessmentBoard $assessmentBoard)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('assessmentboard_delete', array('id' => $assessmentBoard->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    public function addDifficultiesAction(AssessmentBoard $assessmentBoard, Course $course, Student $student)
    {
         return $this->render('assessmentboard/add_difficulties.html.twig', array(
            'assessmentBoard' => $assessmentBoard,
            'course'=>$course,
             'student'=>$student
        ));
    }
}
