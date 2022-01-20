<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PortfolioCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_cartes', function(Blueprint $table) {
            $table->id('id_carte');
            $table->string('titre', 100);
            $table->text('resume');
            $table->string('addendum', 255);
            $table->string('src', 100);
            $table->string('alt', 100);
            $table->string('route', 100);
            $table->string('tag', 100);
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
