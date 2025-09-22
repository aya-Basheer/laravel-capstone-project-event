<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizerRole = Role::where('name', 'organizer')->first();
        $audienceRole = Role::where('name', 'audience')->first();

        // Create admin organizer
   User::firstOrCreate(
    ['email' => 'organizer@example.com'], // إذا موجود لن ينشئ جديد
    [
        'name' => 'منظم رئيسي',
        'password_hash' => bcrypt('password'),
        'role_id' => 1,
        'phone' => '+966501234567',
    ]
);
        // Create test audience user
   User::firstOrCreate(
    ['email' => 'audience@example.com'], // يتأكد إذا موجود لا ينشئ جديد
    [
        'name' => 'مستخدم تجريبي',
        'password_hash' => bcrypt('password'),
        'role_id' => 2,
        'phone' => '+966507654321',
    ]
);
        // Create additional organizers
    User::firstOrCreate(
    ['email' => 'ahmed@example.com'], // إذا موجود لن ينشئ جديد
    [
        'name' => 'أحمد محمد',
        'password_hash' => bcrypt('password'),
        'role_id' => 1,
        'phone' => '+966501111111',
    ]
);


User::firstOrCreate(
    ['email' => 'fatima@example.com'], // هذا هو الحقل الذي يتحقق منه
    [
        'name' => 'فاطمة علي',
        'password_hash' => Hash::make('password'),
        'role_id' => $organizerRole->id,
        'phone' => '+966502222222',
    ]
);

        // Create additional audience users
        $audienceUsers = [
            ['name' => 'سارة أحمد', 'email' => 'sara@example.com'],
            ['name' => 'محمد عبدالله', 'email' => 'mohammed@example.com'],
            ['name' => 'نورا خالد', 'email' => 'nora@example.com'],
            ['name' => 'عبدالرحمن سعد', 'email' => 'abdulrahman@example.com'],
            ['name' => 'ريم فهد', 'email' => 'reem@example.com'],
            ['name' => 'يوسف عمر', 'email' => 'youssef@example.com'],
            ['name' => 'هند ناصر', 'email' => 'hind@example.com'],
            ['name' => 'خالد إبراهيم', 'email' => 'khalid@example.com'],
            ['name' => 'لينا حسن', 'email' => 'lina@example.com'],
            ['name' => 'عمر طارق', 'email' => 'omar@example.com'],
        ];

        foreach ($audienceUsers as $index => $userData) {
          User::firstOrCreate([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password_hash' => Hash::make('password'),
                'role_id' => $audienceRole->id,
                'phone' => '+96650'.str_pad($index + 3, 7, '0', STR_PAD_LEFT),
            ]);
        }
    }
}
