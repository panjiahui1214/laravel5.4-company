<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersProfilesTable extends Migration
{
    protected $table = 'users_profiles';
    protected $table_users = TABLE_USERS;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->integer('id')->comment('用户id')->unsigned()->unique();
            $table->char('sex', 1)->comment('性别，M-男，F-女')->nullable();
            $table->date('birthday')->comment('生日')->nullable();
            $table->string('residence', 50)->comment('居住地')->nullable();
            $table->string('education', 10)->comment('教育程度')->nullable();
            $table->string('school', 50)->comment('就读学校')->nullable();
            $table->string('class', 20)->comment('就读班级')->nullable();
            $table->timestamps();

            $table->foreign('id')->references('id')->on($this->table_users);
        });

        DB::statement("ALTER TABLE ".$this->table." comment'会员资料表'");
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
