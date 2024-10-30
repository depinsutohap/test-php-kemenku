<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenFilter implements FilterInterface
{
    public function before(RequestInterface $request, $argument = null)
    {
        if(!$request->hasHeader('Authorization')){
            $key = getenv("JWT_SECRET");
            $jwt = $request->header('Authorization')->getValue();
            $decoded = JWT::decode($jwt,new Key($key, 'HS256'));
            if(!session()->get('token') && !$decoded->role == 'admin'){
                        return redirect()->to('/');
              }
        }
        // Do something here
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $argument = null)
    {
        // Do something here
    }
}