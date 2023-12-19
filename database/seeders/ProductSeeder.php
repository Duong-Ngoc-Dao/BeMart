<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product')->insert([
            'Name'=>'Iphone 11 Pro Max',
            'Price'=>'10.000.000',
            'image'=>'',
            'Description'=>'Sản phẩm hoàn hảo',
            'Quantity'=>11,
            'Category'=>1
        ]);
        DB::table('product')->insert([
            'Name'=>'Iphone 12 Pro Max',
            'Price'=>'10.000.000',
            'image'=>'',
            'Description'=>'Sản phẩm hoàn hảo',
            'Quantity'=>10,
            'Category'=>2
        ]);
        DB::table('product')->insert([
            'Name'=>'Iphone 13 Pro Max',
            'Price'=>'10.000.000',
            'image'=>'',
            'Description'=>'Sản phẩm hoàn hảo',
            'Quantity'=>14,
            'Category'=>3
        ]);
        DB::table('product')->insert([
            'Name'=>'Iphone 14 Pro Max',
            'Price'=>'1.000.000',
            'image'=>'',
            'Description'=>'Sản phẩm hoàn hảo',
            'Quantity'=>16,
            'Category'=>4
        ]);
        DB::table('product')->insert([
            'Name'=>'Iphone 15 Pro Max',
            'Price'=>'1.000.000',
            'image'=>'',
            'Description'=>'Sản phẩm hoàn hảo',
            'Quantity'=>19,
            'Category'=>5
        ]);
    }
}
