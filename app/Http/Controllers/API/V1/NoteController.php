<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\StoreNoteRequest;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\{JsonResponse, Request};

class NoteController extends Controller
{
    /**
     * Service class to handle notes
     */
    private NoteService $noteService;

    /**
     * Setup the controller.
     *
     * @param  \App\Services\NoteService  $noteService
     * @return void
     */
    public function __construct(NoteService $noteService)
    {
       $this->noteService = $noteService; 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $result = $this->noteService->getNotes(request()->user());

        return $this->buildResponse(200, $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\API\V1\StoreNoteRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreNoteRequest $request): JsonResponse
    {
        $result = $this->noteService->createNote(
            request()->user(), 
            $request->validated()
        );

        return $this->buildResponse(201, $result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        //
    }
}
