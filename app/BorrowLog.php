<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BorrowLog extends Model
{
    protected $fillable = ['user_id', 'book_id', 'is_returned'];
    protected $casts = ['is_returned' => 'boolean'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function book()
    {
    	return $this->belongsTo('App\Book');
    }

    public function scopeReturned($query)
    {
    	return $query->where('is_returned', 1);
    }

    public function scopeBorrowed($query)
    {
    	return $query->where('is_returned', 0);
    }
}
