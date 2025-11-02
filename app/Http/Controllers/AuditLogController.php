<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index() {
        $user = auth()->user();
        if($user->role !== 'admin') {
            abort(403, 'Unauthorized access.');
        }

        $logs = AuditLog::with('user')->latest()->paginate(10);
        return view('audit_logs.index', compact('logs'));
    }
}
