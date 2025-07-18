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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('serie_name')->nullable();
            $table->foreignId('serie_id')
                ->constrained()
                ->onDelete('cascade')
                ->onUpdate('cascade');
            //$table->integer('year');
            $table->string('image_path');
            //$table->string('vehicledata_path');
            //$table->string('enginedata_path');
            //$table->string('servicemanual_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
