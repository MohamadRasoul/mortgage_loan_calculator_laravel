{{-- Table --}}
<div class="w-full mb-4 bg-white shadow-lg rounded-2xl">


    <div class="m-10 sm:grid sm:grid-cols-4 sm:gap-6 ">
        <div class="flex items-center">
            <h3 class="text-lg font-bold leading-6 text-gray-900">
                {{$loan->user->name}}
            </h3>
        </div>
        <div class="flex items-center">
            <div class="text-sm  text-gray-900 font-bold ">
                Loan Amount :
            </div>
            <div class="mt-1 ml-3 text-sm text-gray-500 sm:mt-0 ">
                {{ $loan->loan_amount }}
            </div>
        </div>
        <div class="flex items-center">
            <div class="text-sm  text-gray-900 font-bold ">
                Interest Rate :
            </div>
            <div class="mt-1 ml-3 text-sm text-gray-500 sm:mt-0 ">
                {{ $loan->interest_rate }}
            </div>
        </div>
        <div class="flex items-center justify-end ">
            <a class=" px-4 py-2 text-base text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-blue-200"
               href={{route('loan.calculator')}}
            >
                New Loan Clac
            </a>
        </div>
    </div>


    <div class="py-5 text-xl font-semibold text-gray-600 px-7 bg-gray-50 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6">
        <div class=" sm:col-span-2">
            Loan
        </div>
        <div class="mt-1 sm:mt-0 sm:col-span-2">
            Original Schedule
        </div>
        <div class="mt-1 sm:mt-0 sm:col-span-2">
            Additional Payment
        </div>
    </div>

    <div class="mb-10 border-t border-gray-200">
        <dl>
            <div class="py-5 border-b px-7 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6 border-gray-900/10">
                <dt class="text-sm font-medium text-gray-500 sm:col-span-2">
                    Monthly Principal & Interest Payment:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $loan->loanAmortizationSchedules->first()->monthly_payment}}
                </dd>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$loan->extraRepaymentSchedules->first()?->monthly_payment}}
                </dd>
            </div>
            <div class="py-5 border-b px-7 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6 border-gray-900/10">
                <dt class="text-sm font-medium text-gray-500 sm:col-span-2">
                    Total Monthly Payments:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{round($loan->total_payment,2)}}
                </dd>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$loan->monthly_fixed_extra_payment > 0 ? round($loan->total_payment_after_extra_repayment,2):""}}
                </dd>
            </div>
            <div class="py-5 border-b px-7 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6 border-gray-900/10">
                <dt class="text-sm font-medium text-gray-500 sm:col-span-2">
                    Interest Savings:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">

                </dd>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$loan->monthly_fixed_extra_payment > 0 ? round($loan->total_payment - $loan->total_payment_after_extra_repayment,2):""}}
                </dd>
            </div>
            <div class="py-5 border-b px-7 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6 border-gray-900/10">
                <dt class="text-sm font-medium text-gray-500 sm:col-span-2">
                    Loan Term:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{convertDecimalToYearsMonths($loan->loan_term)}}
                </dd>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ convertDecimalToYearsMonths($loan->loan_term_after_extra_repayment)}}

                </dd>
            </div>
            <div class="py-5 border-b px-7 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6 border-gray-900/10">
                <dt class="text-sm font-medium text-gray-500 sm:col-span-2">
                    Time Saved:
                </dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">

                </dd>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{$loan->monthly_fixed_extra_payment > 0 ? convertDecimalToYearsMonths($loan->loan_term - $loan->loan_term_after_extra_repayment):""}}
                </dd>
            </div>
        </dl>
    </div>
</div>
{{-- End Table  --}}
