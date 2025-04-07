<?php

namespace App\Http\Controllers;

use App\Classes\MainClass;
use App\Models\PlansEpargne;
use Illuminate\Http\Request;

class EpargneController extends Controller
{
    public function index()
    {
        $epargnes = PlansEpargne::where('system_client_id', MainClass::getSystemId())
            ->with('provision')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $epargnes
        ]);
    }
}
