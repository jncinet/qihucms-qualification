<?php

namespace Qihucms\Qualification\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Pa extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $files = $this->files;
        if (is_array($files)) {
            foreach ($files as $key => $file) {
                $files[$key] = Storage::url($file);
            }
        }
        return [
            'user_id' => $this->user_id,
            'real_name' => $this->real_name,
            'id_card_no' => $this->id_card_no,
            'files' => $files,
            'status' => $this->status,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'updated_at' => Carbon::parse($this->updated_at)->diffForHumans(),
        ];
    }
}
