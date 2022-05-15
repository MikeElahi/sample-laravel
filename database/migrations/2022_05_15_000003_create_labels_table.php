<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use WiGeeky\Todo\Models\Task;

class CreateLabelsTable extends Migration
{
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique()->index();
        });
    }

    public function down()
    {
        Schema::dropIfExists('labels');
    }
}