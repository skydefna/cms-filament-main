<?php

namespace App\Http\Controllers;

use App\Jobs\Deploy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebHookController extends Controller
{
    public function fetch(Request $request): \Illuminate\Http\JsonResponse
    {
        Log::debug('Webhook hit', $request->all());
        Deploy::dispatch();

        return response()->json([
            'message' => 'Webhook successfully hit',
        ]);
    }
}
