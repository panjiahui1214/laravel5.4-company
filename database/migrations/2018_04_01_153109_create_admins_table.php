<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    protected $table = TABLE_ADMINS;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id')->comment('唯一标识')->unsigned();
            $table->string('name', 25)->comment('管理员账号')->unique();
            $table->integer('rid')->comment('对应角色id值')->unique();
            $table->string('password')->comment('密码');
            $table->dateTime('last_time')->comment('最后一次登录时间')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE ".$this->table." comment'管理员信息表'");
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
