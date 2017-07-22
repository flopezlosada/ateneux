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
 * AppBundle\Entity\StudentMedical
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\StudentMedicalRepository")
 */
class StudentMedical
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
     * @ORM\OneToOne(targetEntity="Student", inversedBy="medical")
     */
    private $student;

    /**
     * @var int allergy
     * @ORM\Column(name="allergy", type="boolean", length=1, nullable=true)
     * ¿presenta alergia?
     */
    private $allergy = false;

    /**
     * @var string allergy_observations
     * @ORM\Column(name="allergy_observations", type="text", nullable=true)
     */
    private $allergy_observations;

    /**
     * @var int disease
     * @ORM\Column(name="disease", type="boolean", length=1, nullable=true)
     * ¿presenta enfermedad?
     */
    private $disease = false;

    /**
     * @var string disease_observations
     * @ORM\Column(name="disease_observations", type="text", nullable=true)
     */
    private $disease_observations;



    /**
     * @var int handicap
     * @ORM\Column(name="handicap", type="boolean", length=1, nullable=true)
     * ¿presenta déficit?
     */
    private $handicap = false;

    /**
     * @var string handicap_observations
     * @ORM\Column(name="handicap_observations", type="text", nullable=true)
     */
    private $handicap_observations;


    /**
     * @var int tdah
     * @ORM\Column(name="tdah", type="boolean", length=1, nullable=true)
     * ¿presenta tdah?
     */
    private $tdah = false;


    /**
     * @var int medical_treatment
     * @ORM\Column(name="medical_treatment", type="boolean", length=1, nullable=true)
     * ¿sigue algún tratamiento médico?
     */
    private $medical_treatment = false;

    /**
     * @var int psychological_treatment
     * @ORM\Column(name="psychological_treatment", type="boolean", length=1, nullable=true)
     * ¿sigue algún tratamiento psicológico?
     */
    private $psychological_treatment = false;

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
     * Set allergy
     *
     * @param boolean $allergy
     *
     * @return StudentMedical
     */
    public function setAllergy($allergy)
    {
        $this->allergy = $allergy;

        return $this;
    }

    /**
     * Get allergy
     *
     * @return boolean
     */
    public function getAllergy()
    {
        return $this->allergy;
    }

    /**
     * Set allergyObservations
     *
     * @param string $allergyObservations
     *
     * @return StudentMedical
     */
    public function setAllergyObservations($allergyObservations)
    {
        $this->allergy_observations = $allergyObservations;

        return $this;
    }

    /**
     * Get allergyObservations
     *
     * @return string
     */
    public function getAllergyObservations()
    {
        return $this->allergy_observations;
    }

    /**
     * Set disease
     *
     * @param boolean $disease
     *
     * @return StudentMedical
     */
    public function setDisease($disease)
    {
        $this->disease = $disease;

        return $this;
    }

    /**
     * Get disease
     *
     * @return boolean
     */
    public function getDisease()
    {
        return $this->disease;
    }

    /**
     * Set diseaseObservations
     *
     * @param string $diseaseObservations
     *
     * @return StudentMedical
     */
    public function setDiseaseObservations($diseaseObservations)
    {
        $this->disease_observations = $diseaseObservations;

        return $this;
    }

    /**
     * Get diseaseObservations
     *
     * @return string
     */
    public function getDiseaseObservations()
    {
        return $this->disease_observations;
    }

    /**
     * Set handicap
     *
     * @param boolean $handicap
     *
     * @return StudentMedical
     */
    public function setHandicap($handicap)
    {
        $this->handicap = $handicap;

        return $this;
    }

    /**
     * Get handicap
     *
     * @return boolean
     */
    public function getHandicap()
    {
        return $this->handicap;
    }

    /**
     * Set handicapObservations
     *
     * @param string $handicapObservations
     *
     * @return StudentMedical
     */
    public function setHandicapObservations($handicapObservations)
    {
        $this->handicap_observations = $handicapObservations;

        return $this;
    }

    /**
     * Get handicapObservations
     *
     * @return string
     */
    public function getHandicapObservations()
    {
        return $this->handicap_observations;
    }

    /**
     * Set tdah
     *
     * @param boolean $tdah
     *
     * @return StudentMedical
     */
    public function setTdah($tdah)
    {
        $this->tdah = $tdah;

        return $this;
    }

    /**
     * Get tdah
     *
     * @return boolean
     */
    public function getTdah()
    {
        return $this->tdah;
    }

    /**
     * Set medicalTreatment
     *
     * @param boolean $medicalTreatment
     *
     * @return StudentMedical
     */
    public function setMedicalTreatment($medicalTreatment)
    {
        $this->medical_treatment = $medicalTreatment;

        return $this;
    }

    /**
     * Get medicalTreatment
     *
     * @return boolean
     */
    public function getMedicalTreatment()
    {
        return $this->medical_treatment;
    }

    /**
     * Set psychologicalTreatment
     *
     * @param boolean $psychologicalTreatment
     *
     * @return StudentMedical
     */
    public function setPsychologicalTreatment($psychologicalTreatment)
    {
        $this->psychological_treatment = $psychologicalTreatment;

        return $this;
    }

    /**
     * Get psychologicalTreatment
     *
     * @return boolean
     */
    public function getPsychologicalTreatment()
    {
        return $this->psychological_treatment;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return StudentMedical
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
     * @return StudentMedical
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
