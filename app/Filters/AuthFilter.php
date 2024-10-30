<?php 
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $argument = null)
    {
        if(session()->get('token')){
            if(in_array("product",$request->getUri()->getSegments())){
                if(session()->get('role') != 'admin'){
                    return redirect()->to('/');
                }
            }
          }else{
            return redirect()->to('/login');
          }
        // Do something here
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $argument = null)
    {
        // Do something here
    }
}