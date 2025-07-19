<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Aws\S3\S3Client;

class StorageController extends Controller
{
    use AuthorizesRequests;

    public function __construct(){
        $this->middleware('auth:sanctum'); 
    }

    public function getUploadUrl(Request $request){

        $validated = $request->validate([
            'original_name' => 'required|string',
            'mime_type' => 'required|string',
        ]);

        $disk = Storage::disk('s3');

        $uniqueKey = Str::uuid()->toString();
        $ext = pathinfo($validated['original_name'], PATHINFO_EXTENSION);

        $client = new S3Client([
            'version' => 'latest',
            'region' => config('filesystems.disks.s3.region'),
            'endpoint' => 'http://localhost:9000'/*config('filesystems.disks.s3.endpoint')*/,
            'use_path_style_endpoint' => config('filesystems.disks.s3.use_path_style_endpoint', false),
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ],
        ]);

        $bucket = config('filesystems.disks.s3.bucket');
        $user_id = Auth::id();
        $key = "$user_id/$uniqueKey.$ext";

        $command = $client->getCommand('PutObject', [
            'Bucket' => $bucket,
            'Key' => $key,
            'ContentType' => $validated['mime_type'],
        ]);

        $s3_request = $client->createPresignedRequest($command, '+10 minutes');

        $url = (string) $s3_request->getUri();

        return response()->json([
            'upload_url' => $url,
            'file_path' => $key,
        ], 200);
    }

    public function download(Request $request){

    }
}
