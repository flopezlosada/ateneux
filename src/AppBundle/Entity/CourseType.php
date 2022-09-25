<?php
/**
 * Created by diphda.net.
 * Sirve para distinguir los distintos tipos de cursos, 1º ESO, 2º ESO, 1º Bachillerato, etc
 *
 * User: paco
 * Date: 1/12/15
 * Time: 21:52
 * 
 * Añadida columna "active" para poder decidir qúe se muestra y qué no en añadir curso. (Rober 02/09/22)
 * 
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\CourseType
 *
 * @ORM\Table(name="course_type")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CourseTypeRepository")
 */
class CourseType
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="Course", mappedBy="course_type")
     */
    protected $courses;


    /**
     *
     * @ORM\OneToMany(targetEntity="Warning", mappedBy="course_type")
     */
    private $warnings;

    /**
     *
     * @ORM\OneToMany(targetEntity="Student", mappedBy="course_type")
     * @ORM\OrderBy({"surname" = "ASC"})
     */
    private $students;

    /**
     * @var string $title
     * @Assert\NotBlank
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string $title
     * @ORM\Column(name="short_title", type="string", length=10)
     */
    private $short_title;

    /**
     * @var dateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var dateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var Es una lista de estudiantes que aún no se han actualizado. Es para la activación del nuevo curso, cuando
     * hay que indicar uno por uno a cada estudiante qué hace. Este es el listado de la gente que aún no ha sido
     * actualizado (ya sea promocionar, repetir, etc)
     * Esta variable se llena en el controlador, no es de la tabla de datos
     */
    private $student_pending;

    /**
     * @var boolean $active
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @return Es
     */
    public function getStudentPending()
    {
        return $this->student_pending;
    }

    /**
     * @param Es $student_pending
     */
    public function setStudentPending($student_pending)
    {
        $this->student_pending = $student_pending;
    }



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->courses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return CourseType
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return CourseType
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return CourseType
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Add course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return CourseType
     */
    public function addCourse(\AppBundle\Entity\Course $course)
    {
        $this->courses[] = $course;

        return $this;
    }

    /**
     * Remove course
     *
     * @param \AppBundle\Entity\Course $course
     */
    public function removeCourse(\AppBundle\Entity\Course $course)
    {
        $this->courses->removeElement($course);
    }

    /**
     * Get courses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCourses()
    {
        return $this->courses;
    }

    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Add student.
     *
     * @param \AppBundle\Entity\Student $student
     *
     * @return CourseType
     */
    public function addStudent(\AppBundle\Entity\Student $student)
    {
        $this->students[] = $student;

        return $this;
    }

    /**
     * Remove student.
     *
     * @param \AppBundle\Entity\Student $student
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeStudent(\AppBundle\Entity\Student $student)
    {
        return $this->students->removeElement($student);
    }

    /**
     * Get students.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Add warning.
     *
     * @param \AppBundle\Entity\Warning $warning
     *
     * @return CourseType
     */
    public function addWarning(\AppBundle\Entity\Warning $warning)
    {
        $this->warnings[] = $warning;

        return $this;
    }

    /**
     * Remove warning.
     *
     * @param \AppBundle\Entity\Warning $warning
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeWarning(\AppBundle\Entity\Warning $warning)
    {
        return $this->warnings->removeElement($warning);
    }

    /**
     * Get warnings.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * Set shortTitle.
     *
     * @param string $shortTitle
     *
     * @return CourseType
     */
    public function setShortTitle($shortTitle)
    {
        $this->short_title = $shortTitle;

        return $this;
    }

    /**
     * Get shortTitle.
     *
     * @return string
     */
    public function getShortTitle()
    {
        return $this->short_title;
    }
}
