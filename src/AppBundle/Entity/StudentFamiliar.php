<?php
/**
 * Created by diphda.net.
 * User: paco
 * Date: 3/07/17
 * Time: 22:10
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\StudentFamiliar
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\StudentFamiliarRepository")
 */

class StudentFamiliar
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
     * @ORM\OneToOne(targetEntity="Student", inversedBy="familiar")
     */
    private $student;

    /**
     * @var int accept
     * @ORM\Column(name="accept", type="boolean", length=1, nullable=true)
     * ¿aceptan situación hijo?
     */
    private $accept = false;

    /**
     * @var int acneae
     * @ORM\Column(name="acneae", type="boolean", length=1, nullable=true)
     * ¿conocen las causas ACNEAE?
     */
    private $acneae = false;

    /**
     * @var int protection
     * @ORM\Column(name="protection", type="boolean", length=1, nullable=true)
     * ¿presenta excesiva protección?
     */
    private $protection = false;

    /**
     * @var int increase
     * @ORM\Column(name="increase", type="boolean", length=1, nullable=true)
     * ¿refuerzan logros?
     */
    private $increase = false;

    /**
     * @var int punish
     * @ORM\Column(name="punish", type="boolean", length=1, nullable=true)
     * ¿castigan conductas disruptivas?
     */
    private $punish = false;

    /**
     * @var int converse
     * @ORM\Column(name="converse", type="boolean", length=1, nullable=true)
     * ¿dialogan con su hijo/a?
     */
    private $converse = false;

    /**
     * @var int cooperate
     * @ORM\Column(name="cooperate", type="boolean", length=1, nullable=true)
     * ¿presentan colaboración?
     */
    private $cooperate = false;

    /**
     * @var int meeting
     * @ORM\Column(name="meeting", type="boolean", length=1, nullable=true)
     * ¿demandan reuniones al tutor?
     */
    private $meeting = false;

    /**
     * @var int mentor
     * @ORM\Column(name="mentor", type="boolean", length=1, nullable=true)
     * ¿colaboran sólo si el tutor lo pide?
     */
    private $mentor = false;

    /**
     * @var int study_time
     * @ORM\Column(name="study_time", type="boolean", length=1, nullable=true)
     * ¿organizan tiempo de estudio?
     */
    private $study_time = false;

    /**
     * @var int learning
     * @ORM\Column(name="learning", type="boolean", length=1, nullable=true)
     * ¿refuerzan aprendizaje?
     */
    private $learning = false;

    /**
     * @var int work_control
     * @ORM\Column(name="work_control", type="boolean", length=1, nullable=true)
     * ¿controlan trabajo diario?
     */
    private $work_control = false;

    /**
     * @var int study_control
     * @ORM\Column(name="study_control", type="boolean", length=1, nullable=true)
     * ¿controlan estudio diario?
     */
    private $study_control = false;


    /**
     * @var string familiar_people
     * @ORM\Column(name="familiar_people", type="text", nullable=true)
     * personas que conviven en el seno familiar
     */
    private $familiar_people;

    /**
     * @var string observations
     * @ORM\Column(name="observations", type="text", nullable=true)
     */
    private $observations;

    /**
     * @var enum
     *
     * @ORM\Column(name="death", type="string", columnDefinition="enum('male', 'female', 'both')")
     *
     * ¿Muerte progenitorxs?
     */
    private $death;

    /**
     * @var enum
     *
     * @ORM\Column(name="unemployment", type="string", columnDefinition="enum('male', 'female', 'both')")
     *
     * ¿Progenitorxs en paro?
     */
    private $unemployment;

    /**
     * @var enum
     *
     * @ORM\Column(name="care", type="string", columnDefinition="enum('male', 'female', 'both','grandparents','other')")
     *
     * ¿Custoria padres separadxs?
     */
    private $care;



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
     * Set accept
     *
     * @param boolean $accept
     *
     * @return StudentFamiliar
     */
    public function setAccept($accept)
    {
        $this->accept = $accept;

        return $this;
    }

    /**
     * Get accept
     *
     * @return boolean
     */
    public function getAccept()
    {
        return $this->accept;
    }

    /**
     * Set acneae
     *
     * @param boolean $acneae
     *
     * @return StudentFamiliar
     */
    public function setAcneae($acneae)
    {
        $this->acneae = $acneae;

        return $this;
    }

    /**
     * Get acneae
     *
     * @return boolean
     */
    public function getAcneae()
    {
        return $this->acneae;
    }

    /**
     * Set protection
     *
     * @param boolean $protection
     *
     * @return StudentFamiliar
     */
    public function setProtection($protection)
    {
        $this->protection = $protection;

        return $this;
    }

    /**
     * Get protection
     *
     * @return boolean
     */
    public function getProtection()
    {
        return $this->protection;
    }

    /**
     * Set increase
     *
     * @param boolean $increase
     *
     * @return StudentFamiliar
     */
    public function setIncrease($increase)
    {
        $this->increase = $increase;

        return $this;
    }

    /**
     * Get increase
     *
     * @return boolean
     */
    public function getIncrease()
    {
        return $this->increase;
    }

    /**
     * Set punish
     *
     * @param boolean $punish
     *
     * @return StudentFamiliar
     */
    public function setPunish($punish)
    {
        $this->punish = $punish;

        return $this;
    }

    /**
     * Get punish
     *
     * @return boolean
     */
    public function getPunish()
    {
        return $this->punish;
    }

    /**
     * Set converse
     *
     * @param boolean $converse
     *
     * @return StudentFamiliar
     */
    public function setConverse($converse)
    {
        $this->converse = $converse;

        return $this;
    }

    /**
     * Get converse
     *
     * @return boolean
     */
    public function getConverse()
    {
        return $this->converse;
    }

    /**
     * Set cooperate
     *
     * @param boolean $cooperate
     *
     * @return StudentFamiliar
     */
    public function setCooperate($cooperate)
    {
        $this->cooperate = $cooperate;

        return $this;
    }

    /**
     * Get cooperate
     *
     * @return boolean
     */
    public function getCooperate()
    {
        return $this->cooperate;
    }

    /**
     * Set meeting
     *
     * @param boolean $meeting
     *
     * @return StudentFamiliar
     */
    public function setMeeting($meeting)
    {
        $this->meeting = $meeting;

        return $this;
    }

    /**
     * Get meeting
     *
     * @return boolean
     */
    public function getMeeting()
    {
        return $this->meeting;
    }

    /**
     * Set mentor
     *
     * @param boolean $mentor
     *
     * @return StudentFamiliar
     */
    public function setMentor($mentor)
    {
        $this->mentor = $mentor;

        return $this;
    }

    /**
     * Get mentor
     *
     * @return boolean
     */
    public function getMentor()
    {
        return $this->mentor;
    }

    /**
     * Set studyTime
     *
     * @param boolean $studyTime
     *
     * @return StudentFamiliar
     */
    public function setStudyTime($studyTime)
    {
        $this->study_time = $studyTime;

        return $this;
    }

    /**
     * Get studyTime
     *
     * @return boolean
     */
    public function getStudyTime()
    {
        return $this->study_time;
    }

    /**
     * Set learning
     *
     * @param boolean $learning
     *
     * @return StudentFamiliar
     */
    public function setLearning($learning)
    {
        $this->learning = $learning;

        return $this;
    }

    /**
     * Get learning
     *
     * @return boolean
     */
    public function getLearning()
    {
        return $this->learning;
    }

    /**
     * Set workControl
     *
     * @param boolean $workControl
     *
     * @return StudentFamiliar
     */
    public function setWorkControl($workControl)
    {
        $this->work_control = $workControl;

        return $this;
    }

    /**
     * Get workControl
     *
     * @return boolean
     */
    public function getWorkControl()
    {
        return $this->work_control;
    }

    /**
     * Set studyControl
     *
     * @param boolean $studyControl
     *
     * @return StudentFamiliar
     */
    public function setStudyControl($studyControl)
    {
        $this->study_control = $studyControl;

        return $this;
    }

    /**
     * Get studyControl
     *
     * @return boolean
     */
    public function getStudyControl()
    {
        return $this->study_control;
    }

    /**
     * Set familiarPeople
     *
     * @param string $familiarPeople
     *
     * @return StudentFamiliar
     */
    public function setFamiliarPeople($familiarPeople)
    {
        $this->familiar_people = $familiarPeople;

        return $this;
    }

    /**
     * Get familiarPeople
     *
     * @return string
     */
    public function getFamiliarPeople()
    {
        return $this->familiar_people;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return StudentFamiliar
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
     * Set death
     *
     * @param string $death
     *
     * @return StudentFamiliar
     */
    public function setDeath($death)
    {
        $this->death = $death;

        return $this;
    }

    /**
     * Get death
     *
     * @return string
     */
    public function getDeath()
    {
        return $this->death;
    }

    /**
     * Set unemployment
     *
     * @param string $unemployment
     *
     * @return StudentFamiliar
     */
    public function setUnemployment($unemployment)
    {
        $this->unemployment = $unemployment;

        return $this;
    }

    /**
     * Get unemployment
     *
     * @return string
     */
    public function getUnemployment()
    {
        return $this->unemployment;
    }

    /**
     * Set care
     *
     * @param string $care
     *
     * @return StudentFamiliar
     */
    public function setCare($care)
    {
        $this->care = $care;

        return $this;
    }

    /**
     * Get care
     *
     * @return string
     */
    public function getCare()
    {
        return $this->care;
    }

    /**
     * Set student
     *
     * @param \AppBundle\Entity\Student $student
     *
     * @return StudentFamiliar
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
}
