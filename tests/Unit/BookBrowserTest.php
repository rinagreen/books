<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class BookBrowserTest extends BaseTestCase
{
	/** @test */
	public function visit_home_page()
	{
	    $this->visit('/')
	         ->click('Books')
	         ->seePageIs('/books');

	    $this->visit('/')
	         ->click('Authors')
	         ->seePageIs('/authors');         
	}

}
