<?php

namespace Database\Seeders;

use App\Models\BankAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BankAccount::create([
            'account_number' => '0971236182',
            'bank_name' => 'BCA',
            'account_holder_name' => 'Ahmad Fatoni'
        ]);

        BankAccount::create([
            'account_number' => '09798172398612',
            'bank_name' => 'BRI',
            'account_holder_name' => 'Ahmad Fatoni'
        ]);

        BankAccount::create([
            'account_number' => '123102731872',
            'bank_name' => 'BNI',
            'account_holder_name' => 'Ahmad Fatoni'
        ]);
    }
}
