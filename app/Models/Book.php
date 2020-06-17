<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'code',
    ];
 
   	public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }


    public function scopeOfSearch( $query, $search, $columns )
    {
        $query->where(function($query) use ( $search, $columns ) {
            if( $search != '' ) {
                foreach($columns as $column) {   
                    $query->orWhere($column,'LIKE','%'.$search.'%');
                } 
            }   
        });
        
        return $query;
    }
}
