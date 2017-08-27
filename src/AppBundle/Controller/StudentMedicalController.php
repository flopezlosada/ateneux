<?php

namespace AppBundle\Controller;

use AppBundle\Entity\StudentMedical;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Studentmedical controller.
 *
 */
class StudentMedicalController extends Controller
{
    /**
     * Lists all studentMedical entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $studentMedicals = $em->getRepository('AppBundle:StudentMedical')->findAll();

        return $this->render('studentmedical/index.html.twig', array(
            'studentMedicals' => $studentMedicals,
        ));
    }

    /**
     * Creates a new studentMedical entity.
     *
     */
    public function newAction($student_id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('AppBundle:Student')->find($student_id);
        if ($this->get('security.authorization_checker')->isGranted("ROLE_ADMIN")
            or ($this->get('security.authorization_checker')->isGranted("ROLE_TEACHER")
                and $this->getUser()->getTeacher()->getMentorCourse()->getId() == $student->getCourse()->getId()))
        {

            $studentMedical = new Studentmedical();
            $form = $this->createForm('AppBundle\Form\StudentMedicalType', $studentMedical);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid())
            {

                $studentMedical->setStudent($student);
                $student->setMedical($studentMedical);
                $em->persist($studentMedical);
                $em->persist($student);
                $em->flush();

                return $this->redirectToRoute('student_show', array('id' => $student->getId()));
            }

            return $this->render('studentmedical/new.html.twig', array(
                'studentMedical' => $studentMedical,
                'form' => $form->createView(),
            ));
        }
        else
        {
            throw new AccessDeniedException();
        }
    }

    /**
     * Finds and displays a studentMedical entity.
     *
     */
    public function showAction(StudentMedical $studentMedical)
    {
        $deleteForm = $this->createDeleteForm($studentMedical);

        return $this->render('studentmedical/show.html.twig', array(
            'studentMedical' => $studentMedical,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing studentMedical entity.
     *
     */
    public function editAction(Request $request, StudentMedical $studentMedical)
    {
        $deleteForm = $this->createDeleteForm($studentMedical);
        $editForm = $this->createForm('AppBundle\Form\StudentMedicalType', $studentMedical);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('studentmedical_edit', array('id' => $studentMedical->getId()));
        }

        return $this->render('studentmedical/edit.html.twig', array(
            'studentMedical' => $studentMedical,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a studentMedical entity.
     *
     */
    public function deleteAction(Request $request, StudentMedical $studentMedical)
    {
        $form = $this->createDeleteForm($studentMedical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($studentMedical);
            $em->flush();
        }

        return $this->redirectToRoute('studentmedical_index');
    }

    /**
     * Creates a form to delete a studentMedical entity.
     *
     * @param StudentMedical $studentMedical The studentMedical entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(StudentMedical $studentMedical)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('studentmedical_delete', array('id' => $studentMedical->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
