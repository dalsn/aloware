<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function testCanRetrieveComments()
    {
        factory(Comment::class, 5)->create();

        $response = $this->json('GET', route('comments.index'));

        $response->assertStatus(200);

        $data = $response->json()['data'];
        $this->assertEquals(5, count($data));
    }

    public function testCanCreateAComment()
    {
        $comment = factory(Comment::class)->make();

        $response = $this->json('POST', route('comments.store'), $comment->toArray());
        $response->assertStatus(201);

        $comments = Comment::all();
        $this->assertCount(1, $comments);
    }

    public function testCanRetrieveAComment()
    {
        $comment = factory(Comment::class)->create();

        $response = $this->json('GET', route('comments.show', $comment->id));

        $response->assertStatus(200);

        $data = $response->json()['data'];
        
        $this->assertEquals(1, count($response->json()));
        $this->assertEquals($comment->name, $data['name']);
        $this->assertEquals($comment->body, $data['body']);
    }

    public function testCanRespondToAComment()
    {
        $this->withoutExceptionHandling();

        $parentComment = factory(Comment::class)->create();
        $comment = factory(Comment::class)->make([
            'parent_id' => $parentComment->id,
        ]);

        $response = $this->json('POST', route('comments.store'), $comment->toArray());

        $response->assertStatus(201);
        $this->assertCount(1, $parentComment->comments->toArray());
        $this->assertEquals($parentComment->comments()->first()->body, $comment->body);
    }
}
