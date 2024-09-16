<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class DebugHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Начало отсчета времени
        $startTime = microtime(true);
        $startMemory = memory_get_usage();

        $response = $next($request);

        // Конец отсчета времени
        $endTime = microtime(true);
        $endMemory = memory_get_usage();

        // Вычисление времени выполнения и потребления памяти
        $executionTime = ($endTime - $startTime) * 1000; // в миллисекундах
        $memoryUsage = ($endMemory - $startMemory) / 1024; // в КБ

        // Добавление заголовков в ответ
        $response->headers->set('X-Debug-Time', number_format($executionTime, 2));
        $response->headers->set('X-Debug-Memory', number_format($memoryUsage, 2));

        return $response;
    }
}
