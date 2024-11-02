<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Sales;
use App\Models\Products;
use App\Models\Customers;
use App\Models\Suppliers;
use App\Models\Audit_logs;
use App\Models\Categories;
use App\Models\Sale_items;
use App\Models\Transactions;
use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Categories::factory(10)->create();
        Customers::factory(250)->create();
        $suppliers = Suppliers::factory(10)->create();
        $products = Products::factory(250)->create();
        Sales::factory(250)->create();
        Sale_items::factory(250)->create();
        Transactions::factory(250)->create();
        Audit_logs::factory(250)->create();

        foreach ($suppliers as $supplier) {
            $supplier->products()->syncWithoutDetaching(
                $products->random(rand(1,250))->pluck('id')->toArray()
            );
        }
    }
}
