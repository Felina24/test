<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBuildingNullableOnContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE contacts MODIFY COLUMN building VARCHAR(255) NULL;");
    }

    public function down()
    {
        DB::statement("ALTER TABLE contacts MODIFY COLUMN building VARCHAR(255) NOT NULL;");
    }
}
