<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageGenerateText()
    {
        $response = $this->get('/');

        $response->assertSeeText('Welcome in laravel');
    }

    public function testContactPageWorkingCorrectly()
    {
        $response = $this->get('/contact');

        $response->assertSeeText('contct');
    }
}
