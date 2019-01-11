<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HelloTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHelloWorld()
    {
        $this->assertTrue(true);
        $this->assertFalse(false);
        $this->assertNotEmpty(['hello']);
        $this->assertEquals(true, true);
    }
}
