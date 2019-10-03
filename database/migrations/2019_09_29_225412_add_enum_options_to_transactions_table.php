<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddEnumOptionsToTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE transactions CHANGE COLUMN status status ENUM(
                'pending payment', 
                'processing', 
                'approved',
                'rejected',
                'credited'
            ) NOT NULL DEFAULT 'pending payment'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE transactions CHANGE COLUMN status status ENUM(
            'processing', 
            'approved',
            'rejected',
            'credited'
        ) NOT NULL DEFAULT 'processing'");
    }
}
