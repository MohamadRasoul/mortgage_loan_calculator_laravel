<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <x-card>
        <div class="py-8">
            <div class="flex flex-row justify-between w-full mb-1 sm:mb-0">
                <h2 class="text-2xl leading-tight">
                    Loan Calculator History
                </h2>
               <div>
                    <a class="flex-shrink-0 px-4 py-2 text-base font-semibold text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-blue-200"
                        href={{route('loan.calculator')}}
                    >
                        New Loan Clac
                    </a>
                </div>
            </div>
            </div>
            <div class="px-4 py-4 -mx-4 overflow-x-auto sm:-mx-8 sm:px-8">
                <div class="inline-block min-w-full overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                        <tr>
                            <th scope="col"
                                class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                #
                            </th>
                            <th scope="col"
                                class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Loan Amount
                            </th>
                            <th scope="col"
                                class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Loan Term
                            </th>
                            <th scope="col"
                                class="px-5 py-3 text-sm font-normal text-left text-gray-800 uppercase bg-white border-b border-gray-200">
                                Interest Rate
                            </th>
                            <th scope="col"
                                class="border-b border-gray-200">

                            </th>
                        </tr>
                        </thead>
                        <tbody>

                       @foreach($loans as $idx => $loan)
                           <tr>
                               <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                   <div class="flex items-center">
                                       <div>
                                           <p class="text-gray-900 whitespace-no-wrap">
                                               #{{$idx +1}}
                                           </p>
                                       </div>
                                   </div>
                               </td>
                               <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                   <p class="text-gray-900 whitespace-no-wrap">
                                       {{$loan->loan_amount}}
                                   </p>
                               </td>
                               <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                   <p class="text-gray-900 whitespace-no-wrap">
                                       {{$loan->loan_term}}

                                   </p>
                               </td>
                               <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                   <p class="text-gray-900 whitespace-no-wrap">
                                       {{$loan->interest_rate}}
                                   </p>
                               </td>
                               <td class="px-5 py-5 text-sm bg-white border-b border-gray-200">
                                    <span
                                        class="relative inline-block px-3 py-1 font-semibold leading-tight text-green-900">
                                        <span aria-hidden="true"
                                              class="absolute inset-0 bg-green-200 rounded-full opacity-50">
                                        </span>
                                        <a class="relative cursor-pointer" href={{ route('loan.result') }}>
                                            show
                                        </a>
                                    </span>
                               </td>

                           </tr>
                       @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </x-card>
</x-app-layout>
