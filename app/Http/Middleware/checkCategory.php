<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Category;

class checkCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $count = Category::all()->count();
        if ($count == 0) {
            session()->flash('error', 'Sorry you have create category');
            return redirect(route('categories.index'));
        }
        return $next($request);
    }
}
