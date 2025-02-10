<?php
/*require_once __DIR__ . '/../Repositories/UserRepository.php';
use Slim\Psr7\Response;

class AuthMiddleware {
    public function __invoke($request, $handler) {
        $userRepo = new UserRepository();
        $token = $request->getHeaderLine('Authorization');

        if (!$token) {
            $response = new Response();
            $response->getBody()->write(json_encode(['error' => 'Token ausente']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(401);
        }

        $token = str_replace('Bearer ', '', $token);
        $user = $userRepo->findByToken($token);

        if (!$user) {
            $response = new Response();
            $response->getBody()->write(json_encode(['error' => 'Token inválido']));
            return $response->withHeader('Content-Type', 'application/json')->withStatus(401);
        }

        $request = $request->withAttribute('user', $user);
        return $handler->handle($request);
    }
}*/
?>