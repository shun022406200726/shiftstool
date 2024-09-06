<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->enum('role', ['admin', 'employee'])->default('employee');
        $table->foreignId('store_id')->nullable()->constrained('stores');
        $table->foreignId('employee_id')->nullable()->constrained('employees');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
        $table->dropForeign(['store_id']);
        $table->dropColumn('store_id');
        $table->dropForeign(['employee_id']);
        $table->dropColumn('employee_id');
    });
}
};
