<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DebugRequestScheme
{
    public function handle(Request $request, Closure $next)
    {
        // Foco nos cabeçalhos enviados pelo proxy e no resultado
        Log::info('DebugRequestScheme: Request Details.', [
            'url' => $request->fullUrl(),
            'method' => $request->method(),
            'scheme_detected' => $request->getScheme(), // O resultado final (http or https?)
            'isSecure_detected' => $request->isSecure(), // O resultado final (true or false?)
            'host_header' => $request->header('Host'), // O cabeçalho Host original
            'x_forwarded_proto' => $request->header('X-Forwarded-Proto'), // O proxy diz que é http ou https?
            'x_forwarded_host' => $request->header('X-Forwarded-Host'), // O proxy diz qual é o host público?
            'x_forwarded_port' => $request->header('X-Forwarded-Port'), // O proxy diz qual é a porta pública?
            'trusted_proxies' => $request->getTrustedProxies(), // Quais IPs são confiáveis? '*' significa todos.
            'is_from_trusted_proxy' => $request->isFromTrustedProxy(), // O pedido veio de um proxy confiável?
        ]);

        return $next($request);
    }
}
