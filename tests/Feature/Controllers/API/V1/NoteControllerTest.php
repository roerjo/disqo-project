<?php

namespace Tests\Feature\Controllers\API\V1;

use App\Models\{Note, User};
use Illuminate\Foundation\Testing\{RefreshDatabase, WithFaker};
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class NoteControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Setup each test.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
            ->has(Note::factory()->count(1), 'notes')    
            ->create();

        Sanctum::actingAs($this->user);
    }

    /**
     * @test
     * @see \App\Http\Controllers\API\V1\NoteController
     */
    public function index_returns_all_user_notes()
    {
        $response = $this->getJson('/api/notes');

        $response->assertStatus(200);
        $response->assertJsonStructure(['notes']);
    }

    /**
     * @test
     * @see \App\Http\Controllers\API\V1\NoteController
     */
    public function store_creates_a_new_note()
    {
        $title = $this->faker->words(3, true);
        $noteBody = $this->faker->paragraph();

        $response = $this->postJson('/api/notes', [
            'title' => $title,
            'note' => $noteBody,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure(['note']);

        $this->assertDatabaseHas('notes', [
            'user_id' => $this->user->id,
            'title' => $title,
            'note' => $noteBody,
        ]);
    }

    /**
     * @test
     * @see \App\Http\Controllers\API\V1\NoteController
     */
    public function show_returns_requested_note()
    {
        $noteId = Note::first()->id;

        $response = $this->getJson("/api/notes/{$noteId}");

        $response->assertStatus(200);
        $response->assertJsonStructure(['note']);
    }

    /**
     * @test
     * @see \App\Http\Controllers\API\V1\NoteController
     */
    public function updating_note_is_successful()
    {
        $note = Note::first();

        $response = $this->putJson("/api/notes/{$note->id}", [
            'title' => 'Wacky new title!',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure(['note']);

        $this->assertDatabaseHas('notes', [
            'user_id' => $this->user->id,
            'title' => 'Wacky new title!',
            'note' => $note->note,
        ]);
    }

    /**
     * @test
     * @see \App\Http\Controllers\API\V1\NoteController
     */
    public function deleting_note_is_successful()
    {
        $note = Note::first();

        $response = $this->deleteJson("/api/notes/{$note->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('notes', [
            'id' => $note->id,
        ]);
    }
}
