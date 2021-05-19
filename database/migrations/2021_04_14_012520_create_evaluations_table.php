<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_evaluation_id')->nullable();
            $table->foreignId('cours_id');
            $table->string('titre', 100);
            $table->string('type_evaluation', 100);
            $table->decimal('note', 5, 2);
            $table->decimal('ponderation', 5, 2);
            $table->dateTime('date_evaluation');
            $table->foreign('type_evaluation_id')->references('id')->on('type_evaluations')->onDelete('restrict');
            $table->foreign('cours_id')->references('id')->on('cours')->onDelete('restrict');
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
        Schema::dropIfExists('evaluations');
    }
}
