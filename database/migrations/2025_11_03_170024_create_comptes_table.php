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
        Schema::create('comptes', function (Blueprint $table) {
                $table->uuid('id')->primary();
            $table->uuid('client_id');
            $table->foreign("client_id")->references('id')->on("clients")->onDelete('Cascade');
             // clé étrangère vers clients
            $table->string('numero_compte')->unique();
            $table->enum('type', ['epargne', 'cheque']);
            $table->enum('statut', ['actif', 'bloque', 'ferme'])->default('actif');
            $table->dateTime("date_debut_blocage")->nullable();
            $table->dateTime("date_fin_blocage")->nullable();
            $table->timestamps();
            $table->index(['numero_compte',"client_id","type","statut","date_debut_blocage","date_fin_blocage"]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
