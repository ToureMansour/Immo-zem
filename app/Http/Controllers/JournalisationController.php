<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class JournalisationController extends Controller
{
    public function index(Request $request)
    {
        $query = Log::with('user')->orderBy('created_at', 'desc');

        // Filtrer par recherche (nom, email, action)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('action', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('name', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Filtrer par action
        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        // Filtrer par date début
        if ($request->filled('date_debut')) {
            $query->whereDate('created_at', '>=', $request->date_debut);
        }

        // Filtrer par date fin
        if ($request->filled('date_fin')) {
            $query->whereDate('created_at', '<=', $request->date_fin);
        }

        $logs = $query->paginate(6);

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
