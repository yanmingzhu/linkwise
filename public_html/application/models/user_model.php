<?php

class User_model extends CI_Model {

    var $title   = '';
    var $content = '';
    var $date    = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    static function get_name_by_id($id)
    {
        if (is_null($id)) return "nobody";
        
        $query = get_instance()->db->query("select name from User where id = $id");
        if ($query->num_rows() != 1) {
            return null;
        }
        else return $query->row()->name;
    }

    function create($name, $password, $email)
    {
        $salt = $this->make_salt();
        $hash_password = hash_hmac("sha256", $password, $salt);
        $sql = "insert into User (name, email, password, salt ) values ('$name', '$email', '$hash_password', '$salt')";
        $query = $this->db->query($sql);
    }

    function authenticate($name, $password)
    {
        $query = $this->db->query("select * from User where name = '$name' and oauth_provider is NULL");

        if ($query->num_rows() != 1) {
            return null;
        }
        else {
            $row = $query->row();

      //      error_log("row = " . print_r($row, true) . " " . hash_hmac("sha256", $password, $row->salt) . " - done");
            if ($row->password == hash_hmac("sha256", $password, $row->salt)) {
                return $row;
            }
            else return null;
        }
    }

    private function rand_string( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen( $chars );
        $str = "";
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[rand( 0, $size - 1 )];
        }
        return $str;
    }

    private function make_salt() {
        return $this->rand_string(20);
    }
}
