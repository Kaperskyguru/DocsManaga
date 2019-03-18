<?php
namespace App\Services\Logs;

use Illuminate\Support\Facades\Auth;

class LogProcessor
{
    public function __invoke(array $record)
    {
        $record['extra'] = [
            'user_id' => Auth::check() ? Auth::user()->id : null,
            'origin' => request()->headers->get('origin'),
            'ip' => request()->server('REMOTE_ADDR'),
            'user_agent' => request()->server('HTTP_USER_AGENT'),
        ];

        return $record;
    }
}
