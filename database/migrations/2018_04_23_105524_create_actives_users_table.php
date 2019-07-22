<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivesUsersTable extends Migration
{
    protected $table = 'actives_users';
    protected $tb_acts = 'actives';
    protected $tb_users = TABLE_USERS;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id')->comment('唯一标识')->unsigned();
            $table->integer('aid')->comment('对应活动id')->unsigned();
            $table->integer('uid')->comment('对应会员id')->unsigned();
            $table->tinyInteger('score')->comment('分数')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('aid')->references('id')->on($this->tb_acts);
            $table->foreign('uid')->references('id')->on($this->tb_users);
        });

        DB::statement("ALTER TABLE ".$this->table." comment'活动信息表'");
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
