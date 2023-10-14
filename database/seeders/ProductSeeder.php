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
        //
        DB::table('product')->insert([
            // cú pháp: 'tên trường'=>'giá trị',
            'name'=>'Điện thoại',
            'price'=> 100,
            'image'=>'',
            'description'=>'Sản phẩm tốt',
            'quantity'=>2,
           
        ]);
    }
}
