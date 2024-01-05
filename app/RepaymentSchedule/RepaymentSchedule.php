<?php

namespace App\RepaymentSchedule;

use App\Models\Loan;

abstract class RepaymentSchedule
{
    /**
     * How much is left to pay
     * for the entire period
     *
     * @var float
     */
    public float $loanAmount;

    /**
     * How much is left to pay
     * from the current month
     *
     * @var float
     */
    public float $monthlyBalance;

    /**
     * total percent dept for the entire period
     *
     * @var float
     */
    public float $totalPrincipalPayment;

    /**
     * main dept by month
     *
     * @var float
     */
    public float $monthlyPrincipalPayment;


    /**
     * total percent dept for the entire period
     *
     * @var float
     */
    public float $totalInterestPayment;

    /**
     * dept by percent
     *
     * @var float
     */
    public float $monthlyInterestPayment;


    /**
     * total dept for the entire period with percent
     *
     * @var float
     */
    public float $totalPayment;

    /**
     * total dept for the entire period with percent
     *
     * @var float
     */
    public float $monthlyTotalPayment;

    /**
     * Detailed repayment schedule
     *
     * @var array
     */
    public array $repaymentScheduleResult = [];

    public function __construct(public Loan $loan)
    {
        $this->baseMount();

        $this->toCompute();

        $this->store();
    }

    /**
     * Create a new instance of the schedule
     *
     * @param integer $monthIndex
     * @return void
     */
    public function storeRepaymentScheduleResult(
        int   $monthIndex,
        float $monthlyTotalPayment,
        float $monthlyInterestPayment,
        float $monthlyPrincipalPayment,
        float $monthlyBalance,
    ): void
    {
        $this->repaymentScheduleResult[] = [
            'monthIndex' => $monthIndex,
            'monthlyTotalPayment' => $monthlyTotalPayment,
            'monthlyInterestPayment' => $monthlyInterestPayment,
            'monthlyPrincipalPayment' => $monthlyPrincipalPayment,
            'monthlyBalance' => max($monthlyBalance, 0)
        ];
    }
    /**
     * Set the initial parameters
     *
     * @return void
     */
    private function baseMount(): void
    {
        $this->loanAmount = $this->loan->loan_amount;
        $this->monthlyBalance = $this->loan->loan_amount;

        $this->totalInterestPayment = 0;
        $this->monthlyInterestPayment = 0;

        $this->totalPrincipalPayment = 0;
        $this->monthlyPrincipalPayment = 0;

        $this->totalPayment = 0;
        $this->monthlyTotalPayment = 0;
    }


    /**
     * @return float
     */
    public function MonthlyPaymentCompute(): float
    {
        $exponentExpression = (1 + $this->loan->monthly_interest_rate) ** (-$this->loan->loan_term_by_month);
        $upEquation = $this->loan->loan_amount * $this->loan->monthly_interest_rate;
        $downEquation = 1 - $exponentExpression;
        return $upEquation / $downEquation;
    }

    abstract public function totalPaymentCompute(): Static;

    abstract public function interestPaymentCompute(float $monthly_interest_rate): Static;

    abstract public function principalPaymentCompute(): Static;

    abstract public function monthlyBalanceCompute(): Static;

    abstract public function resolver($monthIndex): void;

    abstract public function toCompute():void;

    abstract public function store():bool;

}
