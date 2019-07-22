<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    protected $table = 'products';

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
            $table->string('belong', 50)->comment('所属菜单id');
            $table->tinyInteger('sort')->comment('排序');
            $table->string('image')->comment('图片相对路径');
            $table->string('href')->comment('购买链接');
            $table->text('text')->comment('介绍');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE ".$this->table." comment'产品信息表'");
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
