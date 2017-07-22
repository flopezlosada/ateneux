<?php
/**
 * Created by diphda.net.
 * User: paco
 * Date: 3/07/17
 * Time: 21:25
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\Course
 * @ORM\Table(name="course")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CourseRepository")
 */
class Course
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
     * @var smallint $course_type
     * @ORM\ManyToOne(targetEntity="CourseType", inversedBy="course")
     */
    private $course_type;

    /**
     * @Assert\NotBlank
     * @Assert\Date()
     * @var string $start_date
     * @ORM\Column(name="start_date", type="date")
     */
    private $start_date;

    /**
     * @Assert\NotBlank
     * @Assert\Date()
     * @var string $end_date
     * @ORM\Column(name="end_date", type="date")
     */
    private $end_date;

    /**
     * 
     * @var smallint $course_status
     * @ORM\ManyToOne(targetEntity="CourseStatus", inversedBy="courses")
     */
    private $course_status;

    /**
     *
     * @ORM\OneToMany(targetEntity="Student", mappedBy="course")
     */
    private $students;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Student", mappedBy="historical_courses")
     */
    protected $historical_students;

    /**
     * @ORM\OneToOne(targetEntity="Teacher", mappedBy="mentor_course")
     */
    protected $mentor_teacher;



    public function __toString()
    {
        return $this->getTitle();
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Task
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
     * Constructor
     */
    public function __construct()
    {
        $this->students = new \Doctrine\Common\Collections\ArrayCollection();
        $this->historical_students = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Course
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
     * @return Course
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
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Course
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Course
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set courseType
     *
     * @param \AppBundle\Entity\CourseType $courseType
     *
     * @return Course
     */
    public function setCourseType(\AppBundle\Entity\CourseType $courseType = null)
    {
        $this->course_type = $courseType;

        return $this;
    }

    /**
     * Get courseType
     *
     * @return \AppBundle\Entity\CourseType
     */
    public function getCourseType()
    {
        return $this->course_type;
    }

    /**
     * Set courseStatus
     *
     * @param \AppBundle\Entity\CourseStatus $courseStatus
     *
     * @return Course
     */
    public function setCourseStatus(\AppBundle\Entity\CourseStatus $courseStatus = null)
    {
        $this->course_status = $courseStatus;

        return $this;
    }

    /**
     * Get courseStatus
     *
     * @return \AppBundle\Entity\CourseStatus
     */
    public function getCourseStatus()
    {
        return $this->course_status;
    }

    /**
     * Add student
     *
     * @param \AppBundle\Entity\Student $student
     *
     * @return Course
     */
    public function addStudent(\AppBundle\Entity\Student $student)
    {
        $this->students[] = $student;

        return $this;
    }

    /**
     * Remove student
     *
     * @param \AppBundle\Entity\Student $student
     */
    public function removeStudent(\AppBundle\Entity\Student $student)
    {
        $this->students->removeElement($student);
    }

    /**
     * Get students
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * Add historicalStudent
     *
     * @param \AppBundle\Entity\Student $historicalStudent
     *
     * @return Course
     */
    public function addHistoricalStudent(\AppBundle\Entity\Student $historicalStudent)
    {
        $this->historical_students[] = $historicalStudent;

        return $this;
    }

    /**
     * Remove historicalStudent
     *
     * @param \AppBundle\Entity\Student $historicalStudent
     */
    public function removeHistoricalStudent(\AppBundle\Entity\Student $historicalStudent)
    {
        $this->historical_students->removeElement($historicalStudent);
    }

    /**
     * Get historicalStudents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistoricalStudents()
    {
        return $this->historical_students;
    }

    /**
     * Set mentorTeacher
     *
     * @param \AppBundle\Entity\Teacher $mentorTeacher
     *
     * @return Course
     */
    public function setMentorTeacher(\AppBundle\Entity\Teacher $mentorTeacher = null)
    {
        $this->mentor_teacher = $mentorTeacher;

        return $this;
    }

    /**
     * Get mentorTeacher
     *
     * @return \AppBundle\Entity\Teacher
     */
    public function getMentorTeacher()
    {
        return $this->mentor_teacher;
    }
}
