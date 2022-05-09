<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_datas', function (Blueprint $table) {
                $table->id();
                $table->text('task')->nullable()->default('');
                $table->longText('description')->nullable()->default('');
                $table->double('price')->nullable()->default(0);
                $table->text('executor')->nullable()->default('');
                $table->date('date')->nullable();
                $table->integer('status')->nullable()->default(0);
                $table->integer('user_id')->nullable()->default(0);
                $table->integer('creator_id');
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
        Schema::dropIfExists('task_datas');
    }
}
