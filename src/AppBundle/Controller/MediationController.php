<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Mediation;
use AppBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Mediation controller.
 *
 */
class MediationController extends Controller
{
    /**
     * Lists all mediation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $mediations = $em->getRepository('AppBundle:Mediation')->findAll();

        return $this->render('mediation/index.html.twig', array(
            'mediations' => $mediations,
        ));
    }

    /**
     * Creates a new mediation entity.
     *
     */
    public function newAction(Request $request, Student $first_student, Student $second_student)
    {
        $mediation = new Mediation();

        $form = $this->createForm('AppBundle\Form\MediationType', $mediation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $mediation->setDate(new \DateTime($mediation->getDate()));
            $mediation->setFirstStudent($first_student);
            $mediation->setSecondStudent($second_student);
            $mediation->setCourseFirstStudent($mediation->getFirstStudent()->getCourse());
            $mediation->setCourseSecondStudent($mediation->getSecondStudent()->getCourse());
            $em->persist($mediation);
            $em->flush();

            return $this->redirectToRoute('mediation_show', array('id' => $mediation->getId()));
        }

        return $this->render('mediation/new.html.twig', array(
            'mediation' => $mediation,
            'first_student'=>$first_student,
            'second_student'=>$second_student,
            'form' => $form->createView(),
        ));
    }

    public function setMediationAction($id, $type)
    {
        $em=$this->getDoctrine()->getManager();
        $mediator=$em->getRepository("AppBundle:".ucfirst($type))->find($id);
        $mediator->setIsMediator(1);
        $em->persist($mediator);
        $em->flush();

        return $this->redirectToRoute($type.'_show', array('id' => $mediator->getId()));
    }

    /**
     * Finds and displays a mediation entity.
     *
     */
    public function showAction(Mediation $mediation)
    {
        $deleteForm = $this->createDeleteForm($mediation);

        return $this->render('mediation/show.html.twig', array(
            'mediation' => $mediation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing mediation entity.
     *
     */
    public function editAction(Request $request, Mediation $mediation, Student $first_student, Student $second_student)
    {
        $deleteForm = $this->createDeleteForm($mediation);

        $mediation->setDate($mediation->getDate()->format('Y-m-d'));
        $editForm = $this->createForm('AppBundle\Form\MediationType', $mediation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $mediation->setDate(new \DateTime($mediation->getDate())) ;
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mediation_show', array('id' => $mediation->getId()));
        }

        return $this->render('mediation/edit.html.twig', array(
            'mediation' => $mediation,
            'edit_form' => $editForm->createView(),
            'first_student'=>$first_student,
            'second_student'=>$second_student,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a mediation entity.
     *
     */
    public function deleteAction(Request $request, Mediation $mediation)
    {
        $form = $this->createDeleteForm($mediation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($mediation);
            $em->flush();
        }

        return $this->redirectToRoute('mediation_index');
    }

    /**
     * Creates a form to delete a mediation entity.
     *
     * @param Mediation $mediation The mediation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Mediation $mediation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mediation_delete', array('id' => $mediation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
