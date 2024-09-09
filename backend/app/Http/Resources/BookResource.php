<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'publishYear' => $this->publishYear,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            //Include the route for the book details in the response

        ];
    }
}
