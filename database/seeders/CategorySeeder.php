<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category')->insert([
            'Name'=>'Áo Fpoly',
        ]);
        DB::table('category')->insert([
            'Name'=>'Áo Fpoly2',
        ]);
        DB::table('category')->insert([
            'Name'=>'Áo Fpoly3',
        ]);
        DB::table('category')->insert([
            'Name'=>'Áo Fpoly4',
        ]);
        DB::table('category')->insert([
            'Name'=>'Áo Fpoly5',
        ]);

    }
}
