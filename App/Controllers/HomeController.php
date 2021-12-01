<?php

namespace App\Controllers;

use App\Auth;
use App\Config\Configuration;
use App\Core\AControllerBase;
use App\Models\Review;
use App\Models\User;
use App\Models\WalkingPost;

/**
 * Class HomeController
 * Example of simple controller
 * @package App\Controllers
 */
class HomeController extends AControllerRedirect
{

    public function index()
    {
        return $this->html([]);
    }


    public function posts()
    {
        return $this->html(
            []
        );
    }

    public function editProfile(){
        return $this->html(
            ['error' => $this->request()->getValue('error')]
        );
    }

   public function profile()
    {
        return $this->html([
            'id'=>$this->request()->getValue('id'),
            'name'=>$this->request()->getValue('name'),
            'last_name'=>$this->request()->getValue('last_name'),
            'bday'=>$this->request()->getValue('bday'),
            'registration_date'=>$this->request()->getValue('registration_date'),
            'email'=>$this->request()->getValue('email'),
            'profile_picture'=>$this->request()->getValue('profile_picture'),
            'cities'=>$this->request()->getValue('cities'),
            'payment'=>$this->request()->getValue('payment'),
            'days_available'=>$this->request()->getValue('days_available')]);
    }

    public function someonesProfile(){

        $user=User::getOne($this->request()->getValue('user_id'));
        if($user==null)
        {
            $user=User::getOne(Auth::getId());
        }
        $this->setProfileData($user);

    }

    private function setProfileData($user){

        $this->redirect('home','profile',[
            'id'=>$user->getId(),
            'name'=>$user->getName(),
            'last_name'=>$user->getLastName(),
            'bday'=>$user->getBday(),
            'registration_date'=>$user->getRegistrationDate(),
            'email'=>$user->getEmail(),
            'profile_picture'=>$user->getProfilePicture(),
            'cities'=>$user->getCities(),
            'payment'=>$user->getPayment(),
            'days_available'=>$user->getDaysAvailable()]);
    }

    public function deleteReview()
    {
        $review_id = $this->request()->getValue('review_id');
        $review = Review::getOne($review_id);
        $receiver_id = $review->getReceiverId();

        $user= User::getOne($receiver_id);

        $review->delete();

        $this->setProfileData($user);
    }

    public function addReview()
    {
        $text = $this->request()->getValue('text');
        $receiver = $this->request()->getValue('receiver_id');
        $writer = $this->request()->getValue('writer_id');
        $rating = $this->request()->getValue('rating');

        $review = new Review();
        $review->setReceiverId($receiver);
        $review->setWriterId($writer);
        $review->setText($text);
        $review->setDate(date('d.m.Y'));
        $review->setRating($rating);

        $review->save();

        $user= User::getOne($receiver);

        $this->setProfileData($user);
        $this->setProfileData($user);

    }

   /* public function editReview()
    {
        $review_id = $this->request()->getValue('review_id');
    }*/



    public function changeProfileInfo()
    {
        $user = User::getOne(Auth::getId());

        $name = $this->request()->getValue('name');
        $lastName = $this->request()->getValue('last_name');
        $email = $this->request()->getValue('email');
        $cities = $this->request()->getValue('cities');
        $payment = $this->request()->getValue('payment');
        $days = [$this->request()->getValue('monday'),$this->request()->getValue('tuesday'),$this->request()->getValue('wednesday'),
            $this->request()->getValue('thursday'),$this->request()->getValue('friday'),$this->request()->getValue('saturday'),
            $this->request()->getValue('sunday')];

        $availableDays="";
        foreach ($days as $day){
            if($day)
            {
                $availableDays .= $day . " ";
            }
        }

        $user->setName($name);
        $user->setLastName($lastName);
        $user->setEmail($email);
        $user->setCities($cities);
        $user->setPayment($payment);
        $user->setDaysAvailable($availableDays);

        if (isset($_FILES['profile_picture'])) {
           if ($_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
                $img_name = date('Y-m-d-H-i-s_') . $_FILES['profile_picture']['name'];
                move_uploaded_file($_FILES['profile_picture']['tmp_name'], Configuration::UPLOAD_DIR . "$img_name");
                $user->setProfilePicture($img_name);
                $_SESSION['profile_picture'] = $img_name;
           }
        }

        $user->save();
        $this->setProfileData($user);
    }

    private function getDaysAvailable(){

    }
}