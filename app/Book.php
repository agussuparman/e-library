<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Book extends Model
{
    protected $fillable = ['author_id', 'title', 'amount', 'cover'];

    public static function boot()
    {
    	parent::boot();

    	self::updating(function($book)
    	{
    		if ($book->amount < $book->borrowed) {
    			Session::flash('flash_notification', [
    				"level" => "danger",
    				"message" => "Jumlah buku $book->title harus lebih besar atau sama dengan " . $book->borrowed
    			]);
    			return false;
    		}
    	});

    	self::deleting(function($book)
    	{
    		if ($book->borrowLogs()->count() > 0) {
    			Session::flash('flash_notification', [
    				"level" => "danger",
    				"message" => "Buku $book->title sedang dipinjam."
    			]);
    			return false;
    		}
    	});
    }

    public function author()
    {
    	return $this->belongsTo('App\Author');
    }

    public function borrowLogs()
    {
    	return $this->hasMany('App\BorrowLog');
    }

    public function getStockAttribute()
    {
    	$borrowed = $this->borrowLogs()->borrowed()->count();
    	$stock = $this->amount - $borrowed;
    	return $stock;
    }

    public function getBorrowedAttribute()
    {
    	return $this->borrowLogs()->borrowed()->count();
    }
}
