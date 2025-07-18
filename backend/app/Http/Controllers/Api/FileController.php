<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Resources\FileResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    use AuthorizesRequests;

    public function __construct(){
        $this->middleware('auth:sanctum'); 
        $this->authorizeResource(File::class, 'file');
    }
    public function index()
    {

        // Array of all files of the user
        /*$files = [];

        foreach(File::where('user_id', Auth()->id())->get() as $file){
            
            $files[] = [
                'id' => $file->id,
                'original_name' => $file->original_name,
                'custom_name' => $file->custom_name,
                'mime_type' => $file->mime_type,
                'size' => $file->size,
                'is_public' => $file->is_public,
                'scanned_status' => $file->scanned_status,
                'scanned_at' => $file->scanned_at,
                'created_at' => $file->created_at,
                'updated_at' => $file->updated_at
            ];

        }

        return response()->json($files);*/

        $files = File::where('user_id', Auth()->id())->get();

        return FileResource::collection($files);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        return new FileResource($file);
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
