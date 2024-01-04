<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('extra_repayment_schedules', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('month_number'); //TODO : make it enum
            $table->double('starting_balance');
            $table->double('monthly_payment');
            $table->double('principal_component');
            $table->double('interest_component');
            $table->double('ending_balance');

            $table->double('extra_repayment_made');
            $table->double('ending_balance_after');
            $table->double('extra_repayment');
            $table->double('remaining_loan_term_after_extra_repayment');

            $table->foreignIdFor(\App\Models\Loan::class)->constrained()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('extra_repayment_schedules');
    }
};
