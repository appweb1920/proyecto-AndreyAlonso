<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->integer('user_id');
            $table->foreign('user_id','responses_user_id_fk')->references('id')->on('users');
            $table->integer('publication_id');
            $table->foreign('publication_id', 'responses_publication_id_fk')->references('id')->on('publications');
            $table->integer('likes')->default(0);
            $table->boolean('is_approved')->default('false');
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
        Schema::dropIfExists('responses');
    }
}
