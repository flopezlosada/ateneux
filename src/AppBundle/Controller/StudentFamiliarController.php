<?php

namespace AppBundle\Controller;

use AppBundle\Entity\StudentFamiliar;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Studentfamiliar controller.
 *
 */
class StudentFamiliarController extends Controller
{
    /**
     * Lists all studentFamiliar entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $studentFamiliars = $em->getRepository('AppBundle:StudentFamiliar')->findAll();

        return $this->render('studentfamiliar/index.html.twig', array(
            'studentFamiliars' => $studentFamiliars,
        ));
    }

    /**
     * Creates a new studentFamiliar entity.
     *
     */
    public function newAction($student_id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository('AppBundle:Student')->find($student_id);
        if ($this->get('security.authorization_checker')->isGranted("ROLE_ADMIN") or $this->get('security.authorization_checker')->isGranted("ROLE_JEFATURA")
            or ($this->get('security.authorization_checker')->isGranted("ROLE_TEACHER")
                and $this->getUser()->getTeacher()->getMentorCourse()->getId() == $student->getCourse()->getId())) {
            $studentFamiliar = new Studentfamiliar();
            $form = $this->createForm('AppBundle\Form\StudentFamiliarType', $studentFamiliar);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($studentFamiliar);
                $studentFamiliar->setStudent($student);
                $student->setFamiliar($studentFamiliar);
                $em->persist($studentFamiliar);
                $em->persist($student);
                $em->flush();

                return $this->redirectToRoute('student_show', array('id' => $studentFamiliar->getStudent()->getId()));
            }
            return $this->render('studentfamiliar/new.html.twig', array(
                'studentFamiliar' => $studentFamiliar,
                'form' => $form->createView(),
            ));
        } else {
            throw new AccessDeniedException();
        }


    }

    /**
     * Finds and displays a studentFamiliar entity.
     *
     */
    public function showAction(StudentFamiliar $studentFamiliar)
    {
        $deleteForm = $this->createDeleteForm($studentFamiliar);

        return $this->render('studentfamiliar/show.html.twig', array(
            'studentFamiliar' => $studentFamiliar,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing studentFamiliar entity.
     *
     */
    public function editAction(Request $request, StudentFamiliar $studentFamiliar)
    {
        $deleteForm = $this->createDeleteForm($studentFamiliar);
        $editForm = $this->createForm('AppBundle\Form\StudentFamiliarType', $studentFamiliar);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('studentfamiliar_edit', array('id' => $studentFamiliar->getId()));
        }

        return $this->render('studentfamiliar/edit.html.twig', array(
            'studentFamiliar' => $studentFamiliar,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a studentFamiliar entity.
     *
     */
    public function deleteAction(Request $request, StudentFamiliar $studentFamiliar)
    {
        $form = $this->createDeleteForm($studentFamiliar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($studentFamiliar);
            $em->flush();
        }

        return $this->redirectToRoute('studentfamiliar_index');
    }

    /**
     * Creates a form to delete a studentFamiliar entity.
     *
     * @param StudentFamiliar $studentFamiliar The studentFamiliar entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(StudentFamiliar $studentFamiliar)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('studentfamiliar_delete', array('id' => $studentFamiliar->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
