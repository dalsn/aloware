<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
    public function testCanAccessBlog()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
}
