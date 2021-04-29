<?php


namespace App\Http\Resources;


final class ClientResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
        ];
    }
}
