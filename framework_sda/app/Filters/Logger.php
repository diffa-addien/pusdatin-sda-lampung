<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Logger implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //FOR Maintenance
        if (getenv("REMOTE_ADDR") != "114.79.6.73") {
            echo "<div style='position:fixed; padding: 5px; bottom:5px; left:5px; border: 3px solid #73AD21;z-index:99'>";
            echo "Maintanance MODE: " . getenv("REMOTE_ADDR");
            echo "</div>";
        } else {
            echo "Server sedang dalam maintenance...";
            die;
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
        helper('filesystem');
        if (session()->get('username')) {
            $user = session()->get('username');
            $route = implode('/', $request->uri->getSegments());
            $from = $_SERVER['HTTP_REFERER'];
            $method = $request->getMethod();
            $ip = getenv("REMOTE_ADDR");

            $text = "$user ($method) /$route from $from (IP: $ip)";

            log_message('info', $text);
        }

    }
}
