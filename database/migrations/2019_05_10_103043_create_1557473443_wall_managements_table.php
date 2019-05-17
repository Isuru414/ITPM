<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create1557473443WallManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasTable('wall_managements')) {
            Schema::create('wall_managements', function (Blueprint $table) {
                $table->increments('id');
                $table->date('date')->nullable();
                $table->string('image')->nullable();
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('notice_files')->nullable();
                
                $table->timestamps();
                $table->softDeletes();

                $table->index(['deleted_at']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wall_managements');
    }
}
