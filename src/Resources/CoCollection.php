<?php

namespace Qihucms\Qualification\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CoCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
