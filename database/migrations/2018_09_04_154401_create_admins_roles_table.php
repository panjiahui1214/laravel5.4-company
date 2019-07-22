<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsRolesTable extends Migration
{
    protected $table = 'admins_roles';
    protected $tb_menusAd = 'menus_ad';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id')->comment('唯一标识')->unsigned();
            $table->string('name', 25)->comment('名称')->unique();
            $table->string('description')->comment('描述');
            $table->string('menus_id', 50)->comment('可操作菜单id值');
            $table->timestamps();

            $table->foreign('menus_id')->references('id')->on($this->tb_menusAd);
        });

        DB::statement("ALTER TABLE ".$this->table." comment'管理员角色信息表'");
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
