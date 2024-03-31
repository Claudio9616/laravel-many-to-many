<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Project;
use App\Models\Technology;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_technology', function (Blueprint $table) {
            $table->id();
            // $table->foreign('project_id')->references('id')->on('projects')->constrained()->onDelete('cascade');
            // $table->foreign('technology_id')->references('id')->on('technologies')->constrained()->onDelete('cascade');
            $table->foreignIdFor(Project::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Technology::class)->constrained()->cascadeOnDelete();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_technology');
    }
};
// Nella down in questo caso non dobbiamo mettere nulla perchè stiamo creando una tabella semplice, nell'altra migration noi creiamo un legame e quindi se 
// dovessimo ditruggere la tabella prima faccio il down della relazione e poi droppo la tabella stessa