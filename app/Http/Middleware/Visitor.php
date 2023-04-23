<?php

namespace App\Http\Middleware;

use App\Models\Visitor as VisitorModel;
use Closure;
use Illuminate\Http\Request;

class Visitor
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->source) {
            $this->saveVisitor($request);
        }

        return $next($request);
    }

    private function saveVisitor($request)
    {
        $visitor = new VisitorModel;
        $visitor->source = $request->source;
        $visitor->ip = $request->ip();
        $visitor->user_agent = $request->userAgent();
        $visitor->save();
    }
}
