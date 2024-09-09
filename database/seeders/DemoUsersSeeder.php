<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class DemoUsersSeeder extends Seeder
{
    public function run()
    {
        // 管理者アカウントの作成
        User::create([
            'name' => '管理者',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 店舗の作成
        $store = Store::create([
            'name' => 'デモ店舗',
            'address' => '東京都渋谷区1-1-1',
        ]);

        // 従業員の作成
        $employee = Employee::create([
            'name' => '山田太郎',
            'email' => 'yamada@example.com',
            'store_id' => $store->id,
        ]);

        // 従業員アカウントの作成
        User::create([
            'name' => '山田太郎',
            'email' => 'employee@example.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
            'store_id' => $store->id,
            'employee_id' => $employee->id,
        ]);

    }

}
