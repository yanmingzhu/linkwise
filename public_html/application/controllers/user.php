<?php
require_once APPPATH . 'libraries/util.php';
class User extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function signon() {
        renderHeader($this);
        $this->load->view('signon_view');

    }

    public function create() {
        $name = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $this->load->model('User_model');
        $this->User_model->create($name, $password, $email);

        redirect("/");
    }

    public function login() {
        $name = $_POST['username'];
        $password = $_POST['password'];

        $this->load->model('User_model');
        if ($user_row = $this->User_model->authenticate($name, $password)) {
            error_log("logged in");

            setcookie("uid", $user_row->id, 0, '/');
            redirect("/");
        }
        else {
            error_log("wrong user or password: " . print_r($row, true));
            redirect("/user/signon");
        }
    }

}
