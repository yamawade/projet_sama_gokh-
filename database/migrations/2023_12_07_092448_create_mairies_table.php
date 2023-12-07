<?php

use App\Models\Commune;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mairies', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('matricule')->unique();
            $table->string('login')->unique();
            $table->string('image');
            $table->foreignIdFor(Commune::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mairies');
    }
};
