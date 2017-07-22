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
}