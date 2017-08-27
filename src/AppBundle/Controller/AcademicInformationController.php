<?php

namespace AppBundle\Controller;

use AppBundle\Entity\AcademicInformation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Academicinformation controller.
 *
 */
class AcademicInformationController extends Controller
{
    /**
     * Lists all academicInformation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $academicInformations = $em->getRepository('AppBundle:AcademicInformation')->findAll();

        return $this->render('academicinformation/index.html.twig', array(
            'academicInformations' => $academicInformations,
        ));
    }

    /**
     * Creates a new academicInformation entity.
     *
     */
    public function newAction(Request $request)
    {
        $academicInformation = new Academicinformation();
        $form = $this->createForm('AppBundle\Form\AcademicInformationType', $academicInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($academicInformation);
            $em->flush();

            return $this->redirectToRoute('academicinformation_show', array('id' => $academicInformation->getId()));
        }

        return $this->render('academicinformation/new.html.twig', array(
            'academicInformation' => $academicInformation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a academicInformation entity.
     *
     */
    public function showAction(AcademicInformation $academicInformation)
    {
        $deleteForm = $this->createDeleteForm($academicInformation);

        return $this->render('academicinformation/show.html.twig', array(
            'academicInformation' => $academicInformation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing academicInformation entity.
     *
     */
    public function editAction(Request $request, AcademicInformation $academicInformation)
    {
        $deleteForm = $this->createDeleteForm($academicInformation);
        $editForm = $this->createForm('AppBundle\Form\AcademicInformationType', $academicInformation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('academicinformation_edit', array('id' => $academicInformation->getId()));
        }

        return $this->render('academicinformation/edit.html.twig', array(
            'academicInformation' => $academicInformation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a academicInformation entity.
     *
     */
    public function deleteAction(Request $request, AcademicInformation $academicInformation)
    {
        $form = $this->createDeleteForm($academicInformation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($academicInformation);
            $em->flush();
        }

        return $this->redirectToRoute('academicinformation_index');
    }

    /**
     * Creates a form to delete a academicInformation entity.
     *
     * @param AcademicInformation $academicInformation The academicInformation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(AcademicInformation $academicInformation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('academicinformation_delete', array('id' => $academicInformation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
