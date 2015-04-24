<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class AdminController extends Controller {

    public function login() {
        return "Login";
    }

    public function logout() {
        return "Logout";
    }

    public function me() {
        return "me";
    }

    public function index() {
        return "index";
    }

    public function create() {
        return "create";
    }

    public function update($key) {
        return "update";
    }
}
