<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     * '*' means trust all proxies
     *
     * @var array<int, string>|string|null
     */
    protected $proxies = '*'; // Confia em qualquer IP de proxy

    /**
     * The headers that should be used to detect proxies.
     * Explicitamente definindo os cabeçalhos mais importantes.
     *
     * @var int
     */
    protected $headers =
          Request::HEADER_X_FORWARDED_FOR // Para obter o IP original
        | Request::HEADER_X_FORWARDED_HOST // Para obter o Host original
        | Request::HEADER_X_FORWARDED_PORT // Para obter a Porta original
        | Request::HEADER_X_FORWARDED_PROTO // Para obter o Protocolo original (http/https)
        | Request::HEADER_X_FORWARDED_AWS_ELB; // Header extra comum em load balancers
}
