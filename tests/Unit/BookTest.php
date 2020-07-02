<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;  

class BookTest extends TestCase
{
    /** @test */
    public function it_can_create_book() {

    	$books = factory( 'App\Models\Book', 2 )->create(); 
    }
 
}


