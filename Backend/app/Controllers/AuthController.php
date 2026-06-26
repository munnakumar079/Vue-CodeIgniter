<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

class AuthController extends ResourceController
{
   public function register()
{
    $data = $this->request->getJSON(true);

    $model = new UserModel();

    $model->save([
        'name'     => $data['name'],
        'email'    => $data['email'],
        'password' => password_hash(
            $data['password'],
            PASSWORD_DEFAULT
        )
    ]);

    return $this->respond([
        'status'  => true,
        'message' => 'User Registered Successfully'
    ]);
}

   public function login()
{
    $data = $this->request->getJSON(true);

    $email = $data['email'];
    $password = $data['password'];

    $model = new UserModel();

    $user = $model->where('email', $email)->first();

    if (!$user) {
        return $this->respond([
            'status' => false,
            'message' => 'Email not found'
        ], 401);
    }

    if (!password_verify($password, $user['password'])) {
        return $this->respond([
            'status' => false,
            'message' => 'Invalid Password'
        ], 401);
    }

    $payload = [
        'iss' => 'localhost',
        'iat' => time(),
        'exp' => time() + 86400,
        'uid' => $user['id'],
        'email' => $user['email']
    ];

    $token = JWT::encode(
        $payload,
        getenv('JWT_SECRET'),
        'HS256'
    );

    return $this->respond([
        'status' => true,
        'token' => $token,
        'user' => $user
    ]);
}
}