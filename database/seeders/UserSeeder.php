<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Staff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@pos.com',
            'password' => bcrypt('password'),
        ]);

        $super_admin->assignRole('super-admin');

        $staff = User::create([
            'name' => 'Pegawai',
            'email' => 'staff@pos.com',
            'password' => bcrypt('password'),
        ]);

        Staff::create([
            'user_id' => $staff->id,
            'phone_number' => NULL
        ]);

        $staff->assignRole('staff');

        $customer = User::create([
            'name' => 'Pelanggan',
            'email' => 'customer@pos.com',
            'password' => bcrypt('password'),
        ]);

        Customer::create([
            'user_id' => $customer->id,
            'phone_number' => NULL
        ]);

        $customer->assignRole('customer');
    }
}
