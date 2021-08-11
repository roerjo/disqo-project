<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
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

        if ($result->hasError()) {
            return response()->json(
                ['error' => $result->getError()],
                400
            );
        }

        return response()->json($result->getSuccess(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
