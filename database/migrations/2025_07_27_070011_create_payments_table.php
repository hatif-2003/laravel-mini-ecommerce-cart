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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('razorpay_order_id');
            $table->string('razorpay_payment_id')->nullable();
            $table->string('status')->default('created'); // created, paid, failed
          
            $table->string('name')->nullable();
             $table->text('address');
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('pincode');
            $table->decimal('total_price', 10, 2);
           
            $table->string('phone')->nullable();
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
