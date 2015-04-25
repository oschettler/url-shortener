<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
use App\Api;

class ChefkochAuthMiddleware {

    const TOKEN_HEADER = 'X-Chefkoch-Api-Token';

    /**
     * Check for a Chefkoch user with role "admin"
     * @param $token
     * @return bool
     */
    private function check($token) {
        if (!$token) {
            return false;
        }
        $response = Api::call(Api::ROOT_URL . '/me', false, [
            self::TOKEN_HEADER . ': ' . $token,
        ]);

        return $response['status'] == 'success' && $response['content']->role == 'admin';
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $this->check($request->header(self::TOKEN_HEADER))
            ? $next($request)
            : new Response("Access denied", 401);
    }

}
