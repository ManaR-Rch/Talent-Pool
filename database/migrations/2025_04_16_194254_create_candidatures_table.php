<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('annonce_id')->constrained()->onDelete('cascade');
            $table->text('message');
            $table->string('cv_path');
            $table->string('lettre_path')->nullable();
            $table->enum('statut', ['en_attente', 'en_cours', 'acceptee', 'refusee'])->default('en_attente');
            $table->text('notes_recruteur')->nullable();
            $table->timestamps();
            
            // Un candidat ne peut postuler qu'une seule fois à une annonce
            $table->unique(['user_id', 'annonce_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidatures');
    }
};