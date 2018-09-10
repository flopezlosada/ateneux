<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Student;
use AppBundle\Entity\Warning;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Warning controller.
 *
 */
class WarningController extends Controller
{
    /**
     * Lists all warning entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $warnings = $em->getRepository('AppBundle:Warning')->findAll();

        return $this->render('warning/index.html.twig', array(
            'warnings' => $warnings,
        ));
    }

    /**
     * Creates a new warning entity.
     *
     */
    public function newAction(Student $student, Request $request)
    {
        $warning = new Warning();
        $form = $this->createForm('AppBundle\Form\WarningType', $warning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $warning->setDate(new \DateTime($warning->getDate()));
            $warning->setPenaltyStartDate(new \DateTime($warning->getPenaltyStartDate()));
            $warning->setPenaltyEndDate(new \DateTime($warning->getPenaltyEndDate()));
            $warning->setStudent($student);
            $warning->setCourse($student->getCourse());

            $em->persist($warning);
            $em->flush();

            return $this->redirectToRoute('student_show', array('id' => $student->getId()));
        }

        return $this->render('warning/new.html.twig', array(
            'warning' => $warning,
            'student' => $student,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a warning entity.
     *
     */
    public function showAction(Warning $warning)
    {
        $deleteForm = $this->createDeleteForm($warning);

        return $this->render('warning/show.html.twig', array(
            'warning' => $warning,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing warning entity.
     *
     */
    public function editAction(Request $request, Warning $warning, Student $student)
    {
        $deleteForm = $this->createDeleteForm($warning);
        $warning->setDate($warning->getDate()->format('Y-m-d'));
        $warning->setPenaltyStartDate($warning->getPenaltyStartDate()->format('Y-m-d'));
        $warning->setPenaltyEndDate($warning->getPenaltyEndDate()->format('Y-m-d'));
        $editForm = $this->createForm('AppBundle\Form\WarningType', $warning);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $warning->setDate(new \DateTime($warning->getDate())) ;
            $warning->setPenaltyStartDate(new \DateTime($warning->getPenaltyStartDate())) ;
            $warning->setPenaltyEndDate(new \DateTime($warning->getPenaltyEndDate())) ;

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('warning_show', array('id' => $warning->getId()));
        }

        return $this->render('warning/edit.html.twig', array(
            'warning' => $warning,
            'student' => $student,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a warning entity.
     *
     */
    public function deleteAction(Request $request, Warning $warning)
    {
        $form = $this->createDeleteForm($warning);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($warning);
            $em->flush();
        }

        return $this->redirectToRoute('warning_index');
    }

    /**
     * Creates a form to delete a warning entity.
     *
     * @param Warning $warning The warning entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Warning $warning)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('warning_delete', array('id' => $warning->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
