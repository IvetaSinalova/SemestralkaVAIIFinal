<?php

namespace App;

use App\Models\User;

class Auth
{

    public static function usedEmail($email)
    {
        foreach (User::getAll() as $existingUser)
        {
            if($existingUser->getEmail() == $email)
            {
                return true;
            }

        }
        return false;
    }

    public static function login($email, $password)
    {
        foreach (User::getAll() as $existingUser)
        {
            if($email == $existingUser->getEmail() && $password== $existingUser->getPassword()){
                $_SESSION['id']=$existingUser->getId();
                return true;
            }

        }
        return false;
    }

    public static function isLogged()
    {
        return isset($_SESSION['id']);
    }

    public static function getId()
    {
        return (Auth::isLogged() ? $_SESSION['id'] : null);
    }


    public static function logout()
    {
        unset($_SESSION['id']);
        session_destroy();
    }

}