<?php

namespace App\Controllers;

use App\Auth;
use App\Config\Configuration;
use App\Models\User;

class AuthController extends AControllerRedirect
{

    /**
     * @inheritDoc
     */
    public function index()
    {
        // TODO: Implement index() method.
    }

    public function registerForm()
    {
        return $this->html(
            ['error' => $this->request()->getValue('error')]
        );
    }

    public function loginForm()
    {
        return $this->html(
            ['error' => $this->request()->getValue('error')]
        );
    }

    public function register()
    {
        $email = $this->request()->getValue('email');

        if (!Auth::usedEmail($email)) {

            $name = $this->request()->getValue('name');
            $lastName = $this->request()->getValue('last_name');
            $bday = $this->request()->getValue('bday');
            $password = $this->request()->getValue('password');

            $newUser = new User();
            $newUser->setBday($bday);
            $newUser->setName($name);
            $newUser->setPassword($password);
            $newUser->setLastName($lastName);
            $newUser->setEmail($email);
            $newUser->setRegistrationDate(date('d.m.Y'));

            if (isset($_FILES['profile_picture'])) {
                if ($_FILES["profile_picture"]["error"] == UPLOAD_ERR_OK) {
                    $img_name = date('Y-m-d-H-i-s_') . $_FILES['profile_picture']['name'];
                    move_uploaded_file($_FILES['profile_picture']['tmp_name'], Configuration::UPLOAD_DIR . "$img_name");
                    $newUser->setProfilePicture($img_name);
                }
            }
            $newUser->save();
            Auth::login($email,$password);
            $this->redirect('home');
        } else {
            $this->redirect('Auth', 'registerForm', ['error' => 'Zadaný email sa už používa!']);
        }
    }

    public function login()
    {
        $email = $this->request()->getValue('email');
        $password = $this->request()->getValue('password');

        if (Auth::usedEmail($email)) {
            $logged = Auth::login($email, $password);
            if ($logged) {
                $this->redirect('home');
            } else {
                $this->redirect('Auth', 'loginForm', ['error' => 'Zle zadaný email alebo heslo']);
            }
        }
        else{
            $this->redirect('Auth', 'loginForm', ['error' => 'Zadaný email neexistuje']);
        }


    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('home');
    }
}