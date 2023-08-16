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
        Schema::create('group', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('lsakses')->nullable();
            //$table->integer('_index')->default(1);
            //$table->integer('_create')->default(0);
            //$table->integer('_store')->default(0);
            //$table->integer('_show')->default(1);
            //$table->integer('_edit')->default(0);
            //$table->integer('_update')->default(0);
            //$table->integer('_destroy')->default(0);
            $table->string('crid');
            $table->string('upid')->nullable();
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
        Schema::dropIfExists('group');
    }
};
