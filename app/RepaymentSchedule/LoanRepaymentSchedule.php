<?php

namespace App\RepaymentSchedule;

use App\Models\Loan;
use Nette\Utils\Floats;
use PhpParser\Node\Expr\Cast\Double;

class LoanRepaymentSchedule extends RepaymentSchedule
{
    /**
     * To compute and set total dept
     *
     * @return LoanRepaymentSchedule
     */
    public function totalPaymentCompute(): Static
    {
        $this->monthlyTotalPayment = $this->MonthlyPaymentCompute();
        $this->totalPayment = $this->monthlyTotalPayment * $this->loan->loan_term_by_month;
        return $this;
    }

    /**
     * To compute and set percent dept
     *
     * @param float $monthly_interest_rate
     * @return LoanRepaymentSchedule
     */
    public function interestPaymentCompute(float $monthly_interest_rate): Static
    {
        $this->monthlyInterestPayment = $this->monthlyBalance * $monthly_interest_rate;
        $this->totalInterestPayment += $this->monthlyInterestPayment;

        return $this;
    }

    /**
     * main dept updated TO DO
     *
     * @return LoanRepaymentSchedule
     */
    public function principalPaymentCompute(): Static
    {
        $this->monthlyPrincipalPayment = $this->monthlyTotalPayment - $this->monthlyInterestPayment;
        $this->totalPrincipalPayment += $this->monthlyPrincipalPayment;

        return $this;
    }

    /**
     * To compute and set main dept by month
     * and loan amount in month
     *
     * @return LoanRepaymentSchedule
     */
    public function monthlyBalanceCompute(): Static
    {
        $this->monthlyBalance = $this->loanAmount - $this->monthlyPrincipalPayment;
        $this->loanAmount = $this->monthlyBalance;

        return $this;
    }

    /**
     * director Compute
     * @param $monthIndex
     * @return void
     */
    public function resolver($monthIndex): void
    {
        $this->totalPaymentCompute()
            ->interestPaymentCompute($this->loan->monthly_interest_rate)
            ->principalPaymentCompute()
            ->monthlyBalanceCompute();


        $this->storeRepaymentScheduleResult(
            monthIndex: $monthIndex,
            monthlyTotalPayment: $this->monthlyTotalPayment,
            monthlyInterestPayment: $this->monthlyInterestPayment,
            monthlyPrincipalPayment: $this->monthlyPrincipalPayment,
            monthlyBalance: $this->monthlyBalance,
        );
    }


    /**
     * Calculate the full mortgage schedule
     *
     * @param
     * @return void
     */
    public function toCompute(): void
    {
        for ($monthIndex = 1; $monthIndex <= $this->loan->loan_term_by_month; $monthIndex++) {
            $this->resolver($monthIndex);
        }
    }

    public function store():bool
    {
        $repaymentScheduleData = $this->prepareDataToStore();

        $this->loan->update([
            'total_payment' => $this->totalPayment
        ]);

        return $this->loan
            ->loanAmortizationSchedules()
            ->insert($repaymentScheduleData);
    }

    /**
     * @return array|array[]
     */
    public function prepareDataToStore(): array
    {
        return array_map(function ($el) {
            return [
                'month_number' => $el['monthIndex'],
                'starting_balance' => $this->loan->loan_amount,
                'monthly_payment' => $el['monthlyTotalPayment'],
                'principal_component' => $el['monthlyPrincipalPayment'],
                'interest_component' => $el['monthlyInterestPayment'],
                'ending_balance' => $el['monthlyBalance'],
                'loan_id' => $this->loan->id,
            ];
        }, $this->repaymentScheduleResult);
    }
}
