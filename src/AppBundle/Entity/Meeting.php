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
 * AppBundle\Entity\Meeting
 * @ORM\Table(name="meeting")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\MeetingRepository")
 */
class Meeting
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
     * @var string $title
     * @Assert\NotBlank
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

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
     * @var smallint $meeting_type
     * @ORM\ManyToOne(targetEntity="MeetingType", inversedBy="meeting")
     */
    private $meeting_type;

    /**
     * @Assert\NotBlank
     * @Assert\Date()
     * @var string $date
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     *
     * @var smallint $meeting_status
     * @ORM\ManyToOne(targetEntity="MeetingStatus", inversedBy="meetings")
     */
    private $meeting_status;

    /**
     *
     * @var smallint $student_meeting
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="meetings")
     */
     protected $student_meeting;

    /**
     * @var string observations
     * @ORM\Column(name="handle_issues", type="text", nullable=true)
     * asuntos tratados
     */
    private $handle_issues;

    /**
     * @var string deals
     * @ORM\Column(name="deals", type="text", nullable=true)
     * acuerdos
     */
    private $deals;

    /**
     * @var string observations
     * @ORM\Column(name="observations", type="text", nullable=true)
     */
    private $observations;


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
     * @return Meeting
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
     * @return Meeting
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
     * @return Meeting
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
     * Set observations
     *
     * @param string $observations
     *
     * @return Meeting
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;

        return $this;
    }

    /**
     * Get observations
     *
     * @return string
     */
    public function getObservations()
    {
        return $this->observations;
    }

    /**
     * Set meetingType
     *
     * @param \AppBundle\Entity\MeetingType $meetingType
     *
     * @return Meeting
     */
    public function setMeetingType(\AppBundle\Entity\MeetingType $meetingType = null)
    {
        $this->meeting_type = $meetingType;

        return $this;
    }

    /**
     * Get meetingType
     *
     * @return \AppBundle\Entity\MeetingType
     */
    public function getMeetingType()
    {
        return $this->meeting_type;
    }

    /**
     * Set meetingStatus
     *
     * @param \AppBundle\Entity\MeetingStatus $meetingStatus
     *
     * @return Meeting
     */
    public function setMeetingStatus(\AppBundle\Entity\MeetingStatus $meetingStatus = null)
    {
        $this->meeting_status = $meetingStatus;

        return $this;
    }

    /**
     * Get meetingStatus
     *
     * @return \AppBundle\Entity\MeetingStatus
     */
    public function getMeetingStatus()
    {
        return $this->meeting_status;
    }

    /**
     * Set studentMeeting
     *
     * @param \AppBundle\Entity\Student $studentMeeting
     *
     * @return Meeting
     */
    public function setStudentMeeting(\AppBundle\Entity\Student $studentMeeting = null)
    {
        $this->student_meeting = $studentMeeting;

        return $this;
    }

    /**
     * Get studentMeeting
     *
     * @return \AppBundle\Entity\Student
     */
    public function getStudentMeeting()
    {
        return $this->student_meeting;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Meeting
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
     * Set handleIssues
     *
     * @param string $handleIssues
     *
     * @return Meeting
     */
    public function setHandleIssues($handleIssues)
    {
        $this->handle_issues = $handleIssues;

        return $this;
    }

    /**
     * Get handleIssues
     *
     * @return string
     */
    public function getHandleIssues()
    {
        return $this->handle_issues;
    }

    /**
     * Set deals
     *
     * @param string $deals
     *
     * @return Meeting
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
}
