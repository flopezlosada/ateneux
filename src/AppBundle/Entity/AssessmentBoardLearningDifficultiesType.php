<?php
/**
 * Created by diphda.net.
 * Sirve para distinguir los distintos tipos de cursos, 1º ESO, 2º ESO, 1º Bachillerato, etc
 *
 * User: paco
 * Date: 1/12/15
 * Time: 21:52
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\AssessmentBoardLearningDifficultiesType
 *
 * @ORM\Table(name="assessment_board_learningn_difficulties_type")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AssessmentBoardLearningDifficultiesTypeRepository")
 */
class AssessmentBoardLearningDifficultiesType
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
     * @ORM\OneToMany(targetEntity="AssessmentBoardLearningDifficulties", mappedBy="assessments_board_learningn_difficulties_type")
     */
    protected $assessments_board_learningn_difficulties;

    /**
     * @var string $title
     * @Assert\NotBlank
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string $common_name
     *
     * @ORM\Column(name="common_name", type="string", length=255, nullable=true)
     */
    private $common_name;

    /**
     *
     * @var smallint $assessments_type
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\AssessmentType", inversedBy="assessments_board_learningn_difficulties_type")
     * @ORM\JoinTable(name="assessment_difficulties_type",
     *      joinColumns={@ORM\JoinColumn(name="difficulty_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="assessment_type_id", referencedColumnName="id")}
     *      )
     *
     * Control de contenidos de junta de evaluación según evaluación.
     */
    private $assessments_type;


    public function __toString()
    {
        return $this->getTitle();
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->assessments_board_learningn_difficulties = new \Doctrine\Common\Collections\ArrayCollection();
        $this->assessments_type = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title.
     *
     * @param string $title
     *
     * @return AssessmentBoardLearningDifficultiesType
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Add assessmentsBoardLearningnDifficulty.
     *
     * @param \AppBundle\Entity\AssessmentBoardLearningDifficulties $assessmentsBoardLearningnDifficulty
     *
     * @return AssessmentBoardLearningDifficultiesType
     */
    public function addAssessmentsBoardLearningnDifficulty(\AppBundle\Entity\AssessmentBoardLearningDifficulties $assessmentsBoardLearningnDifficulty)
    {
        $this->assessments_board_learningn_difficulties[] = $assessmentsBoardLearningnDifficulty;

        return $this;
    }

    /**
     * Remove assessmentsBoardLearningnDifficulty.
     *
     * @param \AppBundle\Entity\AssessmentBoardLearningDifficulties $assessmentsBoardLearningnDifficulty
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAssessmentsBoardLearningnDifficulty(\AppBundle\Entity\AssessmentBoardLearningDifficulties $assessmentsBoardLearningnDifficulty)
    {
        return $this->assessments_board_learningn_difficulties->removeElement($assessmentsBoardLearningnDifficulty);
    }

    /**
     * Get assessmentsBoardLearningnDifficulties.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssessmentsBoardLearningnDifficulties()
    {
        return $this->assessments_board_learningn_difficulties;
    }

    /**
     * Set assessmentType.
     *
     * @param \AppBundle\Entity\AssessmentType|null $assessmentType
     *
     * @return AssessmentBoardLearningDifficultiesType
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
     * Add assessmentsType.
     *
     * @param \AppBundle\Entity\AssessmentType $assessmentsType
     *
     * @return AssessmentBoardLearningDifficultiesType
     */
    public function addAssessmentsType(\AppBundle\Entity\AssessmentType $assessmentsType)
    {
        $this->assessments_type[] = $assessmentsType;

        return $this;
    }

    /**
     * Remove assessmentsType.
     *
     * @param \AppBundle\Entity\AssessmentType $assessmentsType
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAssessmentsType(\AppBundle\Entity\AssessmentType $assessmentsType)
    {
        return $this->assessments_type->removeElement($assessmentsType);
    }

    /**
     * Get assessmentsType.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssessmentsType()
    {
        return $this->assessments_type;
    }

    /**
     * Set commonName.
     *
     * @param string $commonName
     *
     * @return AssessmentBoardLearningDifficultiesType
     */
    public function setCommonName($commonName)
    {
        $this->common_name = $commonName;

        return $this;
    }

    /**
     * Get commonName.
     *
     * @return string
     */
    public function getCommonName()
    {
        return $this->common_name;
    }
}
