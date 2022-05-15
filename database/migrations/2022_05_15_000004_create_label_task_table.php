<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use WiGeeky\Todo\Models\Task;

class CreateLabelTaskTable extends Migration
{
    public function up()
    {
        Schema::create('label_task', function (Blueprint $table) {
            $table->unsignedBigInteger('label_id');
            $table->unsignedBigInteger('task_id');

            $table->foreign('label_id')->references('id')->on('labels')->cascadeOnDelete();
            $table->foreign('task_id')->references('id')->on('tasks')->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('label_task');
    }
}