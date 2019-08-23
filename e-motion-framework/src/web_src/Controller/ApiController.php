<?php

namespace App\Controller;

use E_motion\Component\HttpIce\Response;

class ApiController
{
    public function test(): Response
    {
        $a = file_get_contents('http://127.0.0.1:3000/api/users');
        var_dump(json_decode($a));
        return new Response('API');
    }
}
