<?php
/**
 * Created by PhpStorm.
 * User: natalia
 * Date: 23/09/18
 * Time: 11:20
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\Mediation
 * @ORM\Table(name="mediation")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MediationRepository")
 */
class Mediation
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
     *
     * @var smallint $first_student
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="first_students")
     */
    protected $first_student;

    /**
     * @var int accept_first_student
     * @ORM\Column(name="accept_first_student", type="boolean", length=1)
     * ¿acepta mediación?
     */
    private $accept_first_student = false;

    /**
     *
     * @var smallint $second_student
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="second_students")
     */
    protected $second_student;

    /**
     * @var int accept_second_student
     * @ORM\Column(name="accept_second_student", type="boolean", length=1)
     * ¿acepta mediación?
     */
    private $accept_second_student = false;


    /**
     * @var string first_student_observations
     * @ORM\Column(name="first_student_observations", type="text", nullable=true)
     */
    private $first_student_observations;

    /**
     * @var string second_student_observations
     * @ORM\Column(name="second_student_observations", type="text", nullable=true)
     */
    private $second_student_observations;

    /**
     * @var string deals
     * @ORM\Column(name="deals", type="text", nullable=true)
     * acuerdos
     */
    private $deals;

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
     * Set acceptFirstStudent
     *
     * @param boolean $acceptFirstStudent
     *
     * @return Mediation
     */
    public function setAcceptFirstStudent($acceptFirstStudent)
    {
        $this->accept_first_student = $acceptFirstStudent;

        return $this;
    }

    /**
     * Get acceptFirstStudent
     *
     * @return boolean
     */
    public function getAcceptFirstStudent()
    {
        return $this->accept_first_student;
    }

    /**
     * Set acceptSecondStudent
     *
     * @param boolean $acceptSecondStudent
     *
     * @return Mediation
     */
    public function setAcceptSecondStudent($acceptSecondStudent)
    {
        $this->accept_second_student = $acceptSecondStudent;

        return $this;
    }

    /**
     * Get acceptSecondStudent
     *
     * @return boolean
     */
    public function getAcceptSecondStudent()
    {
        return $this->accept_second_student;
    }

    /**
     * Set firstStudentObservations
     *
     * @param string $firstStudentObservations
     *
     * @return Mediation
     */
    public function setFirstStudentObservations($firstStudentObservations)
    {
        $this->first_student_observations = $firstStudentObservations;

        return $this;
    }

    /**
     * Get firstStudentObservations
     *
     * @return string
     */
    public function getFirstStudentObservations()
    {
        return $this->first_student_observations;
    }

    /**
     * Set secondStudentObservations
     *
     * @param string $secondStudentObservations
     *
     * @return Mediation
     */
    public function setSecondStudentObservations($secondStudentObservations)
    {
        $this->second_student_observations = $secondStudentObservations;

        return $this;
    }

    /**
     * Get secondStudentObservations
     *
     * @return string
     */
    public function getSecondStudentObservations()
    {
        return $this->second_student_observations;
    }

    /**
     * Set deals
     *
     * @param string $deals
     *
     * @return Mediation
     */
    public function setDeals($deals)
    {
        $this->deals = $deals;

        return $this;
    }

    /**
     * Get deals
     *
     * @return string
     */
    public function getDeals()
    {
        return $this->deals;
    }

    /**
     * Set firstStudent
     *
     * @param \AppBundle\Entity\Student $firstStudent
     *
     * @return Mediation
     */
    public function setFirstStudent(\AppBundle\Entity\Student $firstStudent = null)
    {
        $this->first_student = $firstStudent;

        return $this;
    }

    /**
     * Get firstStudent
     *
     * @return \AppBundle\Entity\Student
     */
    public function getFirstStudent()
    {
        return $this->first_student;
    }

    /**
     * Set secondStudent
     *
     * @param \AppBundle\Entity\Student $secondStudent
     *
     * @return Mediation
     */
    public function setSecondStudent(\AppBundle\Entity\Student $secondStudent = null)
    {
        $this->second_student = $secondStudent;

        return $this;
    }

    /**
     * Get secondStudent
     *
     * @return \AppBundle\Entity\Student
     */
    public function getSecondStudent()
    {
        return $this->second_student;
    }
}
