<?php
/**
 * Created by PhpStorm.
 * User: natalia
 * Date: 2/09/17
 * Time: 11:19
 * Juntas de evaluación
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * AppBundle\Entity\AssessmentBoard
 * @ORM\Table(name="assessment_board")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AssessmentBoardRepository")
 */
class AssessmentBoard
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
     * @var smallint $assessment_type
     * @ORM\ManyToOne(targetEntity="AssessmentType", inversedBy="assessments_board")
     */
    private $assessment_type;

    /**
     *
     * @var smallint $course
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="assessments_board")
     * Curso
     */
    private $course;

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
     * Valoración general del grupo
     */
    private $information;



    /**
     * @ORM\OneToMany(targetEntity="AssessmentBoardLearningDifficulties", mappedBy="assessment_board")
     */
    protected $assessments_board_learning_difficulties;




    public function __toString()
    {
        // TODO: Implement __toString() method.
        return "Junta de evaluación de la ".$this->getAssessmentType()->getTitle();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->assessments_board_learning_difficulties = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set created.
     *
     * @param \DateTime $created
     *
     * @return AssessmentBoard
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
     * @return AssessmentBoard
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
     * @return AssessmentBoard
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
     * @return AssessmentBoard
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
     * Set assessmentType.
     *
     * @param \AppBundle\Entity\AssessmentType|null $assessmentType
     *
     * @return AssessmentBoard
     */
    public function setAssessmentType(\AppBundle\Entity\AssessmentType $assessmentType = null)
    {
        $this->assessment_type = $assessmentType;

        return $this;
    }

    /**
     * Get assessmentType.
     *
     * @return \AppBundle\Entity\AssessmentType|null
     */
    public function getAssessmentType()
    {
        return $this->assessment_type;
    }

    /**
     * Set course.
     *
     * @param \AppBundle\Entity\Course|null $course
     *
     * @return AssessmentBoard
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
     * Add assessmentsBoardLearningDifficulty.
     *
     * @param \AppBundle\Entity\AssessmentBoardLearningDifficulties $assessmentsBoardLearningDifficulty
     *
     * @return AssessmentBoard
     */
    public function addAssessmentsBoardLearningDifficulty(\AppBundle\Entity\AssessmentBoardLearningDifficulties $assessmentsBoardLearningDifficulty)
    {
        $this->assessments_board_learning_difficulties[] = $assessmentsBoardLearningDifficulty;

        return $this;
    }

    /**
     * Remove assessmentsBoardLearningDifficulty.
     *
     * @param \AppBundle\Entity\AssessmentBoardLearningDifficulties $assessmentsBoardLearningDifficulty
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAssessmentsBoardLearningDifficulty(\AppBundle\Entity\AssessmentBoardLearningDifficulties $assessmentsBoardLearningDifficulty)
    {
        return $this->assessments_board_learning_difficulties->removeElement($assessmentsBoardLearningDifficulty);
    }

    /**
     * Get assessmentsBoardLearningDifficulties.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssessmentsBoardLearningDifficulties()
    {
        return $this->assessments_board_learning_difficulties;
    }


    public function getDifficulties(AssessmentBoardLearningDifficultiesType $type)
    {
        $difficulties=array();

        foreach ($this->getAssessmentsBoardLearningDifficulties() as $learning_difficulty)
        {

            if ($learning_difficulty->getAssessmentsBoardLearningnDifficultiesType()==$type)
            {
                $difficulties[]=$learning_difficulty;
            }
        }

        return $difficulties;

    }
}
