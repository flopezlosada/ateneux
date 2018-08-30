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
        $real_month=date('m');
        $real_year= date('Y');

        if ($real_month>6)
        {
            return $real_year."/".($real_year+1);
        }

        return ($real_year-1)."/".$real_year;
    }


    public function __toString()
    {
        return $this->getRealCourse();
    }

    /*
     * se trata de saber la fecha de incio y fin de curso en cada año. Es para comparaciones en consultas sql
     */
    public function getStartDateCourse()
    {
        $real_month=date('m');
        $real_year= date('Y');

        if ($real_month>6)
        {
            return date("01-09-".$real_year);
        }

        return date("01-09-".($real_year-1));
    }

    public function getEndDateCourse()
    {
        $real_month=date('m');
        $real_year= date('Y');

        if ($real_month>8)
        {
            return date("30-06-".($real_year+1));
        }

        return date("30-06-".$real_year);
    }
}