<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->longText('bio')->nullable();
            $table->string('finalprincipal')->nullable();
            $table->string('website')->nullable()->unique();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('legalowner')->nullable();
            $table->string('seemstobe')->nullable();
            $table->string('inorderto')->nullable();
            $table->string('audience')->nullable();
            $table->string('country')->nullable();
            $table->string('is_active')->default('0');
            $table->string('added_by');
            $table->string('user_id');
            $table->integer('relatedparties')->nullable();
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
        Schema::dropIfExists('media');
    }
}
