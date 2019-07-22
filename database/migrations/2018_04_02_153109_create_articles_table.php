<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    protected $table = 'articles';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id')->comment('唯一标识')->unsigned();
            $table->string('title', 50)->comment('标题');
            $table->string('belong', 50)->comment('所属菜单id');
            $table->string('txt')->comment('简介');
            $table->text('text')->comment('html内容');
            $table->string('cover')->comment('封面');
            $table->string('keywords')->comment('关键词，用于meta标签');
            $table->string('created_admin', 25)->comment('创建的管理员账号')->nullable();
            $table->string('updated_admin', 25)->comment('最近修改的管理员账号')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE ".$this->table." comment'文章信息表'");
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
