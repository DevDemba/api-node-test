<?php

namespace App\Controller;

use E_motion\Component\HttpIce\Request;
use E_motion\Component\HttpIce\Response;
use E_motion\Component\HttpIce\Session\SessionInterface;

class HomeController
{
    public function index(Request $request, SessionInterface $session): Response
    {
        return new Response('<h1>Hello everyone !</h1>');
    }
}
