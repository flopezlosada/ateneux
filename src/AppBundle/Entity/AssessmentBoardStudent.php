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
 * AppBundle\Entity\AssessmentBoardStudent
 *
 */
class AssessmentBoardStudent
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
     * @ORM\ManyToOne(targetEntity="Student", inversedBy="assessments_board")
     */
    protected $student;

    /**
     * @var int learning_difficulties
     * @ORM\Column(name="learning_difficulties",  nullable=true)
     * Alumno con dificultades académicas
     */
    private $learning_difficulties = false;

    /**
     * @var int coexistence_difficulties
     * @ORM\Column(name="coexistence_difficulties ",  nullable=true)
     * Alumno con dificultades de convivencia
     */
    private $coexistence_difficulties = false;

    /**
     * @var int family_date
     * @ORM\Column(name="family_date",  nullable=true)
     * Alumno al que se debe citar a la familia inmediatamente
     */
    private $family_date = false;

    /**
     * @var int support
     * @ORM\Column(name="support",  nullable=true)
     * Alumno que necesita algún tipo de apoyo
     */
    private $support = false;

    /**
     * @var int change_optional
     * @ORM\Column(name="change_optional",  nullable=true)
     * Alumno que debe cambiar de optativa
     */
    private $change_optional = false;

    /**
     * @var int other_interesting
     * @ORM\Column(name="other_interesting",  nullable=true)
     * Otros datos de interés
     */
    private $other_interesting = false;

}