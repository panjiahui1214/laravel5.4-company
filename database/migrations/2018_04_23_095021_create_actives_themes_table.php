<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivesThemesTable extends Migration
{
    protected $table = 'actives_themes';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->tinyIncrements('id')->comment('唯一标识')->unsigned();
            $table->string('name', 25)->comment('名称')->unique();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE ".$this->table." comment'活动主题信息表'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
