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
     * @var string learning_difficulties
     * @ORM\Column(name="learning_difficulties", type="text", nullable=true)
     */
    private $learning_difficulties;

    /**
     * @var string coexistence_difficulties
     * @ORM\Column(name="coexistence_difficulties", type="text", nullable=true)
     */
    private $coexistence_difficulties;

    /**
     * @var string support
     * @ORM\Column(name="support", type="text", nullable=true)
     */
    private $support;

    /**
     * @var string family_date
     * @ORM\Column(name="family_date", type="text", nullable=true)
     */
    private $family_date;

    /**
     * @var string change_optional
     * @ORM\Column(name="change_optional", type="text", nullable=true)
     */
    private $change_optional;

    /**
     * @var string other_interesting
     * @ORM\Column(name="other_interesting", type="text", nullable=true)
     */
    private $other_interesting;

    /**
     * @ORM\OneToMany(targetEntity="AssessmentBoardLearningDifficulties", mappedBy="assessment_board")
     */
    protected $assessments_board_learning_difficulties;


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
     * @return AssessmentBoard
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
     * @return AssessmentBoard
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
     * @return AssessmentBoard
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
     * @return AssessmentBoard
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
     * Set assessmentType
     *
     * @param \AppBundle\Entity\AssessmentType $assessmentType
     *
     * @return AssessmentBoard
     */
    public function setAssessmentType(\AppBundle\Entity\AssessmentType $assessmentType = null)
    {
        $this->assessment_type = $assessmentType;

        return $this;
    }

    /**
     * Get assessmentType
     *
     * @return \AppBundle\Entity\AssessmentType
     */
    public function getAssessmentType()
    {
        return $this->assessment_type;
    }

    /**
     * Set course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return AssessmentBoard
     */
    public function setCourse(\AppBundle\Entity\Course $course = null)
    {
        $this->course = $course;

        return $this;
    }

    /**
     * Get course
     *
     * @return \AppBundle\Entity\Course
     */
    public function getCourse()
    {
        return $this->course;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return "Junta de evaluación de la ".$this->getAssessmentType()->getTitle();
    }

    /**
     * Set learningDifficulties.
     *
     * @param string|null $learningDifficulties
     *
     * @return AssessmentBoard
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
     * Set coexistenceDifficulties.
     *
     * @param string|null $coexistenceDifficulties
     *
     * @return AssessmentBoard
     */
    public function setCoexistenceDifficulties($coexistenceDifficulties = null)
    {
        $this->coexistence_difficulties = $coexistenceDifficulties;

        return $this;
    }

    /**
     * Get coexistenceDifficulties.
     *
     * @return string|null
     */
    public function getCoexistenceDifficulties()
    {
        return $this->coexistence_difficulties;
    }

    /**
     * Set support.
     *
     * @param string|null $support
     *
     * @return AssessmentBoard
     */
    public function setSupport($support = null)
    {
        $this->support = $support;

        return $this;
    }

    /**
     * Get support.
     *
     * @return string|null
     */
    public function getSupport()
    {
        return $this->support;
    }

    /**
     * Set familyDate.
     *
     * @param string|null $familyDate
     *
     * @return AssessmentBoard
     */
    public function setFamilyDate($familyDate = null)
    {
        $this->family_date = $familyDate;

        return $this;
    }

    /**
     * Get familyDate.
     *
     * @return string|null
     */
    public function getFamilyDate()
    {
        return $this->family_date;
    }

    /**
     * Set changeOptional.
     *
     * @param string|null $changeOptional
     *
     * @return AssessmentBoard
     */
    public function setChangeOptional($changeOptional = null)
    {
        $this->change_optional = $changeOptional;

        return $this;
    }

    /**
     * Get changeOptional.
     *
     * @return string|null
     */
    public function getChangeOptional()
    {
        return $this->change_optional;
    }

    /**
     * Set otherInteresting.
     *
     * @param string|null $otherInteresting
     *
     * @return AssessmentBoard
     */
    public function setOtherInteresting($otherInteresting = null)
    {
        $this->other_interesting = $otherInteresting;

        return $this;
    }

    /**
     * Get otherInteresting.
     *
     * @return string|null
     */
    public function getOtherInteresting()
    {
        return $this->other_interesting;
    }
    /**
     * Constructor
     */

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->assessments_board_learning_difficulties = new \Doctrine\Common\Collections\ArrayCollection();
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
}
