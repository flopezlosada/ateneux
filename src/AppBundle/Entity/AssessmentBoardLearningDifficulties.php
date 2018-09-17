<?php
/**
 * Created by PhpStorm.
 * User: paco
 * Date: 12/09/18
 * Time: 17:37
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * AppBundle\Entity\AssessmentBoardLearningDifficulties
 * @ORM\Table(name="assessment_board_learning_difficulties")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AssessmentBoardLearningDifficultiesRepository")
 */
class AssessmentBoardLearningDifficulties
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
     *
     * @var smallint $student
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="assessments_board_learning_difficulties")
     */
    protected $student;

    /**
     * @var string learning_difficulties
     * @ORM\Column(name="learning_difficulties", type="text", nullable=true)
     */
    private $learning_difficulties = false;

    /**
     *
     * @var smallint $assessment_board
     * @ORM\ManyToOne(targetEntity="AssessmentBoard", inversedBy="assessments_board_learning_difficulties")
     */
    protected $assessment_board;

    /**
     *
     * @var smallint $assessment_board
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="assessments_board_learning_difficulties")
     */
    protected $course;


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
     * @return AssessmentBoardLearningDifficulties
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
     * @return AssessmentBoardLearningDifficulties
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
     * Set learningDifficulties.
     *
     * @param string|null $learningDifficulties
     *
     * @return AssessmentBoardLearningDifficulties
     */
    public function setLearningDifficulties($learningDifficulties = null)
    {
        $this->learning_difficulties = $learningDifficulties;

        return $this;
    }

    /**
     * Get learningDifficulties.
     *
     * @return string|null
     */
    public function getLearningDifficulties()
    {
        return $this->learning_difficulties;
    }

    /**
     * Set student.
     *
     * @param \AppBundle\Entity\Student|null $student
     *
     * @return AssessmentBoardLearningDifficulties
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
     * Set assessmentBoard.
     *
     * @param \AppBundle\Entity\AssessmentBoard|null $assessmentBoard
     *
     * @return AssessmentBoardLearningDifficulties
     */
    public function setAssessmentBoard(\AppBundle\Entity\AssessmentBoard $assessmentBoard = null)
    {
        $this->assessment_board = $assessmentBoard;

        return $this;
    }

    /**
     * Get assessmentBoard.
     *
     * @return \AppBundle\Entity\AssessmentBoard|null
     */
    public function getAssessmentBoard()
    {
        return $this->assessment_board;
    }

    /**
     * Set course.
     *
     * @param \AppBundle\Entity\Course|null $course
     *
     * @return AssessmentBoardLearningDifficulties
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
}
