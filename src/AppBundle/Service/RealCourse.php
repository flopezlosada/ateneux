<?php
/**
 * Created by diphda.net.
 * User: paco
 * Date: 5/07/17
 * Time: 18:05
 */

namespace AppBundle\Service;


use Doctrine\ORM\EntityManager;

class RealCourse
{
    public static $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        RealCourse::$em = $entityManager;

    }

    public static function getRealSchoolCourse()
    {
       return RealCourse::$em->getRepository("AppBundle:SchoolYear")->findRealSchoolCourse();
    }

    public static function getRealCourse()
    {
        $real_month = date('m');
        $real_year = date('Y');

        if ($real_month > 6) {
            return $real_year . "/" . ($real_year + 1);
        }

        return ($real_year - 1) . "/" . $real_year;
    }

    public static function getPreviousCourse()
    {
        $real_month = date('m');
        $real_year = date('Y');

        if ($real_month > 6) {
            return ($real_year - 1) . "/" . $real_year;
        }

        return ($real_year - 2) . "/" . ($real_year - 1);
    }


    public function __toString()
    {
        return $this->getRealCourse();
    }

    /*
     * se trata de saber la fecha de incio y fin de curso en cada año. Es para comparaciones en consultas sql
     * Si se aporta el año, entiendo que es el año de inicio del curso, es decir, si se pasa 2017, entiendo que se
     * refiere al curso 2017/2108
     */
    public static function getStartDateCourse($year = null)
    {
        if ($year) {
            return date(($year) . "-09-01");
        } else {
            $real_month = date('m');
            $real_year = date('Y');

            if ($real_month > 6) {
                return date($real_year . "-09-01");
            }

            return date(($real_year - 1) . "-09-01");
        }
    }

    public static function getEndDateCourse($year = null)
    {

        if ($year) {
            return date(($year + 1) . "-06-30");
        } else {
            $real_month = date('m');
            $real_year = date('Y');

            if ($real_month > 8) {
                return date(($real_year + 1) . "-06-30");
            }

            return date(($real_year) . "-06-30");
        }
    }
}