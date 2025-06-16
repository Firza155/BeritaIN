<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Nonaktifkan foreign key check sementara
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Pastikan admin tidak terhapus dengan menggunakan firstOrCreate
        $admin = User::firstOrNew(['email' => 'admin@example.com']);
        $admin->name = 'Admin';
        $admin->email = 'admin@example.com';
        $admin->password = Hash::make('admin123');
        $admin->role = 'admin';
        $admin->is_protected = true; // Pastikan admin dilindungi
        $admin->save();

        // Aktifkan kembali foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('Admin user created/updated successfully!');
    }
}
