<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisesTable extends Migration
{
    protected $table = 'advertises';
    protected $tb_adsTypes = 'advertise_types';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id')->comment('唯一标识')->unsigned();
            $table->string('name', 50)->comment('名称');
            $table->integer('tpid')->comment('所属广告位种类id');
            $table->tinyInteger('sort')->comment('排序');
            $table->string('image')->comment('图片相对路径');
            $table->string('href')->comment('链接');
            $table->timestamps();

            $table->foreign('tpid')->references('id')->on($this->tb_adsTypes);
        });

        DB::statement("ALTER TABLE ".$this->table." comment'广告位信息表'");
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
