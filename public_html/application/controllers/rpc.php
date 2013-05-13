<?php
require_once APPPATH . 'libraries/util.php';

class Rpc extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
    }

    public function subscribe() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo "error method";
            return;
        }
        
        $uid = get_uid();
        if (!$uid) {
            echo "not logged in";
            return;
        }

        if (!array_key_exists('eid', $_POST)) {
            echo "error: no event selected";
            return;
        }

        $eid = $_POST['eid'];

        if ($this->Subscription_model->insert($uid, $eid)) {
            echo "ok";
        }
        else echo "error inserting";
    }

    public function unsubscribe() {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            echo "error method";
            return;
        }

        $uid = get_uid();
        if (!$uid) {
            echo "not logged in";
            return;
        }

        if (!array_key_exists('eid', $_POST)) {
            echo "error: no event selected";
            return;
        }

        $eid = $_POST['eid'];


        if ($this->Subscription_model->delete($uid, $eid)) {
            echo "ok";
        }
        else echo "error deleting";
    }}