<?php

namespace AppBundle\Controller;

use AppBundle\Entity\CourseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Coursetype controller.
 *
 */
class CourseTypeController extends Controller
{
    /**
     * Lists all courseType entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $courseTypes = $em->getRepository('AppBundle:CourseType')->findAll();

        return $this->render('coursetype/index.html.twig', array(
            'courseTypes' => $courseTypes,
        ));
    }

    /**
     * Creates a new courseType entity.
     *
     */
    public function newAction(Request $request)
    {
        $courseType = new Coursetype();
        $form = $this->createForm('AppBundle\Form\CourseTypeType', $courseType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($courseType);
            $em->flush();

            return $this->redirectToRoute('coursetype_show', array('id' => $courseType->getId()));
        }

        return $this->render('coursetype/new.html.twig', array(
            'courseType' => $courseType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a courseType entity.
     *
     */
    public function showAction(CourseType $courseType)
    {
        $deleteForm = $this->createDeleteForm($courseType);

        return $this->render('coursetype/show.html.twig', array(
            'courseType' => $courseType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing courseType entity.
     *
     */
    public function editAction(Request $request, CourseType $courseType)
    {
        $deleteForm = $this->createDeleteForm($courseType);
        $editForm = $this->createForm('AppBundle\Form\CourseTypeType', $courseType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('coursetype_edit', array('id' => $courseType->getId()));
        }

        return $this->render('coursetype/edit.html.twig', array(
            'courseType' => $courseType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a courseType entity.
     *
     */
    public function deleteAction(Request $request, CourseType $courseType)
    {
        $form = $this->createDeleteForm($courseType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($courseType);
            $em->flush();
        }

        return $this->redirectToRoute('coursetype_index');
    }

    /**
     * Creates a form to delete a courseType entity.
     *
     * @param CourseType $courseType The courseType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CourseType $courseType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('coursetype_delete', array('id' => $courseType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
