<?php

namespace App\Http\Controllers;

use App\Http\Requests\Loan\StoreLoanRequest;
use App\Http\Requests\Loan\UpdateLoanRequest;
use App\Models\Loan;
use App\RepaymentSchedule\ExtraRepaymentSchedule;
use App\RepaymentSchedule\RepaymentScheduleDirector;
use App\RepaymentSchedule\LoanRepaymentSchedule;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = \Auth::user();

        return view('pages.loans',
            [
                'loans' => $user->loans
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.calculators');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoanRequest $request)
    {
        $user = \Auth::user();

        $loan = $user->loans()->create($request->validated());
        RepaymentScheduleDirector::handle($loan);

        return to_route('loan.show',$loan);
    }

    /**
     * Display the specified resource.
     */
    public function show(Loan $loan)
    {
        $loan->load(['loanAmortizationSchedules','extraRepaymentSchedules','user']);

        return view('pages.result',[
            'loan' => $loan
        ]);
    }
}
