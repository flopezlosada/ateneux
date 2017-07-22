<?php
/**
 * Created by diphda.net.
 * User: paco
 * Date: 3/07/17
 * Time: 21:37
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * AppBundle\Entity\Teacher
 *
 * @ORM\Table(name="teacher",uniqueConstraints={@ORM\UniqueConstraint(name="email_idx", columns={"email"})})
 * @ORM\Entity(repositoryClass="AppBundle\Entity\TeacherRepository")
 */
class Teacher
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
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     * @var string email
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @Assert\Length(min=9,minMessage="Un número de teléfono debe tener al menos {{limit}} caracteres",
     * max=20,maxMessage="Un número de teléfono debe tener como máximo {{limit}} caracteres")
     * @var string phone
     * @ORM\Column(name="phone", type="string", length=20,nullable=true)
     */
    private $phone;

    /**
     *
     * @var smallint $user
     * @ORM\OneToOne(targetEntity="User", inversedBy="teacher")
     */
    private $user;

    /**
     *
     * @var smallint $mentor_course
     * @ORM\OneToOne(targetEntity="Course", inversedBy="mentor_teacher")
     */
    private $mentor_course;


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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Teacher
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
     * @return Teacher
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
     * Set phone
     *
     * @param string $phone
     *
     * @return Teacher
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
     * Set email
     *
     * @param string $email
     *
     * @return Teacher
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

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Teacher
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set mentorCourse
     *
     * @param \AppBundle\Entity\Course $mentorCourse
     *
     * @return Teacher
     */
    public function setMentorCourse(\AppBundle\Entity\Course $mentorCourse = null)
    {
        $this->mentor_course = $mentorCourse;

        return $this;
    }

    /**
     * Get mentorCourse
     *
     * @return \AppBundle\Entity\Course
     */
    public function getMentorCourse()
    {
        return $this->mentor_course;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Teacher
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
     * @return Teacher
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

    public function __toString()
    {
        return $this->getName()." ".$this->getSurname();
    }
}
