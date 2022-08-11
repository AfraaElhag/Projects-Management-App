<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProjectTask extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_task', function (Blueprint $table) {
            $table->id();
            $table->foreignID('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreignID('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->text('status');
            $table->timestamps();
            $table->text('completed_by')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('project_user');
    }
}
