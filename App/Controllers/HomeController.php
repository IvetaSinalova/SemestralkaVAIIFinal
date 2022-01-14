<?php

namespace App\Controllers;

use App\Auth;
use App\Forum;
use App\Models\Answer;
use App\Models\Like;
use App\Models\Question;
use App\Models\Review;
use App\Models\User;

/**
 * Class HomeController
 * Example of simple controller
 * @package App\Controllers
 */
class HomeController extends AControllerRedirect
{

    public function index()
    {
        return $this->html([
            'errorRegistration'=>$this->request()->getValue('errorRegistration')]);
    }



    public function editProfileForm()
    {
        $user=User::getOne(Auth::getId());
        $days= explode(" ", $user->getDaysAvailable());

        for($i =0; $i<count($days);$i++)
        {
            if($days[$i]=="PON")
            {
                $monday="PON";
            }
            else if($days[$i]=="UT")
            {
                $tuesday="UT";
            }
            else if($days[$i]=="ST")
            {
                $wednesday="ST";
            }
            else if($days[$i]=="ŠT")
            {
                $thursday="ŠT";
            }
            else if($days[$i]=="PIA")
            {
                $friday="ST";
            }
            else if($days[$i]=="SOB")
            {
                $saturday="SOB";
            }
            else if($days[$i]=="NED")
            {
                $sunday="NED";
            }
        }

        $birthdate=$user->getBday();
        $stringToDate = strtotime($birthdate);
        $bday = date('Y-m-d', $stringToDate);

        $this->redirect('auth','editUserDataForm',[
            'name' => $user->getName(),
            'last_name' => $user->getLastName(),
            'bday' => $bday,
            'password' => $user->getPassword(),
            'email' => $user->getEmail(),
            'profile_picture' => $user->getProfilePicture(),
            'city' => $user->getCity(),
            'payment' => $user->getPayment(),
            'monday' => $monday,
            'tuesday' => $tuesday,
            'wednesday' => $wednesday,
            'thursday' => $thursday,
            'friday' => $friday,
            'saturday' => $saturday,
            'sunday' => $sunday]);
    }


    public function addQuestionForm(){
        $id = $this->request()->getValue('id');
        $question=Question::getOne($id);
        return $this->html([
            'error' => $this->request()->getValue('error'),
            'question'=>$question
        ]);
    }

    public function questions(){
        $questions=Question::getAll();
        return $this->html([
            'questions' => $questions
        ]);
    }

    public function getQuestion(){
        $id=$this->request()->getValue('id');
        $question=Question::getOne($id);
        $answers=Answer::getAll();
        return $this->html([
            'question'=>$question,
            'answers'=>$answers,
            'error'=>$this->request()->getValue('error')
        ]);
    }

    public function addLike(){
        $id_answer=$this->request()->getValue('answer_id');
        $question_id = $this->request()->getValue('question_id');
        $answer=Answer::getOne($id_answer);
        $likes=$answer->getLikes();
        $likes++;
        $answer->setLikes($likes);
        $answer->save();
        $like = new Like();
        $like->setUserId(Auth::getId());
        $like->setAnswerId($id_answer);
        $like->save();
        $this->redirect('home','getQuestion',['id'=>$question_id]);
    }

    public function removeLike(){
        $id_answer=$this->request()->getValue('answer_id');
        $question_id = $this->request()->getValue('question_id');
        $answer=Answer::getOne($id_answer);
        $likes=$answer->getLikes();
        $likes--;
        $like_id=Forum::alreadyLikedAnswer(Auth::getId(),$id_answer);
        $like=Like::getOne($like_id);
        $like->delete();
        $answer->setLikes($likes);
        $answer->save();
        $this->redirect('home','getQuestion',['id'=>$question_id]);
    }

    public function addAnswer(){
        $question_id = $this->request()->getValue('question_id');
        $author_id=Auth::getId();
        $date = date('d.m.Y');
        $text = $this->request()->getValue('text');

        if(!$text)
        {
            $this->redirect('home','getQuestion',['error'=>'Zadajte text','id'=>$question_id]);
        }
        else
        {
            $answer= new Answer();
            $answer->setQuestionId($question_id);
            $answer->setAuthorId($author_id);
            $answer->setDate($date);
            $answer->setText($text);
            $answer->save();
            $this->redirect('home','getQuestion',['id'=>$question_id]);
        }

    }

    public function publicQuestion(){
        $title = $this->request()->getValue('title');
        $text = $this->request()->getValue('text');
        $question_id=$this->request()->getValue('question_id');

        if(!$title || !$text)
        {
            $this->redirect('home','addQuestionForm',
                ['error'=>'Je potrebné vyplniť všetky polia',
                'title'=>$title,
                'text'=>$text]);
        }
        else
        {
            if($question_id)
            {
                $question=Question::getOne($question_id);
            }
            else{
                $question=new Question();
            }
            $question->setIdAuthor(Auth::getId());
            $question->setText($text);
            $question->setDate(date('d.m.Y'));
            $question->setTitle($title);
            $question->save();
            $this->redirect('home','questions');
        }
    }


    public function users()
    {
        $users=User::getAll();
        return $this->html(
            [
                'users'=>$users
            ]
        );
    }

    public function profile()
    {
        $reviews=Review::getAll();
        return $this->html([
            'review_id'=>$this->request()->getValue('review_id'),
            'reviews'=>$reviews,
            'error'=>$this->request()->getValue('error'),
            'id' => $this->request()->getValue('id'),
            'rating'=>$this->request()->getValue('rating'),
            'name' => $this->request()->getValue('name'),
            'last_name' => $this->request()->getValue('last_name'),
            'bday' => $this->request()->getValue('bday'),
            'email' => $this->request()->getValue('email'),
            'profile_picture' => $this->request()->getValue('profile_picture'),
            'city' => $this->request()->getValue('city'),
            'payment' => $this->request()->getValue('payment'),
            'days_available' => $this->request()->getValue('days_available')]);
    }

    public function deleteQuestion(){
        $id_question = $this->request()->getValue('id_question');
        $answers=Answer::getAll();
        foreach ($answers as $answer)
        {
            if($answer->getQuestionId()==$id_question)
            {
                $answer->delete();
            }
        }
        $question=Question::getOne($id_question);
        $question->delete();
        $this->redirect('home','questions');
    }

    public function editQuestion(){
        $id=$this->request()->getValue('id_question');
        $this->redirect('home','addQuestionForm',['id'=>$id]);
    }


    public function getProfile()
    {
        $user = User::getOne($this->request()->getValue('id'));
        if ($user == null) {
            $user = User::getOne(Auth::getId());
        }
        $this->setProfileData($user);

    }

    public function setProfileData($user)
    {
        $this->redirect('home', 'profile', [
            'id' => $user->getId(),
            'rating'=>$user->getRating(),
            'name' => $user->getName(),
            'last_name' => $user->getLastName(),
            'bday' => $user->getBday(),
            'email' => $user->getEmail(),
            'profile_picture' => $user->getProfilePicture(),
            'city' => $user->getCity(),
            'payment' => $user->getPayment(),
            'days_available' => $user->getDaysAvailable()]);
    }

    public function deleteReview()
    {
        $review_id = $this->request()->getValue('review_id');
        $review = Review::getOne($review_id);
        $receiver_id = $review->getReceiverId();

        $user = User::getOne($receiver_id);

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

        $user = User::getOne($receiver);

        $this->setProfileData($user);
        $this->setProfileData($user);

    }


}