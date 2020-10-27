<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FormFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_fields', function (Blueprint $table) {
            $table->unsignedBigInteger('file_id');
            $table->foreign('file_id')
                ->references('file_id')
                ->on('files')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('field_name');
            $table->string('field_type');
            $table->string('field_value');
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
}
