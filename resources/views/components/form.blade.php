 {{-- Form --}}
 <div class="w-full mb-4 ">
     <div class="w-full p-4 bg-white shadow-lg rounded-2xl dark:bg-gray-700">
         <form>
             <div class="space-y-12">
                 <div class="pb-12 border-b border-gray-900/10">
                     <h2 class="text-base font-semibold leading-7 text-gray-900">Personal
                         Information</h2>
                     <p class="mt-1 text-sm leading-6 text-gray-600">Use a permanent address
                         where
                         you can receive mail.</p>

                     <div class="grid grid-cols-1 mt-10 gap-x-6 gap-y-8 sm:grid-cols-6">


                         <div class="pb-12 border-b col-span-full border-gray-900/10">
                             <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Loan
                                 Amount</label>
                             <div class="mt-2">
                                 <input type="number" name="street-address" id="street-address"
                                     autocomplete="street-address"
                                     class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                             </div>
                         </div>





                         <div
                             class="grid grid-cols-1 pb-12 border-b col-span-full gap-x-6 gap-y-8 sm:grid-cols-6 border-gray-900/10">
                             <div class="sm:col-span-3">
                                 <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">
                                    Annual Interest Rate
                                    <span class="text-sm text-gray-400"> ( in percentage % )</span>
                                </label>
                                 <div class="mt-2">
                                     <input type="number" name="first-name" id="first-name" autocomplete="given-name"
                                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                 </div>
                             </div>

                             <div class="sm:col-span-3">
                                 <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">
                                    Loan Term
                                    <span class="text-sm text-gray-400"> ( in years )</span>
                                 </label>
                                 <div class="mt-2">
                                     <input type="number" name="last-name" id="last-name" autocomplete="family-name"
                                         class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                 </div>
                             </div>
                         </div>

                         <div class="pb-12 col-span-full ">
                             <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">
                                Monthly Fixed Extra Payment
                                <span class="text-sm text-gray-400"> ( optional )</span>

                            </label>
                             <div class="mt-2">
                                 <input type="number" name="street-address" id="street-address"
                                     autocomplete="street-address"
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
     </div>
 </div>
 {{-- End Form --}}
