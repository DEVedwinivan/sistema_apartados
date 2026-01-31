<?php
class AuthController {
    // private AuthModel $auth;
    public function __construct() {
    //     $db = db::dbConnect();
    // $this->auth = new AuthModel(db::dbConnect());
    }
    public function showLogin(){
        Views::render('auth/login');

    }
}
?>