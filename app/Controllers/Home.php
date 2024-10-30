<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Product;
use \Firebase\JWT\JWT;

class Home extends BaseController
{
    public function index()
    {
        return view('dashboard');
    }
    public function login()
    {
        return view('login',['status' => false, 'message' => null]);
    }
    public function loginVerif()
    {
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $userModel = new User();

        $user = $userModel->where('email', $email)->first();
        if (!$user) {
            return view('login',['status' => false, 'message' => 'Username atau Password salah']);
        }

        if (!password_verify($password, $user['password'])) {
            return view('login',['status' => false, 'message' => 'Username atau Password salah']);
        }

        $key = getenv("JWT_SECRET");

        $iat = time();
        $exp = $iat + (60*60);

        $payload = array(
            "iss" => "Issuer of the JWT",
            "aud" => "Audience that the JWT",
            "sub" => "Subject of the JWT",
            "iat" => $iat, //Time the JWT issued at
            "exp" => $exp, // Expiration time of token
            "email" => $user['email'],
        );
         
        $token = JWT::encode($payload, $key, 'HS256');
        $data = [
			'id' => $user['id'],
			'email' => $user['email'],
			'role' => $user['role'],
			'isLoggedIn' => true,
            'token' => $token
		];
		session()->set($data);
        return redirect()->to('/');
    }
    public function product()
    {
        return view('product');
    }
    public function productById($id)
    {
        $productModel = new Product();

        $product = $productModel->find($id);
        return view('productDetail',$product);
    }
    public function createproduct()
    {
        return view('productDetailNew');
    }
    public function createproductPost()
    {
        $productModel = new Product();

        $id = $this->request->getVar('id');
        $nama_produk = $this->request->getVar('nama_produk');
        $deskripsi = $this->request->getVar('deskripsi');
        $harga = $this->request->getVar('harga');
        $jumlah_stok = $this->request->getVar('stok');

        $productId = $productModel->insert([
            'nama_produk' => $nama_produk,
            'deskripsi' => $deskripsi,
            'harga' => $harga,
            'jumlah_stok' => $jumlah_stok
        ]);
        $product = $productModel->find($productId);
        return redirect()->to('/product');
    }
    public function deleteProduct($id)
    {
        $productModel = new Product();

        $productModel->delete($id);
    }
    public function productByIdPost()
    {
        $productModel = new Product();

        $id = $this->request->getVar('id');
        $nama_produk = $this->request->getVar('nama_produk');
        $deskripsi = $this->request->getVar('deskripsi');
        $harga = $this->request->getVar('harga');
        $jumlah_stok = $this->request->getVar('stok');

        $productModel->update($id,array('nama_produk' => $nama_produk, 'deskripsi' => $deskripsi, 'harga' => $harga, 'jumlah_stok' => $jumlah_stok));

        $product = $productModel->find($id);
        return view('productDetail',$product);
    }
    public function dataTables()
    {
        $db = \Config\Database::connect();
        // The library will automatically detect the CodeIgniter version you are using
        $datatables = new \Ngekoding\CodeIgniterDataTables\DataTables($db->table('product'));
        return $datatables->generate(); // done
    }
    public function logout(){
		session()->destroy();
		return redirect()->to('/login');
	}
}
