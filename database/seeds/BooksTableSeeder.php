<?php

use Illuminate\Database\Seeder;
use App\Author;
use App\Book;
use App\BorrowLog;
use App\User;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = Author::create(['name' => 'Tere Liye']);
        $author2 = Author::create(['name' => 'Marchella FP']);
        $author3 = Author::create(['name' => 'Eka Kurniawan']);

        
        $book1 = Book::create(['title' => 'Sepotong Hati Yang Baru', 'amount' => 3, 'author_id' => $author1->id]);
        $book2 = Book::create(['title' => 'Nanti Kita Cerita Tentang Hari Ini', 'amount' => 4, 'author_id' => $author2->id]);
        $book3 = Book::create(['title' => 'Perempuan Patah Hati yang Kembali Menemukan Cinta Melalui Mimpi', 'amount' => 2, 'author_id' => $author3->id]);
        $book4 = Book::create(['title' => 'Daun Yang Jatuh Tak Pernah Membenci Angin', 'amount' => 5, 'author_id' => $author1->id]);

        $member = User::where('email', 'member@gmail.com')->first();
        BorrowLog::create(['user_id' => $member->id, 'book_id' => $book1->id, 'is_returned' => 0]);
        BorrowLog::create(['user_id' => $member->id, 'book_id' => $book2->id, 'is_returned' => 0]);
        BorrowLog::create(['user_id' => $member->id, 'book_id' => $book3->id, 'is_returned' => 1]);
    }
}
