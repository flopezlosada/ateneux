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
 * AppBundle\Entity\AssessmentType
 *
 * @ORM\Table(name="assessment_type")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AssessmentTypeRepository")
 */
class AssessmentType
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
     * @ORM\OneToMany(targetEntity="AssessmentBoard", mappedBy="assessment_type")
     */
    protected $assessments;

    /**
     * @var string $title
     * @Assert\NotBlank
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;



    public function __toString()
    {
        return $this->getTitle();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->assessments = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     *
     * @return AssessmentType
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
     * Add assessment
     *
     * @param \AppBundle\Entity\AssessmentBoard $assessment
     *
     * @return AssessmentType
     */
    public function addAssessment(\AppBundle\Entity\AssessmentBoard $assessment)
    {
        $this->assessments[] = $assessment;

        return $this;
    }

    /**
     * Remove assessment
     *
     * @param \AppBundle\Entity\AssessmentBoard $assessment
     */
    public function removeAssessment(\AppBundle\Entity\AssessmentBoard $assessment)
    {
        $this->assessments->removeElement($assessment);
    }

    /**
     * Get assessments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAssessments()
    {
        return $this->assessments;
    }
}
