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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'nom');
            $table->string('prenom');
            $table->string('adresse');
            $table->string('telephone')->unique();
            $table->string('login')->unique();
            $table->enum('statut',["actif",'inactif']);
            $table->string('cni')->unique();
            $table->index(["prenom",'id','nom',"telephone","login","statut","cni",]);






            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
