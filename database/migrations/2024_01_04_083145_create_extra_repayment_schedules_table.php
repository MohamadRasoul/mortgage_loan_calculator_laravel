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
            $table->integer('month_number'); //TODO : make it enum
            $table->double('starting_balance');
            $table->double('monthly_payment');
            $table->double('principal_component');
            $table->double('interest_component');
            $table->double('ending_balance');

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
