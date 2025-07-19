<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Aws\S3\S3Client;
use Carbon\Carbon;

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

        $client = $this->getClient();    

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

    public function download(Request $request, $id, $s3_key){
        $s3_key = $id.'/'.$s3_key;

        $client = $this->getClient();

        $bucket = config('filesystems.disks.s3.bucket');
        $expiration = Carbon::now()->addMinutes(10); // Срок действия URL

        // authorization

        if((int)$id != Auth()->id()){
            return response()->json([
                'message' => 'No permission'
            ], 403);
        }

        // Check if file exists
        if (!Storage::disk('s3')->exists($s3_key)){
            return response()->json([
                'message' => 'File not found'
            ], 404);
        }

        // Creating a command for GetObject
        $command = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $s3_key,
        ]);

        // Генерация предподписанной URL
        $presignedUrl = (string) $client->createPresignedRequest($command, $expiration)->getUri();

        return response()->json([
            'presignedUrl' => $presignedUrl,
            's3_key' => $s3_key,
        ], 200);

    }

    protected function getClient(){

        /*
         * For production
         */

        //return Storage::disk('s3')->getClient();

        return new S3Client([
            'version' => 'latest',
            'region' => config('filesystems.disks.s3.region'),
            'endpoint' => config('filesystems.disks.s3.url'),
            'use_path_style_endpoint' => config('filesystems.disks.s3.use_path_style_endpoint', false),
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ],
        ]);
    } 

}
