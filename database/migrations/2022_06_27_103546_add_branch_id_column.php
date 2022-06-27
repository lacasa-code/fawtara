<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchIdColumn extends Migration
{
    
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('branch_id')->nullable();
        });
    }

   
    public function down()
    {
        //
    }
}
