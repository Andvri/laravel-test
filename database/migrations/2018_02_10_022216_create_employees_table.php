<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('names',100);
            $table->string('maternal_surname',100);
            $table->string('paternal_surname',100);
        
            $table->date('birthdate');
            $table->string('phone',13);

            $table->string('gender');
            
            $table->string('rfc',13)->unique();
            
            $table->string('curp',13)->nullable()->unique();

            $table->string('ife_key',20)->nullable()->unique();
            $table->string('elector_key',20)->nullable()->unique();
            
            
            $table->string('imss',13)->nullable()->unique();


            $table->date('contract_date');
            


            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->integer('nationality_mode_id')->unsigned();
            $table->foreign('nationality_mode_id')->references('id')->on('nationality_modes');

            $table->integer('marital_statuses_id')->unsigned();
            $table->foreign('marital_statuses_id')->references('id')->on('marital_statuses');

            $table->integer('colony_id')->unsigned();
            $table->foreign('colony_id')->references('id')->on('colonies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
