<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Sales;
use App\Models\Products;
use App\Models\Customers;
use App\Models\Suppliers;
use App\Models\AuditLogs;
use App\Models\Categories;
use App\Models\SaleItems;
use App\Models\Transactions;
use App\Models\ProductGalleries;
use App\Models\Purchases;
use App\Models\PurchaseDetails;
use App\Models\Expenditures;
use App\Models\Settings;
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
        Categories::factory(3)->create();
        Customers::factory(250)->create();
        $suppliers = Suppliers::factory(10)->create();
        $products = Products::factory(250)->create();
        Sales::factory(250)->create();
        SaleItems::factory(250)->create();
        AuditLogs::factory(250)->create();
        ProductGalleries::factory(250)->create();
        Purchases::factory(250)->create();
        PurchaseDetails::factory(250)->create();
        Expenditures::factory(250)->create();
        Settings::factory(1)->create();

        foreach ($suppliers as $supplier) {
            $supplier->products()->syncWithoutDetaching(
                $products->random(rand(1,100))->pluck('id')->toArray()
            );
        }
    }
}
