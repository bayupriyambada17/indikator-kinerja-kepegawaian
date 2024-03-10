<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LihatCapaianRestraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'indikator_id' => $this->indikator_id,
            'unit_name' => $this->unit_name,
            'faculty_targets' => $this->faculty_targets,
            'fill_target' => $this->fill_target,
            'capaianRetraUpload' => $this->capaianRetraUpload,
            'isiCapaian' => $this->isiCapaian->comment,
        ];
    }
}
