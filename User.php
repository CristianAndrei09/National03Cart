<?php

class User extends BaseClass
{
    public $username;
    public $password;
    public $email;
    public $phone;

    public static function getTable(){
        return 'users';
    }
}