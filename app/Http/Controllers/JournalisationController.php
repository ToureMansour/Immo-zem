<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class JournalisationController extends Controller
{
    public function index()
    {
        $logs = Log::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(50);

        return view('journalisation.index', compact('logs'));
    }

    public function show($reference)
    {
        $log = Log::with('user')
            ->where('reference', $reference)
            ->firstOrFail();

        return view('journalisation.show', compact('log'));
    }
}
