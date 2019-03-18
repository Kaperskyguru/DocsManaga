<?php

namespace App\Http\Controllers;

use Artisan;
use Illuminate\Support\Facades\Response;

class SystemController extends Controller
{
    public function postDbBackUp()
    {
        $now = \Carbon\Carbon::now()->format("Y-m-d-H-m-i") . '-backup';
        try {
            Artisan::call('snapshot:create ' . $now);
        } catch (\Exception $e) {
            return Response::json([
                'success' => false,
                'errors' => $e->getMessage(),
            ], 400);
        }
        return Response::json([
            'success' => true,
            'message' => 'success',
        ]);

    }
}
