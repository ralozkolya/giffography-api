<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class MakeNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE `files`
          MODIFY `mimetype` VARCHAR(20) NULL,
          MODIFY `size` INTEGER UNSIGNED NULL,
          MODIFY `progress` INTEGER UNSIGNED NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('ALTER TABLE `files`
          MODIFY `mimetype` VARCHAR(20),
          MODIFY `size` INTEGER,
          MODIFY `progress` INTEGER');
    }
}
