<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'original_name' => $this->original_name,
            'custom_name' => $this->custom_name,
            'mime_type' => $this->mime_type,
            'size' => $this->size,
            's3_key' => $this->s3_key,
            'is_public' => $this->is_public,
            'scanned_status' => $this->scanned_status,
            'scanned_at' => $this->scanned_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
