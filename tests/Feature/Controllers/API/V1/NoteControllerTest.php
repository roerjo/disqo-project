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
        $response = $this->getJson("/api/notes");

        $response->assertStatus(200);
        $response->assertJsonStructure(['notes']);
    }
}
