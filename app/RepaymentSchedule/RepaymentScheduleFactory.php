<?php

namespace App\RepaymentSchedule;

use App\Exceptions\RepaymentScheduleClassNotFoundException;
use App\Models\Loan;

class RepaymentScheduleFactory implements RepaymentScheduleFactoryInterface
{
    public const ORIG =1;
    public const WITH_EXTRA=2;



    public function handle($loan,$type):RepaymentSchedule
    {
        return match($type){
            Self::ORIG => new LoanRepaymentSchedule($loan),
            Self::WITH_EXTRA => new ExtraRepaymentSchedule($loan),
        };
    }

}
