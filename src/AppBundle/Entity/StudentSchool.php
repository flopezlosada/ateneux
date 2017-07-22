<?php
/**
 * Created by diphda.net.
 * User: paco
 * Date: 5/07/17
 * Time: 16:38
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\Studentschool
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\StudentSchoolRepository")
 */
class StudentSchool
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
     * @ORM\OneToOne(targetEntity="Student", inversedBy="student_school")
     */
    private $student;


    /*
     * CONTEXTO ESCOLAR
     */

    /**
     * @var int repeat
     * @ORM\Column(name="repeat", type="boolean", length=1, nullable=true)
     * ¿repite curso?
     */
    private $repeat = false;

    /**
     * @var int adapted
     * @ORM\Column(name="adapted", type="boolean", length=1, nullable=true)
     * ¿presenta adaptación?
     */
    private $adapted = false;

    /**
     * @var int advance_with_fail
     * @ORM\Column(name="advance_with_fail", type="boolean", length=1, nullable=true)
     * ¿promociona con asignaturas suspensas?
     */
    private $advance_with_fail = false;


    /**
     * @var string fail_subject
     * @ORM\Column(name="fail_subject", type="text", nullable=true)
     * Indica qué asignaturas tiene suspensas
     */
    private $fail_subject;



    /*
     * CARACTERÍSTICAS DE APRENDIZAJE
     */

    /**
     * @var int responsible
     * @ORM\Column(name="responsible", type="boolean", length=1, nullable=true)
     * ¿es responsable?
     */
    private $responsible = false;


    /**
     * @var int driven
     * @ORM\Column(name="driven", type="boolean", length=1, nullable=true)
     * ¿está motivado?
     */
    private $driven = false;

    /**
     * @var int attentive
     * @ORM\Column(name="attentive", type="boolean", length=1, nullable=true)
     * ¿atento?
     */
    private $attentive = false;

    /**
     * @var int thoughtful
     * @ORM\Column(name="thoughtful", type="boolean", length=1, nullable=true)
     * ¿reflexivo?
     */
    private $thoughtful = false;

    /**
     * @var int independent
     * @ORM\Column(name="independent", type="boolean", length=1, nullable=true)
     * ¿independiente?
     */
    private $independent = false;

    /**
     * @var int organized
     * @ORM\Column(name="organized", type="boolean", length=1, nullable=true)
     * ¿organizado?
     */
    private $organized = false;

    /**
     * @var int demotivated
     * @ORM\Column(name="demotivated", type="boolean", length=1, nullable=true)
     * ¿desmotivado?
     */
    private $demotivated = false;

    /**
     * @var int carefree
     * @ORM\Column(name="carefree", type="boolean", length=1, nullable=true)
     * ¿despreocupado?
     */
    private $carefree = false;

    /**
     * @var int distracted
     * @ORM\Column(name="distracted", type="boolean", length=1, nullable=true)
     * ¿distraído?
     */
    private $distracted = false;

    /**
     * @var int impulsive
     * @ORM\Column(name="impulsive", type="boolean", length=1, nullable=true)
     * ¿impulsivo?
     */
    private $impulsive = false;

    /**
     * @var int dependent
     * @ORM\Column(name="dependent", type="boolean", length=1, nullable=true)
     * ¿dependiente?
     */
    private $dependent = false;

    /**
     * @var int disorganized
     * @ORM\Column(name="disorganized", type="boolean", length=1, nullable=true)
     * ¿desorganizado?
     */
    private $disorganized = false;

    /*
     * DIFICULTADES DE APRENDIZAJE
     */

    /**
     * @var int read
     * @ORM\Column(name="read", type="boolean", length=1, nullable=true)
     * ¿comprensión lectora?
     */
    private $read = false;

    /**
     * @var int oral
     * @ORM\Column(name="oral", type="boolean", length=1, nullable=true)
     * ¿comprensión oral?
     */
    private $oral = false;

    /**
     * @var int written
     * @ORM\Column(name="written", type="boolean", length=1, nullable=true)
     * ¿expresión escrita?
     */
    private $written = false;

    /**
     * @var int oral_expression
     * @ORM\Column(name="oral_expression", type="boolean", length=1, nullable=true)
     * ¿expresión oral?
     */
    private $oral_expression = false;

    /**
     * @var int calculation
     * @ORM\Column(name="calculation", type="boolean", length=1, nullable=true)
     * ¿cálculo?
     */
    private $calculation = false;

    /**
     * @var int troubleshooting
     * @ORM\Column(name="troubleshooting", type="boolean", length=1, nullable=true)
     * ¿resolución de problemas?
     */
    private $troubleshooting = false;

    /**
     * @var int spelling
     * @ORM\Column(name="spelling", type="boolean", length=1, nullable=true)
     * ¿ortografía?
     */
    private $spelling = false;

    /**
     * @var int vocabulary
     * @ORM\Column(name="vocabulary", type="boolean", length=1, nullable=true)
     * ¿vocabulario?
     */
    private $vocabulary = false;

    /**
     * @var enum
     *
     * @ORM\Column(name="attention", type="string", columnDefinition="enum('good', 'appropriate', 'problem')")
     *
     * ¿Interés por el aprendizaje?
     */
    private $attention;


    /**
     * @var enum
     *
     * @ORM\Column(name="student_relationship", type="string", columnDefinition="enum('good', 'appropriate', 'problem')")
     *
     * ¿relación con alumnxs?
     */
    private $student_relationship;

    /**
     * @var enum
     *
     * @ORM\Column(name="teacher_relationship", type="string", columnDefinition="enum('good', 'appropriate', 'problem')")
     *
     * ¿relacion con profesorxs?
     */
    private $teacher_relationship;


    /**
     * @var enum
     *
     * @ORM\Column(name="work_habits", type="string", columnDefinition="enum('good', 'appropriate', 'problem')")
     *
     * ¿Hábitos de trabajo?
     */
    private $work_habits;


    /**
     * @var enum
     *
     * @ORM\Column(name="study_habits", type="string", columnDefinition="enum('good', 'appropriate', 'problem')")
     *
     * ¿Hábitos de estudio?
     */
    private $study_habits;

    /**
     * @var enum
     *
     * @ORM\Column(name="behavior", type="string", columnDefinition="enum('good', 'appropriate', 'problem')")
     *
     * ¿Comportamiento?
     */
    private $behavior;


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
     * Set repeat
     *
     * @param boolean $repeat
     *
     * @return StudentSchool
     */
    public function setRepeat($repeat)
    {
        $this->repeat = $repeat;

        return $this;
    }

    /**
     * Get repeat
     *
     * @return boolean
     */
    public function getRepeat()
    {
        return $this->repeat;
    }

    /**
     * Set adapted
     *
     * @param boolean $adapted
     *
     * @return StudentSchool
     */
    public function setAdapted($adapted)
    {
        $this->adapted = $adapted;

        return $this;
    }

    /**
     * Get adapted
     *
     * @return boolean
     */
    public function getAdapted()
    {
        return $this->adapted;
    }

    /**
     * Set advanceWithFail
     *
     * @param boolean $advanceWithFail
     *
     * @return StudentSchool
     */
    public function setAdvanceWithFail($advanceWithFail)
    {
        $this->advance_with_fail = $advanceWithFail;

        return $this;
    }

    /**
     * Get advanceWithFail
     *
     * @return boolean
     */
    public function getAdvanceWithFail()
    {
        return $this->advance_with_fail;
    }

    /**
     * Set failSubject
     *
     * @param string $failSubject
     *
     * @return StudentSchool
     */
    public function setFailSubject($failSubject)
    {
        $this->fail_subject = $failSubject;

        return $this;
    }

    /**
     * Get failSubject
     *
     * @return string
     */
    public function getFailSubject()
    {
        return $this->fail_subject;
    }

    /**
     * Set responsible
     *
     * @param boolean $responsible
     *
     * @return StudentSchool
     */
    public function setResponsible($responsible)
    {
        $this->responsible = $responsible;

        return $this;
    }

    /**
     * Get responsible
     *
     * @return boolean
     */
    public function getResponsible()
    {
        return $this->responsible;
    }

    /**
     * Set driven
     *
     * @param boolean $driven
     *
     * @return StudentSchool
     */
    public function setDriven($driven)
    {
        $this->driven = $driven;

        return $this;
    }

    /**
     * Get driven
     *
     * @return boolean
     */
    public function getDriven()
    {
        return $this->driven;
    }

    /**
     * Set attentive
     *
     * @param boolean $attentive
     *
     * @return StudentSchool
     */
    public function setAttentive($attentive)
    {
        $this->attentive = $attentive;

        return $this;
    }

    /**
     * Get attentive
     *
     * @return boolean
     */
    public function getAttentive()
    {
        return $this->attentive;
    }

    /**
     * Set thoughtful
     *
     * @param boolean $thoughtful
     *
     * @return StudentSchool
     */
    public function setThoughtful($thoughtful)
    {
        $this->thoughtful = $thoughtful;

        return $this;
    }

    /**
     * Get thoughtful
     *
     * @return boolean
     */
    public function getThoughtful()
    {
        return $this->thoughtful;
    }

    /**
     * Set independent
     *
     * @param boolean $independent
     *
     * @return StudentSchool
     */
    public function setIndependent($independent)
    {
        $this->independent = $independent;

        return $this;
    }

    /**
     * Get independent
     *
     * @return boolean
     */
    public function getIndependent()
    {
        return $this->independent;
    }

    /**
     * Set organized
     *
     * @param boolean $organized
     *
     * @return StudentSchool
     */
    public function setOrganized($organized)
    {
        $this->organized = $organized;

        return $this;
    }

    /**
     * Get organized
     *
     * @return boolean
     */
    public function getOrganized()
    {
        return $this->organized;
    }

    /**
     * Set demotivated
     *
     * @param boolean $demotivated
     *
     * @return StudentSchool
     */
    public function setDemotivated($demotivated)
    {
        $this->demotivated = $demotivated;

        return $this;
    }

    /**
     * Get demotivated
     *
     * @return boolean
     */
    public function getDemotivated()
    {
        return $this->demotivated;
    }

    /**
     * Set carefree
     *
     * @param boolean $carefree
     *
     * @return StudentSchool
     */
    public function setCarefree($carefree)
    {
        $this->carefree = $carefree;

        return $this;
    }

    /**
     * Get carefree
     *
     * @return boolean
     */
    public function getCarefree()
    {
        return $this->carefree;
    }

    /**
     * Set distracted
     *
     * @param boolean $distracted
     *
     * @return StudentSchool
     */
    public function setDistracted($distracted)
    {
        $this->distracted = $distracted;

        return $this;
    }

    /**
     * Get distracted
     *
     * @return boolean
     */
    public function getDistracted()
    {
        return $this->distracted;
    }

    /**
     * Set impulsive
     *
     * @param boolean $impulsive
     *
     * @return StudentSchool
     */
    public function setImpulsive($impulsive)
    {
        $this->impulsive = $impulsive;

        return $this;
    }

    /**
     * Get impulsive
     *
     * @return boolean
     */
    public function getImpulsive()
    {
        return $this->impulsive;
    }

    /**
     * Set dependent
     *
     * @param boolean $dependent
     *
     * @return StudentSchool
     */
    public function setDependent($dependent)
    {
        $this->dependent = $dependent;

        return $this;
    }

    /**
     * Get dependent
     *
     * @return boolean
     */
    public function getDependent()
    {
        return $this->dependent;
    }

    /**
     * Set disorganized
     *
     * @param boolean $disorganized
     *
     * @return StudentSchool
     */
    public function setDisorganized($disorganized)
    {
        $this->disorganized = $disorganized;

        return $this;
    }

    /**
     * Get disorganized
     *
     * @return boolean
     */
    public function getDisorganized()
    {
        return $this->disorganized;
    }

    /**
     * Set read
     *
     * @param boolean $read
     *
     * @return StudentSchool
     */
    public function setRead($read)
    {
        $this->read = $read;

        return $this;
    }

    /**
     * Get read
     *
     * @return boolean
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * Set oral
     *
     * @param boolean $oral
     *
     * @return StudentSchool
     */
    public function setOral($oral)
    {
        $this->oral = $oral;

        return $this;
    }

    /**
     * Get oral
     *
     * @return boolean
     */
    public function getOral()
    {
        return $this->oral;
    }

    /**
     * Set written
     *
     * @param boolean $written
     *
     * @return StudentSchool
     */
    public function setWritten($written)
    {
        $this->written = $written;

        return $this;
    }

    /**
     * Get written
     *
     * @return boolean
     */
    public function getWritten()
    {
        return $this->written;
    }

    /**
     * Set oralExpression
     *
     * @param boolean $oralExpression
     *
     * @return StudentSchool
     */
    public function setOralExpression($oralExpression)
    {
        $this->oral_expression = $oralExpression;

        return $this;
    }

    /**
     * Get oralExpression
     *
     * @return boolean
     */
    public function getOralExpression()
    {
        return $this->oral_expression;
    }

    /**
     * Set calculation
     *
     * @param boolean $calculation
     *
     * @return StudentSchool
     */
    public function setCalculation($calculation)
    {
        $this->calculation = $calculation;

        return $this;
    }

    /**
     * Get calculation
     *
     * @return boolean
     */
    public function getCalculation()
    {
        return $this->calculation;
    }

    /**
     * Set troubleshooting
     *
     * @param boolean $troubleshooting
     *
     * @return StudentSchool
     */
    public function setTroubleshooting($troubleshooting)
    {
        $this->troubleshooting = $troubleshooting;

        return $this;
    }

    /**
     * Get troubleshooting
     *
     * @return boolean
     */
    public function getTroubleshooting()
    {
        return $this->troubleshooting;
    }

    /**
     * Set spelling
     *
     * @param boolean $spelling
     *
     * @return StudentSchool
     */
    public function setSpelling($spelling)
    {
        $this->spelling = $spelling;

        return $this;
    }

    /**
     * Get spelling
     *
     * @return boolean
     */
    public function getSpelling()
    {
        return $this->spelling;
    }

    /**
     * Set vocabulary
     *
     * @param boolean $vocabulary
     *
     * @return StudentSchool
     */
    public function setVocabulary($vocabulary)
    {
        $this->vocabulary = $vocabulary;

        return $this;
    }

    /**
     * Get vocabulary
     *
     * @return boolean
     */
    public function getVocabulary()
    {
        return $this->vocabulary;
    }

    /**
     * Set attention
     *
     * @param string $attention
     *
     * @return StudentSchool
     */
    public function setAttention($attention)
    {
        $this->attention = $attention;

        return $this;
    }

    /**
     * Get attention
     *
     * @return string
     */
    public function getAttention()
    {
        return $this->attention;
    }

    /**
     * Set studentRelationship
     *
     * @param string $studentRelationship
     *
     * @return StudentSchool
     */
    public function setStudentRelationship($studentRelationship)
    {
        $this->student_relationship = $studentRelationship;

        return $this;
    }

    /**
     * Get studentRelationship
     *
     * @return string
     */
    public function getStudentRelationship()
    {
        return $this->student_relationship;
    }

    /**
     * Set teacherRelationship
     *
     * @param string $teacherRelationship
     *
     * @return StudentSchool
     */
    public function setTeacherRelationship($teacherRelationship)
    {
        $this->teacher_relationship = $teacherRelationship;

        return $this;
    }

    /**
     * Get teacherRelationship
     *
     * @return string
     */
    public function getTeacherRelationship()
    {
        return $this->teacher_relationship;
    }

    /**
     * Set workHabits
     *
     * @param string $workHabits
     *
     * @return StudentSchool
     */
    public function setWorkHabits($workHabits)
    {
        $this->work_habits = $workHabits;

        return $this;
    }

    /**
     * Get workHabits
     *
     * @return string
     */
    public function getWorkHabits()
    {
        return $this->work_habits;
    }

    /**
     * Set studyHabits
     *
     * @param string $studyHabits
     *
     * @return StudentSchool
     */
    public function setStudyHabits($studyHabits)
    {
        $this->study_habits = $studyHabits;

        return $this;
    }

    /**
     * Get studyHabits
     *
     * @return string
     */
    public function getStudyHabits()
    {
        return $this->study_habits;
    }

    /**
     * Set behavior
     *
     * @param string $behavior
     *
     * @return StudentSchool
     */
    public function setBehavior($behavior)
    {
        $this->behavior = $behavior;

        return $this;
    }

    /**
     * Get behavior
     *
     * @return string
     */
    public function getBehavior()
    {
        return $this->behavior;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return StudentSchool
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
     * Set student
     *
     * @param \AppBundle\Entity\Student $student
     *
     * @return StudentSchool
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
