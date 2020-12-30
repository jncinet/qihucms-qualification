<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationPasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualification_pas', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary()->comment('会员ID');
            $table->string('real_name')->comment('真实姓名');
            $table->string('id_card_no')->comment('身份证号');
            $table->json('files')->nullable()->comment('证明文件');
            $table->boolean('status')->default(0)->comment('状态');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('qualification_pas');
    }
}
