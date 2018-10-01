<?php
/**
 * Created by PhpStorm.
 * User: natalia
 * Date: 27/08/17
 * Time: 14:26
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\AcademicInformation
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AcademicInformationRepository")
 */
class AcademicInformation
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
     * @var smallint $student
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="academic_informations")
     */

    private $student;


    /**
     *
     * @var smallint $teacher
     * @ORM\ManyToOne(targetEntity="Teacher", inversedBy="academic_informations")
     */

    private $teacher;


    /**
     * @ORM\ManyToOne(targetEntity="Meeting", inversedBy="$academic_informations")
     */
    protected $meeting;


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
     * @Assert\Date()
     * @var string $date
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string information
     * @ORM\Column(name="information", type="text", nullable=true)
     */
    private $information;

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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return AcademicInformation
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
     * @return AcademicInformation
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return AcademicInformation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set information
     *
     * @param string $information
     *
     * @return AcademicInformation
     */
    public function setInformation($information)
    {
        $this->information = $information;

        return $this;
    }

    /**
     * Get information
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }

    /**
     * Set student
     *
     * @param \AppBundle\Entity\Student $student
     *
     * @return AcademicInformation
     */
    public function setStudent(\AppBundle\Entity\Student $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \AppBundle\Entity\Student
     */
    public function getStudent()
    {
        return $this->student;
    }



    /**
     * get last meeting in the meetings list
     *
     * @return Meeting
     */
    public function getLastMeeting()
    {
        $meetings = $this->getMeetings();
        //$pepe=end($meetings);

        //echo $pepe;

        return end($meetings);
    }

    public function __toString()
    {
        return "Evolución Académica. Fecha: ".$this->getDate()->format("d/m/Y");
    }


   

    /**
     * Set meeting.
     *
     * @param \AppBundle\Entity\Meeting|null $meeting
     *
     * @return AcademicInformation
     */
    public function setMeeting(\AppBundle\Entity\Meeting $meeting = null)
    {
        $this->meeting = $meeting;

        return $this;
    }

    /**
     * Get meeting.
     *
     * @return \AppBundle\Entity\Meeting|null
     */
    public function getMeeting()
    {
        return $this->meeting;
    }

    /**
     * Set teacher.
     *
     * @param \AppBundle\Entity\Teacher|null $teacher
     *
     * @return AcademicInformation
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
}
