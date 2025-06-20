<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::disableQueryLog(); // Tambahan penting
        $faker = Faker::create();

        // Insert authors
        $authors = [];
        // foreach (range(1, 1000) as $i) {
        foreach (range(1, 10) as $i) {
            $authors[] = [
                'name' => $faker->name(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('authors')->insert($authors);
        $authorIds = DB::table('authors')->pluck('id')->toArray();

        // Insert categories
        $categories = [];
        // foreach (range(1, 3000) as $j) {
        foreach (range(1, 30) as $j) {
            $categories[] = [
                'category' => $faker->words(5, true),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('categories')->insert($categories);
        $categoryIds = DB::table('categories')->pluck('id')->toArray();

        // Insert books
        $books = [];
        // foreach (range(1, 100000) as $i) {
        foreach (range(1, 10) as $i) {
            $books[] = [
                'title' => $faker->words(10, true),
                'category_id' => $faker->randomElement($categoryIds),
                'author_id' => $faker->randomElement($authorIds),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if ($i % 1000 === 0) {
                DB::table('books')->insert($books);
                $books = [];
            }
        }
        // Insert sisa terakhir jika ada
        if (!empty($books)) {
            DB::table('books')->insert($books);
        }

        // Baru ambil semua book IDs setelah selesai
        $bookIds = DB::table('books')->pluck('id')->toArray();

        // Insert ratings
        $ratings = [];
        // foreach (range(1, 500000) as $i) {
        foreach (range(1, 15) as $i) {
            $ratings[] = [
                'rating' => $faker->numberBetween(1, 10),
                'book_id' => $faker->randomElement($bookIds),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if ($i % 1000 === 0) {
                DB::table('ratings')->insert($ratings);
                $ratings = [];
            }
        }
        if (!empty($ratings)) {
            DB::table('ratings')->insert($ratings);
        }
    }
}
