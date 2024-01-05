<?php

namespace App\RepaymentSchedule;

use App\Exceptions\RepaymentScheduleClassNotFoundException;
use App\Models\Loan;

interface RepaymentScheduleFactoryInterface
{
    public function handle($loan,$type):RepaymentSchedule;

}
