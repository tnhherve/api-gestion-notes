<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('section_id');
            $table->string('nom_cours', 100);
            $table->decimal('seuil_reussite', 5, 2)->default(60.00);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cours');
    }
}
