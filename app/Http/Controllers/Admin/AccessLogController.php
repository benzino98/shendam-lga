<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccessLog;
use Illuminate\Http\Request;

class AccessLogController extends Controller
{
    /**
     * Display a listing of access logs.
     */
    public function index()
    {
        $logs = AccessLog::with('user')->latest()->paginate(50);
        return view('admin.access-logs.index', compact('logs'));
    }
}
