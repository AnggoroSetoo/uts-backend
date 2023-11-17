<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class CreateNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::create([
            'title' => 'Title 1',
            'author' => 'Author 1',
            'description' => 'Description 1',
            'content' => 'Content 1',
            'url' => 'Url 1',
            'url_image' => 'Url Image 1',
            'published_at' => $datenow = date('Y-m-d H:i:s'),
            'category' => 'Category 1',
        ]);

        News::create([
            'title' => 'Title 2',
            'author' => 'Author 2',
            'description' => 'Description 2',
            'content' => 'Content 2',
            'url' => 'Url 2',
            'url_image' => 'Url Image 2',
            'published_at' => $datenow = date('Y-m-d H:i:s'),
            'category' => 'Category 2',
        ]);
    }
}
