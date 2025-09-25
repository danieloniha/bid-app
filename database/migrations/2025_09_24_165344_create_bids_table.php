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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            //$table->string('vendor_name')->nullable();
            $table->string('buyer_name')->nullable();
            $table->string('tender_id')->nullable();
            $table->string('tender_title')->nullable();
            $table->foreignId('category_id')->constrained()->nullable();
            $table->integer('amount')->nullable();
            $table->string('delivery_location')->nullable();
            $table->string('delivery_date')->nullable();
            $table->text('note')->nullable();
            $table->json('document')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('unit_price')->nullable();
            $table->enum('status', ['Under Review', 'Accepted', 'Rejected'])->default('Under Review');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
