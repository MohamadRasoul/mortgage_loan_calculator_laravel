<x-app-layout>




    <x-loan-calculator-info :loan="$loan"/>

    <div class="w-full " x-data="{ activeTab: 'origPayment' }">
        <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200 justify-center w-full ">
            <li class="mr-2">
                <a href="#" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-white shadow"
                   x-bind:class="{ 'bg-gray-50 text-gray-800 ': activeTab === 'origPayment' }" x-on:click="activeTab = 'origPayment'">
                    Orig Payment
                </a>
            </li>
            <li class="mr-2">
                <a href="#" class="inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-white shadow "
                   x-bind:class="{ 'bg-gray-50 text-gray-800 ': activeTab === 'extraPayment' }" x-on:click="activeTab = 'extraPayment'">
                    Extra Payment
                </a>
            </li>

        </ul>
        <div id="origPaymentContent" class="tab-content" x-show="activeTab === 'origPayment'">
            <x-table
                title="Orig Payment"
                :columns="[
                    'month_number',
                    'interest_component',
                    'principal_component',
                    'ending_balance'
                    ]"
                :rows="$loan->loanAmortizationSchedules"
            ></x-table>
        </div>

        <div id="extraPaymentContent" class="tab-content" x-show="activeTab === 'extraPayment'">

            <x-table
                title="Extra Payment"
                :columns="[
                    'month_number',
                    'interest_component',
                    'principal_component',
                    'ending_balance'
                    ]"
                :rows="$loan->extraRepaymentSchedules"
            ></x-table>
        </div>


    </div>
</x-app-layout>
