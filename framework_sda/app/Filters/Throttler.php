<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Throttler implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $throttler = service('throttler');
        // Restrict an IP address to no more than 1 request
        // per second across the entire site.
        if ($throttler->check(md5($request->getIPAddress()), 20, MINUTE) === false) {
            return service('response')->setStatusCode(429, "To Many Request");
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}