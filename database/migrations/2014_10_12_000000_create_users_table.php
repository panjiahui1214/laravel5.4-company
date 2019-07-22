<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    protected $table = TABLE_USERS;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id')->comment('唯一标识')->unsigned();
            $table->char('uuid', 128)->comment('对外唯一标识');
            $table->string('name', 25)->comment('昵称')->unique();
            $table->char('sex', 1)->comment('性别，M-男，F-女')->nullable();
            $table->string('mobile', 11)->comment('手机号码');
            $table->string('email', 50)->comment('电子邮箱')->nullable();
            $table->string('password')->comment('密码');
            $table->dateTime('last_time')->comment('最近登录时间')->nullable();
            $table->string('remark', 50)->comment('备注')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE ".$this->table." comment'会员基本信息表'");
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
