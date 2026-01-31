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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->references("id")->on("users")->onDelete("cascade");
         
            $table->string('order_number')->unique();
            // Order lifecycle
            $table->string('status'); // pending, processing, shipped, delivered, cancelled, refunded
            // Payment lifecycle
            $table->string('payment_status')->default("unpaid"); // unpaid, paid, failed, refunded
            // Money snapshot
            $table->decimal('subtotal', 10, 2);
            $table->decimal('discount', 10, 2)->default(0)->nullable();
            $table->decimal('total', 10, 2);
            $table->string('currency', 3)->default('EGP');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
