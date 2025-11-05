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
        // Supprimer les contraintes étrangères des tables dépendantes
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            // Supprimer l'index unique existant sur id
            $table->dropUnique(['id']);
            // Ajouter la contrainte primaire sur id
            $table->primary('id');
        });

        // Recréer les contraintes étrangères
        Schema::table('clients', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropPrimary(['id']);
            $table->unique('id');
        });
    }
};
