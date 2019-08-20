<?php
/**
 * Created by PhpStorm.
 * User: natalia
 * Date: 22/07/17
 * Time: 16:41
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\GuidanceFollowUp
 * @ORM\Table(name="guidance_follow_up")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\GuidanceFollowUpRepository")
 */
class GuidanceFollowUp
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
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="guidance_follow_ups")
     */
    protected $student;

    /**
     * Unidad que está cursando el alumno en elm omento del parte, 1ºESO-A, 2ºESO-C, ....
     * @var smallint $course
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="guidance_follow_ups")
     * Curso actual
     */
    private $course;

    /**
     *
     * @var smallint $guidance_follow_up_status
     * @ORM\ManyToOne(targetEntity="GuidanceFollowUpStatus", inversedBy="guidance_follow_ups")
     */
    private $guidance_follow_up_status;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\GuidanceFollowUpFile", mappedBy="guidance_follow_up")
     */
    protected $files;

    /**
     * @Assert\NotBlank
     * @Assert\Date()
     * @var string $start_date
     * @ORM\Column(name="start_date", type="date")
     */
    private $start_date;

    /**
     * @Assert\Date()
     * @var string $end_date
     * @ORM\Column(name="end_date", type="date", nullable=true)
     */
    private $end_date;

    /**
     * @var string observations
     * @ORM\Column(name="observations", type="text", nullable=true)
     */
    private $observations;

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
     * Constructor
     */
    public function __construct()
    {
        $this->files = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set startDate.
     *
     * @param \DateTime $startDate
     *
     * @return GuidanceFollowUp
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;

        return $this;
    }

    /**
     * Get startDate.
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set endDate.
     *
     * @param \DateTime|null $endDate
     *
     * @return GuidanceFollowUp
     */
    public function setEndDate($endDate = null)
    {
        $this->end_date = $endDate;

        return $this;
    }

    /**
     * Get endDate.
     *
     * @return \DateTime|null
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set observations.
     *
     * @param string|null $observations
     *
     * @return GuidanceFollowUp
     */
    public function setObservations($observations = null)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations.
     *
     * @return string|null
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return GuidanceFollowUp
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
     * @return GuidanceFollowUp
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
     * Set student.
     *
     * @param \AppBundle\Entity\Student|null $student
     *
     * @return GuidanceFollowUp
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
     * @return GuidanceFollowUp
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

    /**
     * Set guidanceFollowUpStatus.
     *
     * @param \AppBundle\Entity\GuidanceFollowUpStatus|null $guidanceFollowUpStatus
     *
     * @return GuidanceFollowUp
     */
    public function setGuidanceFollowUpStatus(\AppBundle\Entity\GuidanceFollowUpStatus $guidanceFollowUpStatus = null)
    {
        $this->guidance_follow_up_status = $guidanceFollowUpStatus;

        return $this;
    }

    /**
     * Get guidanceFollowUpStatus.
     *
     * @return \AppBundle\Entity\GuidanceFollowUpStatus|null
     */
    public function getGuidanceFollowUpStatus()
    {
        return $this->guidance_follow_up_status;
    }

    /**
     * Add file.
     *
     * @param \AppBundle\Entity\GuidanceFollowUpFile $file
     *
     * @return GuidanceFollowUp
     */
    public function addFile(\AppBundle\Entity\GuidanceFollowUpFile $file)
    {
        $this->files[] = $file;

        return $this;
    }

    /**
     * Remove file.
     *
     * @param \AppBundle\Entity\GuidanceFollowUpFile $file
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFile(\AppBundle\Entity\GuidanceFollowUpFile $file)
    {
        return $this->files->removeElement($file);
    }

    /**
     * Get files.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFiles()
    {
        return $this->files;
    }


    public function __toString()
    {
     return $this->getStudent()." - ".$this->getStudent()->getCourse()." (".$this->getStudent()->getCourse()->getYearsOfCourse().")";
    }
}
