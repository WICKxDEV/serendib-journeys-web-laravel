<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStripeFieldsToPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->string('transaction_id')->nullable()->after('amount');
            $table->string('stripe_payment_intent_id')->nullable()->after('transaction_id');
        });
        
        // For MariaDB compatibility, we'll drop and recreate the method column
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('method');
        });
        
        Schema::table('payments', function (Blueprint $table) {
            $table->string('payment_method')->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['transaction_id', 'stripe_payment_intent_id', 'payment_method']);
            $table->string('method')->after('amount');
        });
    }
}
