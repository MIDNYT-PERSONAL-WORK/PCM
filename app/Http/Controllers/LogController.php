<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    //
    public static function log(
        string $activity, 
        string $status = 'success', 
        $details = null,
        ?int $user_id = null,
        ?string $ip_address = null
    ) 
    {
        // Convert details to JSON if it's an array or object
        $detailsJson = null;
        if (!is_null($details)) {
            $detailsJson = is_array($details) || is_object($details) 
                ? json_encode($details) 
                : $details;
        }

        return Log::create([
            'user_id' => $user_id ?? auth()->id(),
            'activity' => $activity,
            'ip_address' => $ip_address ?? request()->ip(),
            'status' => $status,
            'details' => $detailsJson,
        ]);
    }
}
