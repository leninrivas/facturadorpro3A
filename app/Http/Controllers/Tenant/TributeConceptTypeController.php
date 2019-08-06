<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenant\Catalogs\AttributeType;
use App\Http\Resources\Tenant\TributeConceptTypeResource;
use App\Http\Resources\Tenant\TributeConceptTypeCollection;
use App\Http\Requests\Tenant\TributeConceptTypeRequest;

class TributeConceptTypeController extends Controller
{
    public function records()
    { 
        $records = new TributeConceptTypeCollection(AttributeType::all());

        return $records;
    }

    public function record($id)
    {
        $record = new TributeConceptTypeResource(AttributeType::findOrFail($id));

        return $record;
    } 

    public function store(TributeConceptTypeRequest $request)
    {
        $id = $request->input('id');
        $tribute_concept_type = AttributeType::firstOrNew(['id' => $id]);
        $tribute_concept_type->fill($request->all());
        $tribute_concept_type->save();

        return [
            'success' => true,
            'message' => ($id) ? 'Atributo editado con éxito':'Atributo registrado con éxito'
        ];
    }



    public function destroy($id)
    {
        $record = AttributeType::findOrFail($id);
        //$record->delete();
        $record->active = 0;
        $record->save();

        return [
            'success' => true,
            'message' => 'Atributo eliminado con éxito'
        ];
    }
}
