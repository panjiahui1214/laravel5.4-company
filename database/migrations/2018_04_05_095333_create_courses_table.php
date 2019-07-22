<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    protected $table = 'courses';

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
            $table->integer('user_num')->comment('可报人数')->unsigned()->nullable();
            $table->string('address')->comment('上课地址')->nullable();
            $table->text('text')->comment('介绍');
            $table->datetime('start_date')->comment('开始日期')->nullable();
            $table->datetime('end_date')->comment('结束日期')->nullable();
            $table->string('keywords')->comment('关键词，用于meta标签');
            $table->string('description')->comment('课程描述，用于meta标签');
            $table->string('created_admin', 25)->comment('创建的管理员账号')->nullable();
            $table->string('updated_admin', 25)->comment('最近修改的管理员账号')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE ".$this->table." comment'课程信息表'");
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
