<?php

use App\Models\User;
use App\Models\Mairie;
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
        Schema::create('projets', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description');
            $table->date('date_projet');
            $table->date('date_limite_vote');
            $table->string('image');
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignIdFor(Mairie::class)->constrained()->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets');
    }
};
