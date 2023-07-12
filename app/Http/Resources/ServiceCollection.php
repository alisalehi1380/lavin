<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceCollection extends ResourceCollection
{
   
    public function toArray($request)
    {
        return $this->collection->map(function ($item){
            return [
                'id' => $item->id,
                 'name'=>$item->name,
            ];
        });

    }
}
