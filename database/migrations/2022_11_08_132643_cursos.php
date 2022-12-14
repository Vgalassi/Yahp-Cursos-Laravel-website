<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('descricomp');
            $table->string('descrisimp');
            $table->integer('minalu');
            $table->integer('maxalu');
            $table->string('imagem');
            $table->integer('status')->nullable;
            $table->timestamps();
            $table->foreignID('user_id')->nullable()->constrained()->onDelete('cascade');;
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
