<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // التأكد من وجود دور المنظم
        $organizerRole = Role::firstOrCreate([
            'name' => 'organizer',
        ]);

        // إنشاء حساب المشرف الرئيسي
        $admin = User::firstOrCreate(
            ['email' => 'admin@eventportal.com'],
            [
                'name' => 'مشرف النظام',
                'email' => 'admin@eventportal.com',
                'phone' => '0500000000',
                'password_hash' => Hash::make('admin123'),
                'role_id' => $organizerRole->id,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // إنشاء منظم تجريبي
        $organizer = User::firstOrCreate(
            ['email' => 'organizer@example.com'],
            [
                'name' => 'منظم تجريبي',
                'email' => 'organizer@example.com',
                'phone' => '0501234567',
                'password_hash' => Hash::make('password'),
                'role_id' => $organizerRole->id,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        // التأكد من وجود دور الجمهور
        $audienceRole = Role::firstOrCreate([
            'name' => 'audience',
        ]);

        // إنشاء مستخدم جمهور تجريبي
        $audience = User::firstOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'مستخدم تجريبي',
                'email' => 'user@example.com',
                'phone' => '0509876543',
                'password_hash' => Hash::make('password'),
                'role_id' => $audienceRole->id,
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('تم إنشاء المستخدمين بنجاح:');
        $this->command->info('المشرف: admin@eventportal.com / admin123');
        $this->command->info('المنظم: organizer@example.com / password');
        $this->command->info('الجمهور: user@example.com / password');
    }
}
