<?php


namespace App\Http\Resources;


final class UserResource extends BaseResource
{
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'full_name' => $this->full_name,
          'email' => $this->email,
          'phone' => $this->phone,
          'birthday' => $this->birthday,
          'address' => $this->address,
          'note' => $this->note,
        ];
    }
}
