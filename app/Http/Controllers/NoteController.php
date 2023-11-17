<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class NoteController extends Controller
{

    public function destroy(Note $note)
    {
        if (!Gate::allows('change-note', $note)){
            abort(Response::HTTP_FORBIDDEN);
        }

        $note->delete();

        return back()->with('success', 'Your note has been deleted.');
    }

    public function edit(Note $note)
    {
        if (!Gate::allows('change-note', $note)){
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('notes.edit', ['note' => $note]);
    }



    public function favorite(Note $note)
    {
        if (!Gate::allows('change-note', $note)){
            abort(Response::HTTP_FORBIDDEN);
        }

        if ($note->favorite == true)
        {
            $note->update(['favorite' => 0]);
        }
        elseif ($note->favorite == false)
        {
            $note->update(['favorite' => 1]);
        }

        return back()->with('success', 'favorite updated');
    }

    public function update(Note $note)
    {

        if (!Gate::allows('change-note', $note)){
            abort(Response::HTTP_FORBIDDEN);
        }

        $attributes = request()->validate([
            'title' => 'required|max:200',
            'content' => 'required|min:2|max:255'
        ]);

        $note->update($attributes);

        return back()->with('success', 'Saved');

    }

    public function show(Note $note)
    {
        if (!Gate::allows('change-note', $note)){
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('notes.show', ['note' => $note]);

    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required|max:200',
            'content' => 'required|min:2|max:255'
        ]);



        auth()
            ->user()
            ->notes()
            ->create($attributes);


        return back()->with('success', 'Saved');

    }





}
