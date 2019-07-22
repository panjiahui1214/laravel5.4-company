<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesUsersTable extends Migration
{
    protected $table = 'courses_users';
    protected $tb_cors = 'courses';
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
            $table->integer('cid')->comment('对应课程id')->unsigned();
            $table->integer('uid')->comment('对应会员id')->unsigned();
            $table->timestamps();

            $table->foreign('cid')->references('id')->on($this->tb_cors);
            $table->foreign('uid')->references('id')->on($this->tb_users);
        });

        DB::statement("ALTER TABLE ".$this->table." comment'课程报名信息表'");
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
