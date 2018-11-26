<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Teacher;
use Proxies\__CG__\AppBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {


        return $this->redirect($this->generateUrl('dashboard'));
    }

    /**
     * @Route("/gestion/dashboard", name="dashboard")
     * @Template()
     */
    public function dashboardAction()
    {
        if ($this->get('security.authorization_checker')->isGranted("ROLE_TEACHER") && !$this->get('security.authorization_checker')->isGranted("ROLE_JEFATURA")) {
            return $this->redirect($this->generateUrl('teacher_show', array('id' => $this->getUser()->getTeacher()->getId())));
        }

        /*$em=$this->getDoctrine()->getManager();
        $students=$em->getRepository('AppBundle:Student')->findAll();

        foreach ($students as $student)
        {
            if ($student->getCourse()) {


                $student->setCourseType($student->getCourse()->getCourseType());
                $em->persist($student);
            }
        }
        $em->flush();*/

       /* $em = $this->getDoctrine()->getManager();
        $array_teacher = array(array("Roberto","Rodríguez Muñoz"),array("Brenda","Elizabeth Valencia Arroyave"),
            array("Javier","Vila"),array("Elena","González"),array("Isabel","Sánchez San Nicolás"),array("Ana","Casado Fernández"),
            array("María Begoña","Miralles García"),array("Alberto","Almohalla Álvarez"),array("María","Lorenzo Domínguez"),
            array("Sagrario","Durán"),array("Sergio","Riesco Roche"),array("Guillermo","García Llorente"),
            array("Antonio María","Cancho López"),array("Jesús María","Larraya Astibia"),array("Clara Inés","Arévalo Delgado"),
            array("Jaime","Martínez Muñoz"),array("Nuria","Díaz"),array("Eduardo","Ponte Bassave"),array("María","Del Carmen Estévez"),
            array("Maria de los Ángeles","Díez"),array("Pedro Andrés","Juez Pérez"),array("Almudena Isabel","Santos"),
            array("Alfonso","Díez Santiago"),array("Santiago","Vallejo Muñoz"),array("José Jorge","Sánchez Garrido"),
            array("Marta","Torrejón"),array("Mar","Medina"),array("Alfredo","Ponce"),array("Beatriz","Moraga Molina"),
            array("Victoria","Giménez"),array("María Belén","Rodríguez"),array("Óscar","Gil Vicente"),array("Laura","Sanz"),
            array("Cecilia María","Álvarez Carramolino"),array("Jorge","Ruiz Domínguez"),array("Anabel","García Jiménez"),
            array("Elena","Sendín"),array("Juan Luis","Moreno"),array("Javier","Rodríguez Bodas"),array("Ana Isabel","Rodríguez"),
            array("Sara","Villar Rotella"),array("Julio","García Domeño"),array("Rocío","López Gay"),array("Cristina","Castro Pérez"),
            array("Juan","Morena Hernanz"),array("Salomé","De Santos"),array("Carmelo","Domínguez González"),
            array("Carolina","Hidalgo Rico"),array("Elena","Aparicio Fernandez"),array("Laura","Rodriguez Estrada"),
            array("Ana","Lasso"),array("Agueda","Orellana Solares"),array("Maria Manuela","Garcia Fabrega"));

        foreach ($array_teacher as $teacher)
        {
            $new_teacher=new Teacher();
            $new_teacher->setName($teacher[0]);
            $new_teacher->setSurname($teacher[1]);
            $new_teacher->setEmail(str_replace(' ', '', $teacher[0]).str_replace(' ', '', $teacher[1])."@yahoo.es");
            $em->persist($new_teacher);

            $this->createuserfromteacher($new_teacher);

        }*/



    }


    /*public function createuserfromteacher(Teacher $teacher)
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
    }*/

    public function mediationAction()
    {
        return $this->render(':statistics:mediation.html.twig', array(

        ));
    }

    public function warningAction()
    {
    }
}
