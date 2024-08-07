<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tb_peta;
use App\Http\Resources\Peta as PetaResource;
use Illuminate\Http\Request;

class TbPetaController extends Controller
{
    public function index(Request $request)
    {
        $petas = Tb_peta::all();

        $geoJSONdata = $petas->map(function ($peta) {
            return [
                'type'       => 'Feature',
                'properties' => new PetaResource($peta),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $peta->longitude,
                        $peta->latitude,
                    ],
                ],
            ];
        });

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }
}
