<?php
/**
 * Created by PhpStorm.
 * User: paco
 * Date: 30/08/18
 * Time: 18:42
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\Warning
 *
 * @ORM\Table(name="warning")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\WarningRepository")
 */


class Warning
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
     * @Assert\NotBlank
     * @var smallint $warning_type
     * @ORM\ManyToOne(targetEntity="WarningType", inversedBy="warnings")
     */
    private $warning_type;

    /**
     * @Assert\NotBlank
     * @Assert\Date()
     * @var string $date
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * Para los partes leves se muestra un textarea para el motivo
     * @var string information
     * @ORM\Column(name="information", type="text", nullable=true)
     */
    private $information;



    /**
     * @var int $signed
     * @ORM\Column(name="signed", type="boolean", length=1, nullable=true)
     * ¿Devuelve el parte firmado?
     */
    private $signed = false;


    /**
     *@Assert\NotBlank
     * @var smallint $teacher
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="warnings")
     */
    private $teacher;


    /**
     * @var smallint $warning_cause_type
     * @ORM\ManyToOne(targetEntity="WarningCauseType", inversedBy="warnings")
     */
    //private $warning_cause_type;

    /**
     * Para los amonestaciones con falta grave directa se muestra un textarea para la descripción del hecho
     * @var string $description
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var smallint $major_offence_type
     * @ORM\ManyToOne(targetEntity="MajorOffenceType", inversedBy="warnings")
     */
    private $major_offence_type;

    /**
     * @var smallint $penalty_type
     * @ORM\ManyToOne(targetEntity="PenaltyType", inversedBy="warnings")
     */
    private $penalty_type;

    /**
     *
     * @Assert\Date()
     * @var string $penalty_start_date
     * @ORM\Column(name="penalty_start_date", type="date", nullable=true)
     */
    private $penalty_start_date;

    /**
     *
     * @Assert\Date()
     * @var string $penalty_end_date
     * @ORM\Column(name="penalty_end_date", type="date", nullable=true)
     */
    private $penalty_end_date;


    /**
     *
     * @var smallint $student
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="warnings")
     */

    private $student;

    /**
     * Unidad que está cursando el alumno en elm omento del parte, 1ºESO-A, 2ºESO-C, ....
     * @var smallint $course
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="warnings")
     * Curso actual
     */
    private $course;


    /**
     * @var int $sai
     * @ORM\Column(name="sai", type="boolean", length=1, nullable=true)
     * ¿Acude a la SAI?
     */
    private $sai = false;

    /**
     * Campo para que rellene el profesor de guardia en la SAI cuando el alumno acude allí.
     * @var string $sai_observations
     * @ORM\Column(name="sai_observations", type="text", nullable=true)
     */
    private $sai_observations;


    /**
     *
     * @var smallint $sai_teacher
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="warnings_sai_teacher")
     */
    private $sai_teacher;


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
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return Warning
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created.
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated.
     *
     * @param \DateTime $updated
     *
     * @return Warning
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated.
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Warning
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set information.
     *
     * @param string|null $information
     *
     * @return Warning
     */
    public function setInformation($information = null)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information.
     *
     * @return string|null
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set signed.
     *
     * @param string|null $signed
     *
     * @return Warning
     */
    public function setSigned($signed = null)
    {
        $this->signed = $signed;

        return $this;
    }

    /**
     * Get signed.
     *
     * @return string|null
     */
    public function getSigned()
    {
        return $this->signed;
    }

    /**
     * Set description.
     *
     * @param string|null $description
     *
     * @return Warning
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set warningType.
     *
     * @param \AppBundle\Entity\WarningType|null $warningType
     *
     * @return Warning
     */
    public function setWarningType(\AppBundle\Entity\WarningType $warningType = null)
    {
        $this->warning_type = $warningType;

        return $this;
    }

    /**
     * Get warningType.
     *
     * @return \AppBundle\Entity\WarningType|null
     */
    public function getWarningType()
    {
        return $this->warning_type;
    }

    /**
     * Set teacher.
     *
     * @param \AppBundle\Entity\Teacher|null $teacher
     *
     * @return Warning
     */
    public function setTeacher(\AppBundle\Entity\Teacher $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher.
     *
     * @return \AppBundle\Entity\Teacher|null
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set warningCauseType.
     *
     * @param \AppBundle\Entity\WarningCauseType|null $warningCauseType
     *
     * @return Warning
     */
  /*  public function setWarningCauseType(\AppBundle\Entity\WarningCauseType $warningCauseType = null)
    {
        $this->warning_cause_type = $warningCauseType;

        return $this;
    }
*/
    /**
     * Get warningCauseType.
     *
     * @return \AppBundle\Entity\WarningCauseType|null
     */
   /* public function getWarningCauseType()
    {
        return $this->warning_cause_type;
    }
*/
    /**
     * Set majorOffenceType.
     *
     * @param \AppBundle\Entity\MajorOffenceType|null $majorOffenceType
     *
     * @return Warning
     */
    public function setMajorOffenceType(\AppBundle\Entity\MajorOffenceType $majorOffenceType = null)
    {
        $this->major_offence_type = $majorOffenceType;

        return $this;
    }

    /**
     * Get majorOffenceType.
     *
     * @return \AppBundle\Entity\MajorOffenceType|null
     */
    public function getMajorOffenceType()
    {
        return $this->major_offence_type;
    }

    /**
     * Set penaltyType.
     *
     * @param \AppBundle\Entity\PenaltyType|null $penaltyType
     *
     * @return Warning
     */
    public function setPenaltyType(\AppBundle\Entity\PenaltyType $penaltyType = null)
    {
        $this->penalty_type = $penaltyType;

        return $this;
    }

    /**
     * Get penaltyType.
     *
     * @return \AppBundle\Entity\PenaltyType|null
     */
    public function getPenaltyType()
    {
        return $this->penalty_type;
    }

    /**
     * Set penaltyStartDate.
     *
     * @param \DateTime|null $penaltyStartDate
     *
     * @return Warning
     */
    public function setPenaltyStartDate($penaltyStartDate = null)
    {
        $this->penalty_start_date = $penaltyStartDate;

        return $this;
    }

    /**
     * Get penaltyStartDate.
     *
     * @return \DateTime|null
     */
    public function getPenaltyStartDate()
    {
        return $this->penalty_start_date;
    }

    /**
     * Set penaltyEndDate.
     *
     * @param \DateTime|null $penaltyEndDate
     *
     * @return Warning
     */
    public function setPenaltyEndDate($penaltyEndDate = null)
    {
        $this->penalty_end_date = $penaltyEndDate;

        return $this;
    }

    /**
     * Get penaltyEndDate.
     *
     * @return \DateTime|null
     */
    public function getPenaltyEndDate()
    {
        return $this->penalty_end_date;
    }

    /**
     * Set student.
     *
     * @param \AppBundle\Entity\Student|null $student
     *
     * @return Warning
     */
    public function setStudent(\AppBundle\Entity\Student $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student.
     *
     * @return \AppBundle\Entity\Student|null
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set course.
     *
     * @param \AppBundle\Entity\Course|null $course
     *
     * @return Warning
     */
    public function setCourse(\AppBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course.
     *
     * @return \AppBundle\Entity\Course|null
     */
    public function getCourse()
    {
        return $this->course;
    }

    public function __toString()
    {
        return $this->getWarningType()->__toString();
    }

    /**
     * Set sai.
     *
     * @param bool|null $sai
     *
     * @return Warning
     */
    public function setSai($sai = null)
    {
        $this->sai = $sai;

        return $this;
    }

    /**
     * Get sai.
     *
     * @return bool|null
     */
    public function getSai()
    {
        return $this->sai;
    }

    /**
     * Set saiObservations.
     *
     * @param string|null $saiObservations
     *
     * @return Warning
     */
    public function setSaiObservations($saiObservations = null)
    {
        $this->sai_observations = $saiObservations;

        return $this;
    }

    /**
     * Get saiObservations.
     *
     * @return string|null
     */
    public function getSaiObservations()
    {
        return $this->sai_observations;
    }

    /**
     * Set saiTeacher.
     *
     * @param \AppBundle\Entity\Teacher|null $saiTeacher
     *
     * @return Warning
     */
    public function setSaiTeacher(\AppBundle\Entity\Teacher $saiTeacher = null)
    {
        $this->sai_teacher = $saiTeacher;

        return $this;
    }

    /**
     * Get saiTeacher.
     *
     * @return \AppBundle\Entity\Teacher|null
     */
    public function getSaiTeacher()
    {
        return $this->sai_teacher;
    }
}
