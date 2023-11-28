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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

           $table->string('subject_id')->nullable();
           $table->string('plan_id')->nullable();
           $table->string('customer_id')->nullable();
           $table->string('payment_id')->nullable();
           $table->string('status')->nullable();
           $table->string('amount')->nullable();

           $table->string('payment_type')->nullable();


           $table->foreignId('payment_gateway_id')
           ->nullable()
           ->constrained('payment_gateways')
           ->onUpdate('cascade')
           ->onDelete('cascade');

           $table->foreignId('suscription_id')
           ->nullable()
           ->constrained('suscriptions')
           ->onUpdate('cascade')
           ->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
