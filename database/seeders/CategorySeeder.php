<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->delete();
        DB::statement('ALTER TABLE categories AUTO_INCREMENT = 1');

        $categories = [
            ['kode_kategori' => 1, 'name' => 'Pengumuman',    'description' => 'Surat resmi berisi pengumuman'],
            ['kode_kategori' => 2, 'name' => 'Undangan',     'description' => 'Surat undangan resmi'],
            ['kode_kategori' => 3, 'name' => 'Pemberitahuan','description' => 'Surat pemberitahuan resmi'],
            ['kode_kategori' => 4, 'name' => 'Nota Dinas',   'description' => 'Surat nota dinas resmi'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
