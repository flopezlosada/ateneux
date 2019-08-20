<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="course_activation_control")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CityRepository")
 */
class CourseActivationControl
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @Assert\NotBlank
     * @var string course
     * @ORM\Column(name="course", type="string", length=255)
     */
    public $course;

    /** 0=>El curso no ha sido aún iniciado. Es el momento de en julio realizar los cambios de cursos y de estudiantes, si promocionan o no
     * 1 => El curso se ha iniciado, se han realizado los cambios automáticos de creación de cursos y de poner en nulo
     * el curso de los estudiantes. Sólo queda promocionar o repetir cada estudiante individualmente.
     * 2=> Se han realizado todos los cambios en estudiantes, todos tienen ya su nuevo curso.Igual no lo implemento.
     * 3=>Se ha inciado un nuevo curso. Es decir, al iniciar el curso, se pone en 3 el curso anterior
     * @var int status
     * @ORM\Column(name="status", type="smallint", length=2)
     */
    protected $status;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set course.
     *
     * @param string $course
     *
     * @return CourseActivationControl
     */
    public function setCourse($course)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course.
     *
     * @return string
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Set status.
     *
     * @param int $status
     *
     * @return CourseActivationControl
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }


}
