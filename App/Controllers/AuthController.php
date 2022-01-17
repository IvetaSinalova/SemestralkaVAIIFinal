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
    }

    public function registerForm()
    {
        if (Auth::isLogged()) {
            $this->redirect('home', 'index', ['errorRegistration' => 'Pre registráciu sa najprv musíte odhlásiť']);
        } else {
            $this->redirect('auth', 'editUserDataForm');
        }

    }


    public function editUserDataForm()
    {
        return $this->html(
            [
                'errorPayment'=>$this->request()->getValue('errorPayment'),
                'errorDays' => $this->request()->getValue('errorDays'),
                'errorName' => $this->request()->getValue('errorName'),
                'errorLastName' => $this->request()->getValue('errorLastName'),
                'errorEmail' => $this->request()->getValue('errorEmail'),
                'errorPassword' => $this->request()->getValue('errorPassword'),
                'errorBirthdate' => $this->request()->getValue('errorBirthdate'),
                'errorCity' => $this->request()->getValue('errorCity'),
                'name' => $this->request()->getValue('name'),
                'last_name' => $this->request()->getValue('last_name'),
                'bday' => $this->request()->getValue('bday'),
                'password' => $this->request()->getValue('password'),
                'email' => $this->request()->getValue('email'),
                'profile_picture' => $this->request()->getValue('profile_picture'),
                'city' => $this->request()->getValue('city'),
                'payment' => $this->request()->getValue('payment'),
                'days_available'=>$this->request()->getValue('days_available'),
                'monday' => $this->request()->getValue('monday'),
                'tuesday' =>$this->request()->getValue('tuesday'),
                'wednesday' => $this->request()->getValue('wednesday'),
                'thursday' => $this->request()->getValue('thursday'),
                'friday' => $this->request()->getValue('friday'),
                'saturday' => $this->request()->getValue('saturday'),
                'sunday' => $this->request()->getValue('sunday')]);
    }


    public function loginForm()
    {
        return $this->html(
            [
                'errorEmail' => $this->request()->getValue('errorEmail'),
                'errorPassword' => $this->request()->getValue('errorPassword'),
                'email' => $this->request()->getValue('email')]
        );
    }

    public function setUserData()
    {
        $email = $this->request()->getValue('email');
        $name = $this->request()->getValue('name');
        $last_name = $this->request()->getValue('last_name');
        $birthdate = $this->request()->getValue('bday');
        $stringToDate = strtotime($birthdate);
        $bday = date('Y-m-d', $stringToDate);
        $password = $this->request()->getValue('password');
        $city = $this->request()->getValue('city');
        $payment = $this->request()->getValue('payment');
        $monday = $this->request()->getValue('monday');
        $tuesday = $this->request()->getValue('tuesday');
        $wednesday = $this->request()->getValue('wednesday');
        $thursday = $this->request()->getValue('thursday');
        $friday = $this->request()->getValue('friday');
        $saturday = $this->request()->getValue('saturday');
        $sunday = $this->request()->getValue('sunday');
        $old_profile_picture=$this->request()->getValue('old_profile_picture');

        $errorExists = false;

        $days = [$monday, $tuesday, $wednesday, $thursday, $friday, $saturday, $sunday];
        $counter = 0;
        $availableDays = "";
        foreach ($days as $day) {
            if ($day) {
                $counter++;
                $availableDays .= $day . " ";
            }
        }

        if ($counter == 0) {
            $errorDays = 'Je treba zadať aspoň jeden deň venčenia';
            $errorExists = true;
        }

        if (!Auth::correctLengthOfInput($name)) {
            $errorName = 'Nesprávne zadané meno';
            $errorExists = true;
        }

        if (!Auth::correctLengthOfInput($last_name)) {
            $errorLastName = 'Nesprávne zadané priezvisko';
            $errorExists = true;
        }

        $age = Auth::getYearsSinceDate($bday);
        if ($age < 15 || $bday == null) {
            $errorBirthdate = 'Užívateľ musí byť starší ako 15 rokov';
            $errorExists = true;
        }else if($age > 150)
        {
            $errorBirthdate = 'Nesprávne zadaný dátum narodenia';
            $errorExists = true;
        }

        if(!Auth::checkCity($city))
        {
            $errorCity='Nesprávne zadané mesto';
            $errorExists = true;

        }

        if($payment < 0)
        {
            $errorPayment='Hodnota musí byť kladná';
            $errorExists = true;
        }

        if (!Auth::isLogged()) {
            if (Auth::getUserByEmail($email)) {
                $errorEmail = 'Zadaný email sa už používa';
                $errorExists = true;
            }
            $user = new User();
            $user->setEmail($email);
            if (!Auth::correctPassword($password)) {
                $errorPassword = 'Heslo musí mať aspoň 6 znakov';
                $errorExists = true;
            }
            $user->setPassword(password_hash($password, PASSWORD_DEFAULT));
        } else {
            $user = User::getOne(Auth::getId());
            if (Auth::getUserByEmail($email) && $user->getEmail() != $email) {
                $errorEmail = 'Zadaný email sa už používa';
                $errorExists = true;
            }
        }

        if ($errorExists) {
            $this->redirect('auth', 'editUserDataForm', [
                'errorPayment'=>$errorPayment,
                'errorDays' => $errorDays,
                'errorName' => $errorName,
                'errorLastName' => $errorLastName,
                'errorEmail' => $errorEmail,
                'errorPassword' => $errorPassword,
                'errorBirthdate' => $errorBirthdate,
                'errorCity' => $errorCity,
                'name' => $name,
                'last_name' => $last_name,
                'bday' => $bday,
                'password' => $password,
                'email' => $email,
                'profile_picture' => $old_profile_picture,
                'city' => $city,
                'payment' => $payment,
                'monday' => $monday,
                'tuesday' => $tuesday,
                'wednesday' => $wednesday,
                'thursday' => $thursday,
                'friday' => $friday,
                'saturday' => $saturday,
                'sunday' => $sunday]);
        }
        else{
            $user->setName($name);
            $user->setLastName($last_name);
            $time = strtotime($bday);
            $bdayOK = date('d.m.Y', $time);
            $user->setBday($bdayOK);
            $user->setCity($city);
            $user->setPayment($payment);
            $user->setDaysAvailable($availableDays);

            if (isset($_FILES['profile_picture'])) {
                $profile_picture = $_FILES['profile_picture']['name'];
                if ($_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
                    $img_name = date('Y-m-d-H-i-s_') . $profile_picture;
                    move_uploaded_file($_FILES['profile_picture']['tmp_name'], Configuration::UPLOAD_DIR . "$img_name");
                    if($old_profile_picture)
                    {
                        $filename=Configuration::UPLOAD_DIR . $old_profile_picture;
                        unlink( $filename);
                    }
                    $user->setProfilePicture($img_name);
                }
            }

            $user->save();
            Auth::login($email, $password);
            if($user->getId()==0)
            {
                $this->redirect('home');
            }
            else{
                $this->redirect('home','profile',['id'=>$user->getId()]);
            }

        }

    }

    public function checkLoginData($email, $password, $view, $errorPassword): bool
    {
        $user = Auth::getUserByEmail($email);
        $result = false;
        if ($user) {
            $passwordOK = password_verify($password, $user->getPassword());
            if ($passwordOK) {
                $result = true;
            } else {
                $this->redirect('Auth', $view, [$errorPassword => 'Zle zadané heslo', 'email' => $email]);
            }
        } else {
            $this->redirect('Auth', $view, ['errorEmail' => 'Zadaný email neexistuje']);
        }
        return $result;
    }

    public function login()
    {
        $email = $this->request()->getValue('email');
        $password = $this->request()->getValue('password');
        if ($this->checkLoginData($email, $password, 'loginForm', 'errorPassword')) {
            $user = Auth::getUserByEmail($email);
            Auth::login($email, $password);
            $this->redirect('home','profile',['id'=>$user->getId()]);
        }


    }

    public function changePasswordForm()
    {
        return $this->html([
            'errorEmail' => $this->request()->getValue('errorEmail'),
            'errorOldPassword' => $this->request()->getValue('errorOldPassword'),
            'errorNewPassword' => $this->request()->getValue('errorNewPassword'),
            'email' => $this->request()->getValue('email')
        ]);
    }

    public function changePassword()
    {
        $email = $this->request()->getValue('email');
        $old_password = $this->request()->getValue('old_password');
        $new_password = $this->request()->getValue('new_password');
        if ($this->checkLoginData($email, $old_password, 'changePasswordForm', 'errorOldPassword')) {
            if (Auth::correctPassword($new_password)) {
                $user = Auth::getUserByEmail($email);
                $user->setPassword(password_hash($new_password, PASSWORD_DEFAULT));
                $user->save();
                Auth::login($email, $new_password);
                $this->redirect('home','profile',['id'=>$user->getId()]);
            } else {
                $this->redirect('auth', 'changePasswordForm', ['errorNewPassword' => 'Zadané heslo musí obsahovať aspoň 6 znakov','email'=>$email]);
            }
        }

    }


    public function logout()
    {
        Auth::logout();
        $this->redirect('home');
    }
}