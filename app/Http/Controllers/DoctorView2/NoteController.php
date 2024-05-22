<?php

namespace App\Http\Controllers\DoctorView2;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::with('cow')->get();

        return response()->json([
            'status' => true,
            'notes' => $notes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'note_id' => 'required|string|max:255',
            'cow_id' => 'required|exists:cows,id',
            'image' => 'nullable|string|max:2048',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->messages()], 400);
        } else {
            $notes = Note::create([
                'note_id' => $request->note_id,
                'cow_id' => $request->cow_id,
                // 'image' => $request->image,
                'title' => $request->title,
                'body' => $request->body,]);
            //  $validator['note_id'] = $this->generateUniqueId();
        }
        // Generate a unique note_id (you can use any logic you prefer)

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images');
            $validatedData['image'] = $imagePath;
        }

        if ($notes) {
            return response()->json([
                'status' => 200, 'message' => "Note created successfully"], 200);
        } else {
            return response()->json([
                'status' => 500, 'message' => "Something went wrong!"], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $notes = Note::with('cow')->findOrFail($id);
        return response()->json([
            'status' => true,
            $notes,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $notes = Note::with('cow')->findOrFail($id);
        return response()->json([
            'status' => true,
            $notes,]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [

            'note_id' => 'required|string|max:255',
            'cow_id' => 'required|exists:cows,id',
            'image' => 'nullable|string|max:2048',
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 400, 'errors' => $validator->messages()], 400);
        } else {
            $notes = Note::find($id);

            if ($notes) {
                $notes->update([
                    'note_id' => $request->note_id,
                    'cow_id' => $request->cow_id,
                    // 'image' => $request->image,
                    'title' => $request->title,
                    'body' => $request->body,]);
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('images');
                    $validatedData['image'] = $imagePath;
                }

                return response()->json([
                    'status' => 200, 'message' => "Note updated successfully"], 200);
            } else {
                return response()->json([
                    'status' => 404, 'message' => "No such Note found!"], 404);
            }

        }


    }

    public function search(Request $request)
    {

        $filter = $request->name; // Assuming $request is available in your controller method


        $note = Note::where('name', 'LIKE', "%{$filter}%")// Eager loading (optional)
        ->get();
        // Assuming $request->type holds a valid enum value (e.g., 'warehouse1')
        //$place = ActivityPlace::with('cows')->where('type', $filter)->first();

        if (!$note) {
            return response([
                'status' => false,
                'message' => 'Note not found'
            ], 404);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notes = Note::findOrFail($id);
        $notes->delete();

        return response()->json(['status' => 204, 'message' => "Deleted successfully!"], 204);


    }

    public function star(Request $request, $id)
    {
        $message = Note::findOrFail($id);


        $message->is_starred = true;
        $message->save();

        return response()->json(['message' => 'Message starred successfully', 'data' => $message], 200);
    }

    public function unstar(Request $request, $id)
    {
        $message = Note::findOrFail($id);


        $message->is_starred = false;
        $message->save();

        return response()->json(['message' => 'Message unstarred successfully', 'data' => $message], 200);
    }
}

