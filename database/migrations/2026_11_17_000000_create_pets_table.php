<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('type', 30);
            $table->string('breed', 100)->nullable();
            $table->unsignedSmallInteger('age');
            $table->string('gender', 20);
            $table->string('owner_name', 120);
            $table->string('contact_number', 30);
            $table->text('address');
            $table->date('date_registered');
            $table->timestamps();

            $table->index('name');
            $table->index('owner_name');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};