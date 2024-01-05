{{-- Table --}}
<div class="w-full mb-4 bg-white shadow-lg rounded-2xl">

        <div class="py-5 px-7 sm:px-6">
            <h3 class="text-lg font-medium leading-6 text-gray-900">
                {{$loan->user->name}}
            </h3>
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
                        {{$loan->extraRepaymentSchedules->first()->monthly_payment}}
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
                        {{round($loan->total_payment_after_extra_repayment,2)}}
                    </dd>
                </div>
                <div class="py-5 border-b px-7 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6 border-gray-900/10">
                    <dt class="text-sm font-medium text-gray-500 sm:col-span-2">
                        Interest Savings:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">

                    </dd>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{round($loan->total_payment - $loan->total_payment_after_extra_repayment,2)}}
                    </dd>
                </div>
                <div class="py-5 border-b px-7 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6 border-gray-900/10">
                    <dt class="text-sm font-medium text-gray-500 sm:col-span-2">
                        Length:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{convertDecimalToYearsMonths($loan->loan_term)}}
                    </dd>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{convertDecimalToYearsMonths($loan->loan_term_after_extra_repayment)}}

                    </dd>
                </div>
                <div class="py-5 border-b px-7 sm:grid sm:grid-cols-6 sm:gap-4 sm:px-6 border-gray-900/10">
                    <dt class="text-sm font-medium text-gray-500 sm:col-span-2">
                        Time Saved:
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">

                    </dd>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        {{convertDecimalToYearsMonths($loan->loan_term - $loan->loan_term_after_extra_repayment)}}
                    </dd>
                </div>
            </dl>
        </div>
</div>
{{-- End Table  --}}
