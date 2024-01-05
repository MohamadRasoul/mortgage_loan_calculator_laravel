<?php

namespace App\RepaymentSchedule;

use App\Exceptions\RepaymentScheduleClassNotFoundException;
use App\Models\Loan;

class RepaymentScheduleDirector
{
    public static function handle($loan):bool
    {
//        try {
            $repaymentSchedule = new RepaymentScheduleFactory();
            $origRepaymentSchedule = $repaymentSchedule->handle($loan, RepaymentScheduleFactory::ORIG);
            $extraRepaymentSchedule = $loan->monthly_fixed_extra_payment ? $repaymentSchedule->handle($loan, RepaymentScheduleFactory::WITH_EXTRA):null;
//        }catch (\Exception $e){
//            return false;
//        }

        return true;
    }



}
