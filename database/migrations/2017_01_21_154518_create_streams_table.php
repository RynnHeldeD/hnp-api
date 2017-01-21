<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStreamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('streams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 20);
            $table->decimal('amount', 5 , 2);
            $table->integer('parent_objective_id')->unsigned();
            $table->foreign('parent_objective_id')
                ->references('id')
                ->on('objectives')
                ->onDelete('cascade');
            $table->integer('child_objective_id')->unsigned();
            $table->foreign('child_objective_id')
                ->references('id')
                ->on('objectives')
                ->onDelete('cascade');
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
        Schema::dropIfExists('streams');
    }
}
