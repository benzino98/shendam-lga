<?php

namespace App\Http\Middleware;

use App\Models\ActivityLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogAdminActivity
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \Symfony\Component\HttpFoundation\Response $response */
        $response = $next($request);

        // Only log state-changing requests
        if (!in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'], true)) {
            return $response;
        }

        // Avoid logging the log viewers themselves to prevent noise/loops
        $routeName = optional($request->route())->getName();
        if (is_string($routeName) && (str_starts_with($routeName, 'admin.activity-logs') || str_starts_with($routeName, 'admin.access-logs'))) {
            return $response;
        }

        // Only log successful-ish actions
        if ($response->getStatusCode() >= 400) {
            return $response;
        }

        $action = $routeName ?: ($request->method() . ' ' . $request->path());

        // Try to capture model info from route parameters (resource routes)
        $modelType = null;
        $modelId = null;
        $params = (array) optional($request->route())->parameters();
        foreach ($params as $param) {
            if (is_object($param) && method_exists($param, 'getMorphClass') && method_exists($param, 'getKey')) {
                $modelType = $param->getMorphClass();
                $modelId = $param->getKey();
                break;
            }
        }

        ActivityLog::create([
            'user_id' => optional($request->user())->id,
            'action' => $action,
            'model_type' => $modelType,
            'model_id' => $modelId,
            'description' => sprintf('%s %s', $request->method(), $request->fullUrl()),
            'log_level' => 'info',
            'ip_address' => $request->ip(),
            'user_agent' => (string) $request->userAgent(),
        ]);

        return $response;
    }
}

