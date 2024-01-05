<?php

namespace App\RepaymentSchedule;

use App\Exceptions\ExtraRepaymentException;
use App\Models\Loan;

class ExtraRepaymentSchedule extends RepaymentSchedule
{

    /**
     * total dept for the entire period with percent
     *
     * @var int
     */
    public int $loanTermAfterExtraRepaymentByMonth = 0;

    public float $totalPaymentWithExtra = 0;

    /**
     * @var float|mixed|null
     */
    public mixed $monthlyTotalPaymentWithExtra = 0;


    public function __construct(Loan $loan)
    {
        if (!$loan->monthly_fixed_extra_payment) {
            throw new ExtraRepaymentException('there is no value for monthly_fixed_extra_payment');
        }

        parent::__construct($loan);

    }


    public function totalPaymentCompute(): Static
    {
        $this->monthlyTotalPayment = $this->MonthlyPaymentCompute();
        $this->totalPayment = $this->monthlyTotalPayment * $this->loan->loan_term_by_month;

        $this->monthlyTotalPaymentWithExtra = $this->monthlyTotalPayment + $this->loan->monthly_fixed_extra_payment;
        $this->totalPaymentWithExtra += $this->monthlyTotalPaymentWithExtra;

        return $this;
    }

    /**
     * To compute and set percent dept
     *
     * @param float $monthly_interest_rate
     * @return ExtraRepaymentSchedule
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
     * @return ExtraRepaymentSchedule
     */
    public function principalPaymentCompute(): Static
    {
        $this->monthlyPrincipalPayment = $this->monthlyTotalPaymentWithExtra - $this->monthlyInterestPayment;
        $this->totalPrincipalPayment += $this->monthlyPrincipalPayment;

        return $this;
    }

    /**
     * To compute and set main dept by month
     * and loan amount in month
     *
     * @return ExtraRepaymentSchedule
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
            monthlyTotalPayment: $this->monthlyTotalPaymentWithExtra,
            monthlyInterestPayment: $this->monthlyInterestPayment,
            monthlyPrincipalPayment: $this->monthlyPrincipalPayment,
            monthlyBalance: $this->monthlyBalance,
        );
    }


    /**
     * Calculate the full mortgage schedule
     *
     * @return array
     */
    public function toCompute(): void
    {
        for ($monthIndex = 1; $monthIndex <= $this->loan->loan_term_by_month; $monthIndex++) {
            if ($this->monthlyBalance < 0) {
                $this->loanTermAfterExtraRepaymentByMonth = --$monthIndex;
                break;
            }

            $this->resolver($monthIndex);

        }
    }

    public function store(): bool
    {
        $extraRepaymentScheduleData = $this->prepareDataToStore();

        $this->loan->update([
            'loan_term_after_extra_repayment' => ($this->loanTermAfterExtraRepaymentByMonth / 12),
            'total_payment' => $this->totalPayment,
            'total_payment_after_extra_repayment' => $this->totalPaymentWithExtra
        ]);

        return $this->loan
            ->extraRepaymentSchedules()
            ->insert($extraRepaymentScheduleData);
    }


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

