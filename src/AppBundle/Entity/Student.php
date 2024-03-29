<?php

/**
 * Created by diphda.net.
 * User: paco
 * Date: 3/07/17
 * Time: 21:01
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;


/**
 * AppBundle\Entity\Student
 *
 * @ORM\Entity(repositoryClass="AppBundle\Entity\StudentRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Student
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
     * @Assert\NotBlank
     * @var string nia
     * @ORM\Column(name="nia", type="string", length=255)
     */
    private $nia;

    /**
     *
     * @var smallint $student_status
     * @ORM\ManyToOne(targetEntity="StudentStatus", inversedBy="students")
     */
    private $student_status;


    /**
     * @Assert\NotBlank
     * @var string name
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank
     * @var string surname
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     *
     * @var string address
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;


    /**
     *
     * @var smallint $state
     * @ORM\ManyToOne(targetEntity="State", inversedBy="students")
     */
    private $state;

    /**
     *
     * @var smallint $city
     * @ORM\ManyToOne(targetEntity="City", inversedBy="students")
     */
    private $city;

    /**
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @var string email
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string $image
     *
     * @ORM\Column(name="image", type="string", length=255,nullable=true)
     */
    private $image;

    /**
     *
     * @Assert\Length(min=5,minMessage="El código postal debe tener al menos {{limit}} caracteres",
     * max=5,maxMessage="El código postal debe tener como máximo {{limit}} caracteres")
     * @var integer postal_code
     * @ORM\Column(name="postal_code", type="integer", length=5,nullable=true)
     */
    private $postal_code;

    /**
     * @Assert\Length(min=9,minMessage="Un número de teléfono debe tener al menos {{limit}} caracteres",
     * max=20,maxMessage="Un número de teléfono debe tener como máximo {{limit}} caracteres")
     * @var string phone
     * @ORM\Column(name="phone", type="string", length=20,nullable=true)
     */
    private $phone;

    /**
     * @Assert\Length(min=9,minMessage="Un número de teléfono móvil debe tener al menos {{limit}} caracteres",
     * max=20,maxMessage="Un número de teléfono móvil debe tener como máximo {{limit}} caracteres")
     * @var string celular
     * @ORM\Column(name="celular", type="string", length=20,nullable=true)
     */
    private $celular;

    /**
     * @var string observations
     * @ORM\Column(name="observations", type="text", nullable=true)
     */
    private $observations;


    /**
     * @Assert\File(maxSize="6000000")
     */
    protected $file;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;

    /**
     * @var int modified
     * @ORM\Column(name="modified", type="boolean", length=1,nullable=true)
     * Lo uso para, cuando se edita la entidad y sólo se modifica el archivo de imagen, indicar que se ha modificado
     * y persistir la entidad, porque el atributo file no se controla mediante doctrine porque no está en la bbdd
     */
    private $modified;


    /**
     * Unidad que está cursando, 1ºESO-A, 2ºESO-C, ....
     * @var smallint $course
     * @ORM\ManyToOne(targetEntity="Course", inversedBy="students")
     * Curso actual
     */
    private $course;

    /**
     * Nivel del curso que está estudiando. 1ºESO, 2ºESO, ....
     * Es para promocionar. Cuando termina un curso, se le promociona al siguiente nivel. Este campo es el que cambia
     * y el del $course se queda a null.
     * @var smallint $course_type
     * @ORM\ManyToOne(targetEntity="CourseType", inversedBy="students")
     *
     */
    private $course_type;

    /**
     *
     * @var smallint $historical_courses
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Course", inversedBy="historical_students")
     * @ORM\JoinTable(name="historical_course_student",
     *      joinColumns={@ORM\JoinColumn(name="student_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="course_id", referencedColumnName="id")}
     *      )
     *
     * histórico de cursos realizados
     */
    private $historical_courses;


    /**
     *
     * @var smallint $medical
     * @ORM\OneToOne(targetEntity="StudentMedical", inversedBy="student")
     */
    private $medical;

    /**
     *
     * @var smallint $familiar
     * @ORM\OneToOne(targetEntity="StudentFamiliar", inversedBy="student")
     */
    private $familiar;

    /**
     *
     * @var smallint $academic_informations
     * @ORM\OneToMany(targetEntity="AcademicInformation", mappedBy="student")
     */
    private $academic_informations;


    /**
     *
     * @var smallint $warnings
     * @ORM\OneToMany(targetEntity="Warning", mappedBy="student")
     * @ORM\OrderBy({"date"= "desc"})
     */
    private $warnings;

    /**
     *
     * @var smallint $first_students
     * @ORM\OneToMany(targetEntity="Mediation", mappedBy="first_student")
     * @ORM\OrderBy({"date"= "desc"})
     */
    private $first_students;

    /**
     *
     * @var smallint $second_students
     * @ORM\OneToMany(targetEntity="Mediation", mappedBy="second_student")
     * @ORM\OrderBy({"date"= "desc"})
     */
    private $second_students;

    /**
     *
     * @var smallint $student_school
     * @ORM\OneToOne(targetEntity="StudentSchool", inversedBy="student")
     */
    private $student_school;

    /**
     * @ORM\OneToMany(targetEntity="Meeting", mappedBy="student_meeting")
     */
    protected $meetings;

    /**
     * @ORM\OneToMany(targetEntity="Mediation", mappedBy="student_mediator")
     * @ORM\OrderBy({"date"= "desc"})
     */
    protected $mediations;

    /**
     * @var int is_mediator
     * @ORM\Column(name="is_mediator", type="boolean", length=1)
     * ¿es mediador?
     */
    private $is_mediator = false;

    /**
     * @ORM\OneToMany(targetEntity="AssessmentBoardLearningDifficulties", mappedBy="student")
     */
    protected $assessments_board_learning_difficulties;


    /**
     *
     * @Assert\Date()
     * @var string $birth_date
     * @ORM\Column(name="birth_date", type="date", nullable=true)
     */
    private $birth_date;

    /**
     * @ORM\OneToMany(targetEntity="GuidanceFollowUp", mappedBy="student")
     */
    protected $guidance_follow_ups;


    /**
     * @var Me sirve para mostrar una propiedad en cada evaluación, la de items sin evaluar en una evaluación determinada. No se guarda, es sólo para la plantilla..
     */
    private $not_evaluated_difficulties_in_assessment_board;





    public function getAbsolutePath()
    {
        return null === $this->image ? null : $this->getUploadRootDir() . '/' . $this->image;
    }

    public function getWebPath()
    {
        return null === $this->image ? null : $this->getUploadDir() . '/' . $this->image;
    }

    protected function getUploadRootDir()
    {
        // la ruta absoluta del directorio donde se deben guardar los archivos cargados
        return __DIR__ . '/../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // se libra del __DIR__ para no desviarse al mostrar `doc/image` en la vista.
        return 'uploads/student/images';
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // haz cualquier cosa para generar un nombre único
            if ($this->image !== null) {
                $this->removeUpload();
            }
            $this->image = uniqid("", true) . '.' . $this->file->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // la propiedad file puede estar vacía si el campo no es obligatorio
        if (null === $this->file) {
            return;
        }

        // si hay un error al mover el archivo, move() automáticamente
        // envía una excepción. Esta impedirá que la entidad se persista
        // en la base de datos en caso de error
        $this->file->move($this->getUploadRootDir(), $this->image);

        unset($this->file);
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->historical_courses = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nia
     *
     * @param string $nia
     *
     * @return Student
     */
    public function setNia($nia)
    {
        $this->nia = $nia;

        return $this;
    }

    /**
     * Get nia
     *
     * @return string
     */
    public function getNia()
    {
        return $this->nia;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Student
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return Student
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Student
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Student
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set postalCode
     *
     * @param integer $postalCode
     *
     * @return Student
     */
    public function setPostalCode($postalCode)
    {
        $this->postal_code = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return integer
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Student
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set celular
     *
     * @param string $celular
     *
     * @return Student
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set observations
     *
     * @param string $observations
     *
     * @return Student
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Student
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
     * @return Student
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
     * Set modified
     *
     * @param boolean $modified
     *
     * @return Student
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return boolean
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * Set state
     *
     * @param \AppBundle\Entity\State $state
     *
     * @return Student
     */
    public function setState(\AppBundle\Entity\State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \AppBundle\Entity\State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set city
     *
     * @param \AppBundle\Entity\City $city
     *
     * @return Student
     */
    public function setCity(\AppBundle\Entity\City $city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return \AppBundle\Entity\City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set course
     *
     * @param \AppBundle\Entity\Course $course
     *
     * @return Student
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

    /**
     * Add historicalCourse
     *
     * @param \AppBundle\Entity\Course $historicalCourse
     *
     * @return Student
     */
    public function addHistoricalCourse(\AppBundle\Entity\Course $historicalCourse)
    {
        $this->historical_courses[] = $historicalCourse;

        return $this;
    }

    /**
     * Remove historicalCourse
     *
     * @param \AppBundle\Entity\Course $historicalCourse
     */
    public function removeHistoricalCourse(\AppBundle\Entity\Course $historicalCourse)
    {
        $this->historical_courses->removeElement($historicalCourse);
    }

    /**
     * Get historicalCourses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHistoricalCourses()
    {
        return $this->historical_courses;
    }

    /**
     * Set medical
     *
     * @param \AppBundle\Entity\StudentMedical $medical
     *
     * @return Student
     */
    public function setMedical(\AppBundle\Entity\StudentMedical $medical = null)
    {
        $this->medical = $medical;

        return $this;
    }

    /**
     * Get medical
     *
     * @return \AppBundle\Entity\StudentMedical
     */
    public function getMedical()
    {
        return $this->medical;
    }

    /**
     * Set familiar
     *
     * @param \AppBundle\Entity\StudentFamiliar $familiar
     *
     * @return Student
     */
    public function setFamiliar(\AppBundle\Entity\StudentFamiliar $familiar = null)
    {
        $this->familiar = $familiar;

        return $this;
    }

    /**
     * Get familiar
     *
     * @return \AppBundle\Entity\StudentFamiliar
     */
    public function getFamiliar()
    {
        return $this->familiar;
    }

    /**
     * Set studentSchool
     *
     * @param \AppBundle\Entity\StudentSchool $studentSchool
     *
     * @return Student
     */
    public function setStudentSchool(\AppBundle\Entity\StudentSchool $studentSchool = null)
    {
        $this->student_school = $studentSchool;

        return $this;
    }

    /**
     * Get studentSchool
     *
     * @return \AppBundle\Entity\StudentSchool
     */
    public function getStudentSchool()
    {
        return $this->student_school;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Student
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    public function __toString()
    {
        return $this->getSurName() . ", " . $this->getName();
    }

    public function getCompleteAddress()
    {
        return $this->getAddress() . " - " . $this->getPostalCode() . " " . $this->getCity() . " (" . $this->getState() . ")";
    }


    /**
     * Add meeting
     *
     * @param \AppBundle\Entity\Meeting $meeting
     *
     * @return Student
     */
    public function addMeeting(\AppBundle\Entity\Meeting $meeting)
    {
        $this->meetings[] = $meeting;

        return $this;
    }

    /**
     * Remove meeting
     *
     * @param \AppBundle\Entity\Meeting $meeting
     */
    public function removeMeeting(\AppBundle\Entity\Meeting $meeting)
    {
        $this->meetings->removeElement($meeting);
    }

    /**
     * Get meetings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMeetings()
    {
        return $this->meetings;
    }

    /**
     * Set academicInformations
     *
     * @param \AppBundle\Entity\AcademicInformation $academicInformations
     *
     * @return Student
     */
    public function setAcademicInformations(\AppBundle\Entity\AcademicInformation $academicInformations = null)
    {
        $this->academic_informations = $academicInformations;

        return $this;
    }

    /**
     * Get academicInformations
     *
     * @return \AppBundle\Entity\AcademicInformation
     */
    public function getAcademicInformations()
    {
        return $this->academic_informations;
    }

    /**
     * Set birthDate.
     *
     * @param \DateTime $birthDate
     *
     * @return Student
     */
    public function setBirthDate($birthDate)
    {
        $this->birth_date = $birthDate;

        return $this;
    }

    /**
     * Get birthDate.
     *
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * Set studentStatus.
     *
     * @param \AppBundle\Entity\StudentStatus|null $studentStatus
     *
     * @return Student
     */
    public function setStudentStatus(\AppBundle\Entity\StudentStatus $studentStatus = null)
    {
        $this->student_status = $studentStatus;

        return $this;
    }

    /**
     * Get studentStatus.
     *
     * @return \AppBundle\Entity\StudentStatus|null
     */
    public function getStudentStatus()
    {
        return $this->student_status;
    }

    /**
     * Set courseType.
     *
     * @param \AppBundle\Entity\CourseType|null $courseType
     *
     * @return Student
     */
    public function setCourseType(\AppBundle\Entity\CourseType $courseType = null)
    {
        $this->course_type = $courseType;

        return $this;
    }

    /**
     * Get courseType.
     *
     * @return \AppBundle\Entity\CourseType|null
     */
    public function getCourseType()
    {
        return $this->course_type;
    }

    /**
     * Set warnings.
     *
     * @param \AppBundle\Entity\Warning|null $warnings
     *
     * @return Student
     */
    public function setWarnings(\AppBundle\Entity\Warning $warnings = null)
    {
        $this->warnings = $warnings;

        return $this;
    }

    /**
     * Get warnings.
     *
     * @return \AppBundle\Entity\Warning|null
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    public function hasDifficulties(AssessmentBoardLearningDifficultiesType $type)
    {
        $difficulties=array();

        foreach ($this->getAssessmentsBoardLearningDifficulties() as $learning_difficulty)
        {

            if ($learning_difficulty->getAssessmentsBoardLearningnDifficultiesType()==$type)
            {
                $difficulties[]=$learning_difficulty;
            }
        }


        if (count($difficulties) > 0) {

            return true;
        }

        return false;
    }

    /**
     * Add assessmentsBoardLearningDifficulty.
     *
     * @param \AppBundle\Entity\AssessmentBoardLearningDifficulties $assessmentsBoardLearningDifficulty
     *
     * @return Student
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

    /**
     * Add mediation.
     *
     * @param \AppBundle\Entity\Mediation $mediation
     *
     * @return Student
     */
    public function addMediation(\AppBundle\Entity\Mediation $mediation)
    {
        $this->mediations[] = $mediation;

        return $this;
    }

    /**
     * Remove mediation.
     *
     * @param \AppBundle\Entity\Mediation $mediation
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeMediation(\AppBundle\Entity\Mediation $mediation)
    {
        return $this->mediations->removeElement($mediation);
    }

    /**
     * Get mediations.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMediations()
    {
        return $this->mediations;
    }

    /**
     * Set isMediator.
     *
     * @param bool $isMediator
     *
     * @return Student
     */
    public function setIsMediator($isMediator)
    {
        $this->is_mediator = $isMediator;

        return $this;
    }

    /**
     * Get isMediator.
     *
     * @return bool
     */
    public function getIsMediator()
    {
        return $this->is_mediator;
    }

    /**
     * Add academicInformation.
     *
     * @param \AppBundle\Entity\AcademicInformation $academicInformation
     *
     * @return Student
     */
    public function addAcademicInformation(\AppBundle\Entity\AcademicInformation $academicInformation)
    {
        $this->academic_informations[] = $academicInformation;

        return $this;
    }

    /**
     * Remove academicInformation.
     *
     * @param \AppBundle\Entity\AcademicInformation $academicInformation
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeAcademicInformation(\AppBundle\Entity\AcademicInformation $academicInformation)
    {
        return $this->academic_informations->removeElement($academicInformation);
    }

    /**
     * Add warning.
     *
     * @param \AppBundle\Entity\Warning $warning
     *
     * @return Student
     */
    public function addWarning(\AppBundle\Entity\Warning $warning)
    {
        $this->warnings[] = $warning;

        return $this;
    }

    /**
     * Remove warning.
     *
     * @param \AppBundle\Entity\Warning $warning
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeWarning(\AppBundle\Entity\Warning $warning)
    {
        return $this->warnings->removeElement($warning);
    }

    /**
     * Add firstStudent.
     *
     * @param \AppBundle\Entity\Mediation $firstStudent
     *
     * @return Student
     */
    public function addFirstStudent(\AppBundle\Entity\Mediation $firstStudent)
    {
        $this->first_students[] = $firstStudent;

        return $this;
    }

    /**
     * Remove firstStudent.
     *
     * @param \AppBundle\Entity\Mediation $firstStudent
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeFirstStudent(\AppBundle\Entity\Mediation $firstStudent)
    {
        return $this->first_students->removeElement($firstStudent);
    }

    /**
     * Get firstStudents.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFirstStudents()
    {
        return $this->first_students;
    }

    /**
     * Add secondStudent.
     *
     * @param \AppBundle\Entity\Mediation $secondStudent
     *
     * @return Student
     */
    public function addSecondStudent(\AppBundle\Entity\Mediation $secondStudent)
    {
        $this->second_students[] = $secondStudent;

        return $this;
    }

    /**
     * Remove secondStudent.
     *
     * @param \AppBundle\Entity\Mediation $secondStudent
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSecondStudent(\AppBundle\Entity\Mediation $secondStudent)
    {
        return $this->second_students->removeElement($secondStudent);
    }

    /**
     * Get secondStudents.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSecondStudents()
    {
        return $this->second_students;
    }


    /**
     * en el caso de que haya necesitado una mediación con otrx estudiante
     */
    public  function hadMediationNeeded()
    {
        if (count($this->getFirstStudents()) or count($this->getSecondStudents()))
        {
            return true;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getNotEvaluatedDifficultiesInAssessmentBoard()
    {
        return $this->not_evaluated_difficulties_in_assessment_board;
    }

    /**
     * @param mixed $not_evaluated_difficulties_in_assessment_board
     */
    public function setNotEvaluatedDifficultiesInAssessmentBoard($not_evaluated_difficulties_in_assessment_board)
    {
        $this->not_evaluated_difficulties_in_assessment_board = $not_evaluated_difficulties_in_assessment_board;
    }


    /**
     * Add guidanceFollowUp.
     *
     * @param \AppBundle\Entity\GuidanceFollowUp $guidanceFollowUp
     *
     * @return Student
     */
    public function addGuidanceFollowUp(\AppBundle\Entity\GuidanceFollowUp $guidanceFollowUp)
    {
        $this->guidance_follow_ups[] = $guidanceFollowUp;

        return $this;
    }

    /**
     * Remove guidanceFollowUp.
     *
     * @param \AppBundle\Entity\GuidanceFollowUp $guidanceFollowUp
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeGuidanceFollowUp(\AppBundle\Entity\GuidanceFollowUp $guidanceFollowUp)
    {
        return $this->guidance_follow_ups->removeElement($guidanceFollowUp);
    }

    /**
     * Get guidanceFollowUps.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuidanceFollowUps()
    {
        return $this->guidance_follow_ups;
    }
}
