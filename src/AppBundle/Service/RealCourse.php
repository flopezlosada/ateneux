<?php
/**
 * Created by diphda.net.
 * User: paco
 * Date: 5/07/17
 * Time: 18:05
 */

namespace AppBundle\Service;


class RealCourse
{

    public function getRealCourse()
    {
        $real_month = date('m');
        $real_year = date('Y');

        if ($real_month > 6) {
            return $real_year . "/" . ($real_year + 1);
        }

        return ($real_year - 1) . "/" . $real_year;
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
    public function getStartDateCourse($year)
    {
        if ($year) {
            return date(($year)."-09-01");
        } else {
            $real_month = date('m');
            $real_year = date('Y');

            if ($real_month > 6) {
                return date($real_year."-09-01");
            }

            return date(($real_year-1)."-09-01");
        }
    }

    public function getEndDateCourse($year)
    {

        if ($year) {
            return date(($year+1)."-06-30");
        }
        else {
            $real_month = date('m');
            $real_year = date('Y');

            if ($real_month > 8) {
                return date(($real_year+1)."-06-30");
            }

            return date(($real_year)."-06-30");
        }
    }
}