<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model; 

class Author extends Model
{ 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
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
