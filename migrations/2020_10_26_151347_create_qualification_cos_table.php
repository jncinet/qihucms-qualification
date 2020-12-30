<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQualificationCosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qualification_cos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->index()->comment('会员ID');
            $table->string('company_name')->comment('公司名称');
            $table->string('company_id')->comment('统一信用代码');
            $table->json('files')->nullable()->comment('证明文件');
            $table->string('contacts')->comment('联系人');
            $table->string('mobile')->comment('联系人手机号');
            $table->string('email')->nullable()->comment('联系人邮箱');
            $table->string('address')->nullable()->comment('地址');
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
        Schema::dropIfExists('qualification_cos');
    }
}
