 {{-- Form --}}

    <x-card>
         <form method="post" action={{route('loan.calculator')}}>
             @csrf
             <div class="space-y-12">
                 <div class="pb-12 border-b border-gray-900/10">
                     <h2 class="text-base font-semibold leading-7 text-gray-900">Personal
                         Information</h2>
                     <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address
                         where
                         you can receive mail.</p>

                     <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">


                         <div class="pb-12 border-b col-span-full border-gray-900/10">
                             <label for="loan_amount" class="block text-sm font-medium leading-6 text-gray-900">Loan
                                 Amount</label>
                             <div class="mt-2">
                                 <input type="number" name="loan_amount" id="loan_amount"
                                     autocomplete="loan_amount"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                             </div>
                         </div>
                         <div
                             class="grid grid-cols-1 pb-12 border-b col-span-full gap-x-6 gap-y-8 sm:grid-cols-6 border-gray-900/10">
                             <div class="sm:col-span-3">
                                 <label for="interest_rate" class="block text-sm font-medium leading-6 text-gray-900">
                                     Annual Interest Rate
                                     <span class="text-sm text-gray-400"> ( in percentage % )</span>
                                 </label>
                                 <div class="mt-2">
                                     <input type="number" name="interest_rate" id="interest_rate" autocomplete="interest_rate"
                                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                 </div>
                             </div>

                             <div class="sm:col-span-3">
                                 <label for="loan_term" class="block text-sm font-medium leading-6 text-gray-900">
                                     Loan Term
                                     <span class="text-sm text-gray-400"> ( in years )</span>
                                 </label>
                                 <div class="mt-2">
                                     <input type="number" name="loan_term" id="loan_term" autocomplete="loan_term"
                                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                 </div>
                             </div>
                         </div>

                         <div class="pb-12 col-span-full ">
                             <label for="monthly_fixed_extra_payment" class="block text-sm font-medium leading-6 text-gray-900">
                                 Monthly Fixed Extra Payment
                                 <span class="text-sm text-gray-400"> ( optional )</span>

                             </label>
                             <div class="mt-2">
                                 <input type="number" name="monthly_fixed_extra_payment" id="monthly_fixed_extra_payment"
                                     autocomplete="monthly_fixed_extra_payment"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                             </div>
                         </div>

                     </div>
                 </div>

             </div>

             <div class="flex items-center justify-end mt-6 gap-x-6">
                 <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                 <button type="submit"
                     class="px-3 py-2 text-sm font-semibold text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
             </div>
         </form>

    </x-card>

 {{-- End Form --}}
