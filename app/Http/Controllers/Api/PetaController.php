<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\peta as PetaResource;
use App\Models\Tb_peta;

class OutletController extends Controller
{
    /**
     * Get outlet listing on Leaflet JS geoJSON data structure.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\JsonResponse
     */
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
