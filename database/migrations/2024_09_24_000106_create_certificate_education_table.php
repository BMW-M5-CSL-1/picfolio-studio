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
        Schema::create('certificate_education', function (Blueprint $table) {
            // Certificates/Education Table
                $table->id();
                $table->bigInteger('user_id');
                $table->string('name')->nullable();
                $table->string('institution')->nullable();
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->longText('description')->nullable();
                $table->timestamps();
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
        Schema::dropIfExists('certificate_education');
    }
};
