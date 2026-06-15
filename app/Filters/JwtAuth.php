<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;

class JwtAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $authHeader = $request->getServer('HTTP_AUTHORIZATION');

        if (!$authHeader) {
            // Alternative fetch method for some apache environments
            $authHeader = $request->getHeaderLine('Authorization');
        }

        // Expecting format: Bearer <token>
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        } else {
            $response = service('response');
            return $response->setJSON(['message' => 'Token Required'])->setStatusCode(401);
        }

        try {
            $key = getenv('JWT_SECRET_KEY');
            // Decode the token using firebase/php-jwt (v6+ syntax)
            $decoded = JWT::decode($token, new Key($key, 'HS256'));
            
            // Optional: Pass the decoded payload data into the request object for use in controllers
            $request->decodedToken = $decoded; 

        } catch (Exception $e) {
            $response = service('response');
            return $response->setJSON([
                'message' => 'Access denied',
                'error'   => $e->getMessage()
            ])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action required after execution
    }
}