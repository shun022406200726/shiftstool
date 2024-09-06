<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id(); // シフトのID
            $table->foreignId('employee_id')->constrained()->onDelete('cascade'); // 従業員のID（外部キー）
            $table->date('day'); // シフトの開始時間
            // $table->dateTime('start_time'); // シフトの開始時間
            // $table->dateTime('end_time');   // シフトの終了時間
            $table->timestamps();           // 作成・更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
