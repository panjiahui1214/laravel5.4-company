<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration
{
    protected $table = 'company';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id')->comment('唯一标识')->unsigned();
            $table->string('ename', 20)->comment('英文简写，方便后端读取');
            $table->string('name', 50)->comment('中文名称，用于后台显示');
            $table->string('value', 50)->comment('值');
            $table->string('image')->comment('图片相对路径')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE ".$this->table." comment'公司信息表'");
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
