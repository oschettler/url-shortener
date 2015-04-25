<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Api;
use App\Http\Middleware\ChefkochAuthMiddleware;

class AdminController extends Controller {

    const TOKEN_HEADER = 'X-Chefkoch-Api-Token';

    public function login(Request $request) {
        $input = $request->only('username', 'password');
        return response()->json(
            Api::call(Api::ROOT_URL . '/authenticate', $input)
        );
    }

    public function logout() {
        return "Logout";
    }

    public function me(Request $request) {
        return response(json_encode(true));
    }

    public function links() {
        return "list";
    }

    public function create() {
        return "create";
    }

    public function update($key) {
        return "update";
    }
}
