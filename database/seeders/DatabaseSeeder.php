<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AccountCategory;
use App\Models\AccountRole;
use App\Models\AccountType;
use App\Models\Customer;
use App\Models\CustomerAddress;
use App\Models\CustomerBankAccount;
use App\Models\CustomerNok;
use App\Models\SavingsPlan;
use App\Models\SavingsPlanCategory;
use App\Models\Staff;
use App\Models\Transaction;
use App\Models\TransactionType;
use App\Models\User;
use App\Models\Zone;
use App\Models\CustomerSavingsPlan;
use Illuminate\Database\Seeder;
use Database\Factories\ZoneFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //dump(class_exists(ZoneFactory::class)); // Check if ZoneFactory class exists

        //SavingsPlan::factory()->count(10)->create();
        //SavingsPlanCategory::factory()->count(10)->create();
        //User::factory()->count(10)->create();
        //Staff::factory()->count(10)->create();
        //Customer::factory()->count(10)->create();
        //CustomerAddress::factory()->count(10)->create();
        //CustomerNok::factory()->count(10)->create();
        //CustomerBankAccount::factory()->count(10)->create();
        //CustomerSavingsPlan::factory()->count(10)->create();
        Transaction::factory()->count(10)->create();
        // AccountCategory::factory()->count(10)->create();
        // AccountRole::factory()->count(10)->create();
        // AccountType::factory()->count(10)->create();  
        //TransactionType::factory()->count(10)->create();
        //Zone::factory()->count(10)->create();

    }
}
