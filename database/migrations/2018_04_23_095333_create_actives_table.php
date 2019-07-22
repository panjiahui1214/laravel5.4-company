<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivesTable extends Migration
{
    protected $table = 'actives';
    protected $tb_actsThms = 'actives_themes';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id')->comment('唯一标识')->unsigned();
            $table->tinyInteger('tid')->comment('对应活动主题id')->unsigned();
            $table->string('name', 50)->comment('名称');
            $table->integer('user_num')->comment('可报人数')->unsigned()->nullable();
            $table->string('address')->comment('地址')->nullable();
            $table->text('text')->comment('介绍');
            $table->datetime('start_time')->comment('开始时间')->nullable();
            $table->datetime('end_time')->comment('结束时间')->nullable();
            $table->timestamps();

            $table->foreign('tid')->references('id')->on($this->tb_actsThms);
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
