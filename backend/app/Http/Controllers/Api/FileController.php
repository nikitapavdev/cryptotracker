<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\FileResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Aws\S3\S3Client;

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
        $files = File::where('user_id', Auth()->id())->get();

        return FileResource::collection($files);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'original_name' => 'required|string',
            'custom_name' => 'required|string',
            's3_key' => 'required|string',
            'mime_type' => 'required|string',
            'size' => 'required',
        ]);
        $s3_folder = explode('/', $validated['s3_key']);

        if((int)$s3_folder[0] != Auth()->id()){
            return response()->json([
                'message' => 'No permission'
            ], 403);
        }

        if(!Storage::disk('s3')->exists($validated['s3_key'])){
            return response()->json([
                'message' => 'File not found in storage'
            ], 404);
        }
        if(File::where('s3_key', $validated['s3_key'])->first() === null){
            File::create([
                ...$validated,
                'user_id' => Auth()->id(),
                'is_public' => false
            ]);
            return response()->json([
                'message' => "File created successfuly"
            ], 201);
        }
        return response()->json([
            "message" => "File already exists"
        ], 409);

        

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
