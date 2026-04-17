<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    // test 1 : authenticated user can see note page
    public function test_authanticated_user_can_see_notes_page() : void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('notes.index'));

        $response->assertStatus(200);
    }

    // test 2 : guests can't see notes page
    public function test_guest_can_not_see_notes_page() : void
    {
        $response = $this->get(route('notes.index'));

        $response->assertRedirect(route('login'));
    }

    // test 3 : user can create a note
    public function test_user_can_create_note() : void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('notes.store'), [
            'title' => 'My first test',
            'description' => 'My note description',
            'category' => 'personal' 
        ]);

        $response->assertRedirect(route('notes.index'));

        $this->assertDatabaseHas('notes', [
            'title' => 'My first test',
            'user_id' => $user->id,
        ]);
    }
    
    // test 4 : user can not edit another user's note
    public function test_user_cannot_edit_other_user_note() : void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $note = Note::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->actingAs($user)->put(route('notes.update', $note), [
            'title' => 'update test note',
            'description' => 'update test note description',
            'category' => 'personal' 
        ]);

        $response->assertStatus(403);
    }
}
