<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisesTypesTable extends Migration
{
    protected $table = 'advertises_types';

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
            $table->integer('height')->comment('图片高度')->unsigned();
            $table->integer('width')->comment('图片宽度')->unsigned();
            $table->string('description', 50)->comment('简要描述');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE ".$this->table." comment'广告位种类信息表'");
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
