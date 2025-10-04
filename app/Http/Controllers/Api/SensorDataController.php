<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SensorData;
use Illuminate\Http\Request;

class SensorDataController extends Controller
{
    // ambil data terakhir N record
    public function latest(Request $req)
    {
        $limit = intval($req->get('limit', 100));
        $data = SensorData::orderBy('timestamp', 'desc')
            ->limit($limit)->get()->reverse()->values();
        return response()->json($data);
    }

    // ambil data range (start/end)
    public function range(Request $req)
    {
        $start = $req->get('start'); // ISO datetime
        $end = $req->get('end');
        $q = SensorData::query();
        if ($start)
            $q->where('timestamp', '>=', $start);
        if ($end)
            $q->where('timestamp', '<=', $end);
        return response()->json($q->orderBy('timestamp')->get());
    }
}