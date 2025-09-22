<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // الأدوار التي نريد إضافتها
        $roles = ['organizer', 'audience'];

        foreach ($roles as $role) {
            // ينشئ الدور فقط إذا لم يكن موجودًا بالفعل
            Role::firstOrCreate(['name' => $role]);
        }
    }
}
