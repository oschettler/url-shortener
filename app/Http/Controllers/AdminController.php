<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Api;
use App\Model\Link;

class AdminController extends Controller {

    public function login(Request $request) {
        $input = $request->only('username', 'password');
        return response()->json(
            Api::call(Api::ROOT_URL . '/authenticate', $input)
        );
    }

    public function me() {
        return response()->json(true);
    }

    public function links() {
        return response()->json(Link::all());
    }

    public function create(Request $request) {
        $input = $request->only('key', 'target');
        $link = new Link;
        $link->key = $input['key'];
        $link->target = html_entity_decode($input['target']);
        $link->save();
        return response()->json([true, $input]);
    }

    public function update(Request $request, $key) {
        $input = $request->only('key', 'target');
        $link = Link::where('key', '=', $key)->firstOrFail();
        $link->key = $input['key'];
        $link->target = html_entity_decode($input['target']);
        $link->save();
        return response()->json([true, $key, $input]);
    }
}
