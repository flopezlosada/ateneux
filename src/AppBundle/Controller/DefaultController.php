<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Course;
use AppBundle\Entity\Teacher;
use AppBundle\Service\RealCourse;
use Proxies\__CG__\AppBundle\Entity\Student;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Session\Session;

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
        $meetings=$em->getRepository("AppBundle:Meeting")->findAll();
        foreach ($meetings as $meeting)
         {
             $meeting->setCourse($meeting->getStudentMeeting()->getCourse());
             $em->persist($meeting);
         }
        $em->flush();**/
        /* $em=$this->getDoctrine()->getManager();
         $warnings=$em->getRepository("AppBundle:Warning")->findAll();
         foreach ($warnings as $warning)
         {
             $warning->setCourseType($warning->getCourse()->getCourseType());
             $em->persist($warning);
         }

         $em->flush();
 */

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
        /*$em = $this->getDoctrine()->getManager();
        $mediations = $em->getRepository("AppBundle:Mediation")->findAll();
        foreach ($mediations as $mediation) {
            $mediation->setCourseFirstStudent($mediation->getFirstStudent()->getCourse());
            $mediation->setCourseSecondStudent($mediation->getSecondStudent()->getCourse());
            $em->persist($mediation);
        }
        $em->flush();*/


    }

    /**
     * @Route("/change_password_teacher/{teacher_id}", name="change_password_teacher")
     */
    public function changePasswordTeacher($teacher_id)
    {
        $em = $this->getDoctrine()->getManager();
        $teacher = $em->getRepository("AppBundle:Teacher")->find($teacher_id);
        $tokenGenerator = $this->container->get('fos_user.util.token_generator');
        $userManager = $this->container->get('fos_user.user_manager');
        $password = substr($tokenGenerator->generateToken(), 0, 8);
        $teacher->getUser()->setPlainPassword($password);
        $userManager->updateUser($teacher->getUser(), true);
        $teacher->setPassw($password);
        $em->persist($teacher);
        $em->flush();

        return $this->redirect($this->generateUrl('teacher_show', array('id' => $teacher->getId())));
    }


    public function mediationAction()
    {
        $em = $this->getDoctrine()->getManager();
        $course_year_mediations = array(); //valores por año
        $course_month_mediations = array(); // valores por mes
        $current_year = date("Y");
        $course_types = $em->getRepository("AppBundle:CourseType")->findAll();
        $array_months = array("09", "10", "11", "12", "01", "02", "03", "04", "05", "06");

        foreach ($course_types as $type) {
            $course_year_mediations[] = array($em->getRepository("AppBundle:Mediation")->findByCourseType($type), $type->getTitle());
            foreach ($array_months as $month) {
                $month_mediations[$month] = $em->getRepository("AppBundle:Mediation")->findByCourseTypeMonth($type, $month);


            }
            $course_month_mediations[] = array($month_mediations, $type->getTitle());
        }

        foreach ($array_months as $month) {
            $month_by_mediation[$month] = $em->getRepository("AppBundle:Mediation")->findByMonth($month);//mediaciones por mes, sin tener en cuenta el curso
        }

        $total_by_course = $em->getRepository("AppBundle:Mediation")->findAllMediationsByCourse();

        array(
            'course_year_mediations' => $course_year_mediations,
            'course_month_mediations' => $course_month_mediations,
            'month_by_mediation' => $month_by_mediation,
            'total_by_course' => $total_by_course
        );
    }

    public function warningAction($year = null)
    {
        $em = $this->getDoctrine()->getManager();
        $course_year_warnings = array(); //valores por año
        $course_month_warnings = array(); // valores por mes
        $warning_type = $em->getRepository("AppBundle:WarningType")->findAll();
        $array_months = array("09", "10", "11", "12", "01", "02", "03", "04", "05", "06");
        foreach ($warning_type as $type) {
            $course_year_warnings[] = array($em->getRepository("AppBundle:Warning")->findByTypeYear($type, $year), $type->getTitle()); //valores por año
            foreach ($array_months as $month) {
                $month_warnings[$month] = $em->getRepository("AppBundle:Warning")->findByCourseTypeMonth($type, $month);
            }
            $course_month_warnings[] = array($month_warnings, $type->getTitle());
        }

        // tipos de amonestaciones
        $course_year_major_offence = array(); //valores por año
        $course_month_major_offence = array(); // valores por mes
        $major_offence_type = $em->getRepository("AppBundle:MajorOffenceType")->findAll();
        foreach ($major_offence_type as $type) {
            $course_year_major_offence[] = array($em->getRepository("AppBundle:Warning")->findMajorOffenceByTypeYear($type, $year), $type->getTitle()); //valores por año
            foreach ($array_months as $month) {
                $month_major_offence[$month] = $em->getRepository("AppBundle:Warning")->findMajorOffenceByCourseTypeMonth($type, $month);
            }
            $course_month_major_offence[] = array($month_major_offence, $type->getTitle());
        }


        $course_year_penalty = array(); //valores por año
        $course_month_penalty = array(); // valores por mes
        $penalty_type = $em->getRepository("AppBundle:PenaltyType")->findAll();
        foreach ($penalty_type as $type) {
            $course_year_penalty[] = array($em->getRepository("AppBundle:Warning")->findPenaltyByTypeYear($type, $year), $type->getTitle()); //valores por año
            foreach ($array_months as $month) {
                $month_penalty[$month] = $em->getRepository("AppBundle:Warning")->findPenaltyByCourseTypeMonth($type, $month);
            }
            $course_month_penalty[] = array($month_penalty, $type->getTitle());
        }


        return $this->render(':statistics:warnings.html.twig', array(
            'course_year_warnings' => $course_year_warnings,
            'course_month_warnings' => $course_month_warnings,
            'course_month_major_offence' => $course_month_major_offence,
            'course_year_major_offence' => $course_year_major_offence,
            'course_month_penalty' => $course_month_penalty,
            'course_year_penalty' => $course_year_penalty,
        ));
    }

    public function level_warningAction($selected_course_type_id, $year = null)
    {
        $em = $this->getDoctrine()->getManager();
        $courses_type = $em->getRepository("AppBundle:CourseType")->findAll();
        $penalty_type = $em->getRepository("AppBundle:PenaltyType")->findAll();
        $major_offence_type = $em->getRepository("AppBundle:MajorOffenceType")->findAll();
        $warning_type = $em->getRepository("AppBundle:WarningType")->findAll();
        $level_year_warnings = array(); //valores por año


        if ($selected_course_type_id != "NULL") {
            $selected_course_type = $em->getRepository("AppBundle:CourseType")->find($selected_course_type_id);


            foreach ($warning_type as $type) {
                $level_year_warnings[$selected_course_type->getTitle()][] =
                    $em->getRepository("AppBundle:Warning")->findByTypeLevelYear($selected_course_type, $type, $year); //valores por año
            }


            foreach ($major_offence_type as $type) {
                $level_offence_year_warnings[$selected_course_type->getTitle()][] =
                    $em->getRepository("AppBundle:Warning")->findMajorOffenceByTypeYearLevel($type, $selected_course_type, $year); //valores por año
            }


            foreach ($penalty_type as $type) {
                $level_penalty_year_warnings[$selected_course_type->getTitle()][] =
                    $em->getRepository("AppBundle:Warning")->findPenaltyByTypeYearLevel($type, $selected_course_type, $year); //valores por año
            }


        } else {
            $selected_course_type = null;


            foreach ($courses_type as $course_type) {
                foreach ($warning_type as $type) {
                    $level_year_warnings[$course_type->getTitle()][] =
                        $em->getRepository("AppBundle:Warning")->findByTypeLevelYear($course_type, $type, $year); //valores por año
                }

            }


            foreach ($courses_type as $course_type) {
                foreach ($major_offence_type as $type) {
                    $level_offence_year_warnings[$course_type->getTitle()][] =
                        $em->getRepository("AppBundle:Warning")->findMajorOffenceByTypeYearLevel($type, $course_type, $year); //valores por año
                }
            }


            foreach ($courses_type as $course_type) {
                foreach ($penalty_type as $type) {
                    $level_penalty_year_warnings[$course_type->getTitle()][] =
                        $em->getRepository("AppBundle:Warning")->findPenaltyByTypeYearLevel($type, $course_type, $year); //valores por año
                }
            }

        }


        return $this->render(':statistics:level_warnings.html.twig', array(
            'courses_type' => $courses_type,
            'selected_course_type' => $selected_course_type,
            'level_year_warnings' => $level_year_warnings,
            'major_offence_type' => $major_offence_type,
            'penalty_type' => $penalty_type,
            'level_offence_year_warnings' => $level_offence_year_warnings,
            'level_penalty_year_warnings' => $level_penalty_year_warnings,
            'warning_type' => $warning_type,
            'year' => $year
        ));
    }

    public function level_warning_courseAction($selected_course_type_id, $year = null)
    {
        $em = $this->getDoctrine()->getManager();
        $courses_type = $em->getRepository("AppBundle:CourseType")->findAll();
        $selected_course_type = $em->getRepository("AppBundle:CourseType")->find($selected_course_type_id);
        $course_year_warnings = array(); //valores por año
        $course_month_warnings = array(); // valores por mes
        $warning_type = $em->getRepository("AppBundle:WarningType")->findAll();
        $array_months = array("09", "10", "11", "12", "01", "02", "03", "04", "05", "06");
        foreach ($warning_type as $type) {
            $course_year_warnings[] = array($em->getRepository("AppBundle:Warning")->findByTypeYear($type, $year, null, $selected_course_type), $type->getTitle()); //valores por año
            foreach ($array_months as $month) {
                $month_warnings[$month] = $em->getRepository("AppBundle:Warning")->findByCourseTypeMonth($type, $month, null, null, $selected_course_type);
            }
            $course_month_warnings[] = array($month_warnings, $type->getTitle());
        }

        // tipos de amonestaciones
        $course_year_major_offence = array(); //valores por año
        $course_month_major_offence = array(); // valores por mes
        $major_offence_type = $em->getRepository("AppBundle:MajorOffenceType")->findAll();
        foreach ($major_offence_type as $type) {
            $course_year_major_offence[] = array($em->getRepository("AppBundle:Warning")->findMajorOffenceByTypeYear($type, $year, null, $selected_course_type), $type->getTitle()); //valores por año
            foreach ($array_months as $month) {
                $month_major_offence[$month] = $em->getRepository("AppBundle:Warning")->findMajorOffenceByCourseTypeMonth($type, $month, null, null, $selected_course_type);
            }
            $course_month_major_offence[] = array($month_major_offence, $type->getTitle());
        }


        $course_year_penalty = array(); //valores por año
        $course_month_penalty = array(); // valores por mes
        $penalty_type = $em->getRepository("AppBundle:PenaltyType")->findAll();
        foreach ($penalty_type as $type) {
            $course_year_penalty[] = array($em->getRepository("AppBundle:Warning")->findPenaltyByTypeYear($type, $year, null, $selected_course_type), $type->getTitle()); //valores por año
            foreach ($array_months as $month) {
                $month_penalty[$month] = $em->getRepository("AppBundle:Warning")->findPenaltyByCourseTypeMonth($type, $month, null, null, $selected_course_type);
            }
            $course_month_penalty[] = array($month_penalty, $type->getTitle());
        }


        return $this->render(':statistics:warnings.html.twig', array(
            'courses_type' => $courses_type,
            'course_year_warnings' => $course_year_warnings,
            'course_month_warnings' => $course_month_warnings,
            'course_month_major_offence' => $course_month_major_offence,
            'course_year_major_offence' => $course_year_major_offence,
            'course_month_penalty' => $course_month_penalty,
            'course_year_penalty' => $course_year_penalty,
            'selected_course_type' => $selected_course_type,
            'year' => $year
        ));
    }

    /**
     *
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function course_change_indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $course_activation_status = $em->getRepository("AppBundle:CourseActivationControl")
            ->findoneBy(array("course" => RealCourse::getRealCourse()));
        if ($course_activation_status->getStatus() == 1) {
            return $this->redirect($this->generateUrl('admin_course_student_list'));
        } else if ($course_activation_status->getStatus() == 2) {
            return $this->redirect($this->generateUrl('dashboard'));
        }

        return $this->render(':admin:change_course_index.html.twig', array(
            "active_courses" => null
        ));
    }


    /**
     *
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function course_changeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $course_activation_status = $em->getRepository("AppBundle:CourseActivationControl")
            ->findoneBy(array("course" => RealCourse::getRealCourse()));


        $active_courses = $em->getRepository("AppBundle:Course")->findBy(array("course_status" => 1));
        $course_status_ended = $em->getRepository("AppBundle:CourseStatus")->find(2);
        $course_status_active = $em->getRepository("AppBundle:CourseStatus")->find(1);
        foreach ($active_courses as $course) {
            $new_course = new Course();
            $new_course->setCourseStatus($course_status_active);
            $new_course->setCourseType($course->getCourseType());
            $new_course->setTitle($course->getTitle());
            $new_course->setStartDate(new \DateTime(RealCourse::getStartDateCourse()));
            $new_course->setEndDate(new \DateTime(RealCourse::getEndDateCourse()));
            $em->persist($new_course);
            $course->setCourseStatus($course_status_ended);
            $em->persist($course);
        }

        $students = $em->getRepository("AppBundle:Student")->findBy(array("student_status" => array(1, null)));
        foreach ($students as $student) {
            if ($student->getCourse() !== null) {
                $student->addHistoricalCourse($student->getCourse());
            }
            $student->setCourse(null);
            //     $em->persist($student);
        }


        $mentors = $em->getRepository("AppBundle:Teacher")
            ->createQueryBuilder('c')->where(("c.mentor_course is not null"))->getQuery()->getResult();
        foreach ($mentors as $mentor) {
            $mentor->addHistoricalCourse($mentor->getMentorCourse());
            $mentor->setMentorCourse(null);
            $em->persist($mentor);
        }

        //control del proceso de activación
        $course_activation_status = $em->getRepository("AppBundle:CourseActivationControl")
            ->findoneBy(array("course" => RealCourse::getRealCourse()));
        $course_activation_status->setStatus(1);
        $em->persist($course_activation_status);

        $em->flush();

        return $this->redirect($this->generateUrl('admin_course_student_list'));

    }


    /**
     *
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function change_student_demoteAction($student_id)
    {
        $em = $this->getDoctrine()->getManager();


        $student = $em->getRepository('AppBundle:Student')->find($student_id);
        if ($student->getCourseType()) {
            $courses = $em->getRepository('AppBundle:Course')->findCoursesStatusUnity(1, $student->getCourseType()->getId());//encuentra cursos activos del tipo que le corresponde
        } else {
            $courses = $em->getRepository('AppBundle:Course')->findAll();
        }
        return $this->render('student/courses.html.twig', array(
            'student' => $student,
            'courses' => $courses
        ));
    }


    /**
     *
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function change_student_listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $course_types = $em->getRepository('AppBundle:CourseType')->findAll();
        foreach ($course_types as $type) {
            $type->setStudentPending($em->getRepository("AppBundle:Student")->getLevelPending($type->getId()));
        }
        $request = Request::createFromGlobals();

        $type_active = $request->query->get('type_active');

        return $this->render(':admin:change_course_student_level.html.twig', array(
            "course_types" => $course_types,
            'type_active' => $type_active
        ));
    }


    /**
     *
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function change_student_promoteAction($student_id)
    {
        $em = $this->getDoctrine()->getManager();
        $array_courses_promote = array(1 => array(2, 9), 2 => array(3, 7, 10), 3 => array(4, 7, 10), 4 => array(5, 7), 5 => 6, 7 => 8, 8 => 5, 9 => 10);
        $student = $em->getRepository('AppBundle:Student')->find($student_id);
        if ($student->getCourseType()) {
            $courses = $em->getRepository('AppBundle:Course')->findCoursesStatusUnity(1,
                $array_courses_promote[$student->getCourseType()->getId()]);//encuentra cursos activos del tipo que le corresponde
        } else {
            $courses = $em->getRepository('AppBundle:Course')->findAll();
        }
        return $this->render('student/courses.html.twig', array(
            'student' => $student,
            'courses' => $courses
        ));
    }


    /**
     *
     * @Security("has_role('ROLE_ADMIN') or has_role('ROLE_JEFATURA')")
     */
    public function change_student_statusAction($status_id, $student_id)
    {

        $em = $this->getDoctrine()->getManager();
        $student = $em->getRepository("AppBundle:Student")->find($student_id);
        $status = $em->getRepository("AppBundle:StudentStatus")->find($status_id);
        $student->setStudentStatus($status);
        $em->persist($student);
        $em->flush();

        $session = $this->get('session');

        $session->getFlashBag()->add(
            'success',
            'La/el estudiante ha sido actualizado con éxito'
        );

        return $this->redirect($this->generateUrl('admin_course_student_list', array('type_active' => $student->getCourseType()->getId())));
    }
}
