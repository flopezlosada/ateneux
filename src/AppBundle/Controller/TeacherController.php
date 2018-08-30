<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Teacher;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
/**
 * Teacher controller.
 *
 */
class TeacherController extends Controller
{
    /**
     * Lists all teacher entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $teachers = $em->getRepository('AppBundle:Teacher')->findAll();

        return $this->render('teacher/index.html.twig', array(
            'teachers' => $teachers,
        ));
    }

    public function mentorAction($teacher_id)
    {
        $em = $this->getDoctrine()->getManager();

        $teacher = $em->getRepository('AppBundle:Teacher')->find($teacher_id);
        $courses = $em->getRepository('AppBundle:Course')->findCoursesStatus(1);//encuentra cursos activos

        return $this->render('teacher/mentor.html.twig', array(
            'teacher' => $teacher,
            'courses' => $courses
        ));
    }

    public function courseAction($course_id)
    {
        $em = $this->getDoctrine()->getManager();

        $course = $em->getRepository('AppBundle:Course')->find($course_id);
        $teachers = $em->getRepository('AppBundle:Teacher')->findAll();//encuentra cursos activos

        return $this->render('teacher/course.html.twig', array(
            'teachers' => $teachers,
            'course' => $course
        ));
    }

    public function mentor_selectedAction($course_id, $teacher_id)
    {
        $em = $this->getDoctrine()->getManager();

        $teacher = $em->getRepository('AppBundle:Teacher')->find($teacher_id);
        $course = $em->getRepository('AppBundle:Course')->find($course_id);

        $teacher->setMentorCourse($course);
        $em->persist($teacher);
        $em->flush();
        return $this->redirectToRoute('teacher_show', array('id' => $teacher->getId()));

    }

    /**
     * Creates a new teacher entity.
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function newAction(Request $request)
    {
        $teacher = new Teacher();
        $form = $this->createForm('AppBundle\Form\TeacherType', $teacher);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $data = $request->get('appbundle_teacher');

        $email = $data['email'];

        $email_exist = $em->getRepository('AppBundle:Teacher')->findEmailCreated($email);

        if ($email_exist)
        {
            $this->addFlash('error', 'El email ya está en la base de datos, no se puede crear otra/o usuaria/o con ese email, indica otro.');
        } else if ($form->isSubmitted() && $form->isValid())
        {
            $em->persist($teacher);
            $this->createUserFromTeacher($teacher);
            $em->flush();


            return $this->redirectToRoute('teacher_show', array('id' => $teacher->getId()));
        }

        return $this->render('teacher/new.html.twig', array(
            'teacher' => $teacher,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a teacher entity.
     *
     */
    public function showAction(Teacher $teacher)
    {
        $deleteForm = $this->createDeleteForm($teacher);

        return $this->render('teacher/show.html.twig', array(
            'teacher' => $teacher,
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Displays a form to edit an existing teacher entity.
     *
     */
    public function editAction(Request $request, Teacher $teacher)
    {
        $deleteForm = $this->createDeleteForm($teacher);
        $editForm = $this->createForm('AppBundle\Form\TeacherType', $teacher);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('teacher_show', array('id' => $teacher->getId()));
        }

        return $this->render('teacher/edit.html.twig', array(
            'teacher' => $teacher,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a teacher entity.
     *
     */
    public function deleteAction(Request $request, Teacher $teacher)
    {
        $form = $this->createDeleteForm($teacher);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->remove($teacher);
            $em->flush();
        }

        return $this->redirectToRoute('teacher_index');
    }

    /**
     * Creates a form to delete a teacher entity.
     *
     * @param Teacher $teacher The teacher entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Teacher $teacher)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('teacher_delete', array('id' => $teacher->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    private function createUserFromTeacher(Teacher $teacher)
    {
        $em = $this->getDoctrine()->getManager();

        $username = explode('@', $teacher->getEmail());
        $username = $username[0];
        $username = $username . '_' . rand(10, 90);
        $userManager = $this->container->get('fos_user.user_manager');

        $userAdmin = $userManager->createUser();

        //genero un nombre de usuario modificado por si acaso
        $userAdmin->setUsername($username);
        $userAdmin->setEmail($teacher->getEmail());

        $tokenGenerator = $this->container->get('fos_user.util.token_generator');
        $password = substr($tokenGenerator->generateToken(), 0, 8);

        $userAdmin->setPlainPassword($password);
        $userAdmin->addRole("ROLE_USER");
        $userAdmin->addRole("ROLE_TEACHER");
        $userAdmin->setEnabled(true);

        $userManager->updateUser($userAdmin, true);
        $teacher->setUser($userAdmin);
        $teacher->setPassw($password);
        $em->persist($teacher);
        $em->flush();

        $message = \Swift_Message::newInstance()
            ->setSubject('Has sido dada/o de alta como tutora/or  la web ' . $this->container->getParameter('domain'))
            ->setFrom($this->container->getParameter('contact_email'))
            ->setTo($teacher->getEmail())
            ->setBody(
                $this->renderView(
                    'AppBundle:Default:teacher_email.txt.twig',
                    array('email' => $teacher->getEmail(),
                        'username' => $username,
                        'plain_password' => $password)
                )
            );
        $this->get('mailer')->send($message);


        $this->get('session')->getFlashBag()->add('notice', 'La/el usuaria/o responsable se ha creado correctamente.');


    }


}
