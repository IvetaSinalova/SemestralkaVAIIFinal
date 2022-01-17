<?php

namespace App\Controllers;

use App\Auth;
use App\Config\Configuration;
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

    public function findByCity(){
        $city=$this->request()->getValue('searchByCity');
        $users=User::getAll('city = ?',[$city]);

        if(!Auth::checkCity($city))
        {
            return $this->json("errorWrongCity");
        }
        else if(empty($users))
        {
            return $this->json("errorNoResults");
        }
        return $this->json($users);
    }

    public function getAllReviewsOfUserProfile(){
        $user_id=$this->request()->getValue('user_id');
        $reviewsOK=Review::getAll('receiver_id = ?',[$user_id]);
        if(empty($reviewsOK))
        {
            return $this->json("noResults");
        }
        return $this->json($reviewsOK);
    }

    public function getWriter(){
        $review_id = $this->request()->getValue('review_id');
        $review=Review::getOne($review_id);
        $user_id=$review->getWriterId();
        return $this->json(User::getOne($user_id));
    }


    public function deleteProfile(){
        $user_id=$this->request()->getValue('user_id');

        $likes=Like::getAll('user_id = ?',[$user_id]);
        foreach ($likes as $like)
        {
            $like->delete();
        }
        $answers=Answer::getAll('author_id = ?',[$user_id]);
        foreach ($answers as $answer)
        {
            $answer->delete();
        }
        $questions=Question::getAll('id_author = ?',[$user_id]);
        foreach ($questions as $question)
        {
            $question->delete();
        }
        $reviews=Review::getAll('receiver_id = ? OR writer_id = ?',[$user_id,$user_id]);
        foreach ($reviews as $review)
        {
            $review->delete();
        }
        $user=User::getOne($user_id);
        $filename=Configuration::UPLOAD_DIR . $user->getProfilePicture();
        unlink( $filename);

        Auth::logout();
        $user->delete();
        $this->redirect('home');
    }

    public function editProfileForm()
    {
        $user=User::getOne(Auth::getId());
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
            'days_available' => $user->getDaysAvailable()]);
    }

    public function addQuestionForm(){
        $id = $this->request()->getValue('id');
        $question=Question::getOne($id);
        return $this->html([
            'errorTitle'=>$this->request()->getValue('errorTitle'),
            'error' => $this->request()->getValue('error'),
            'title'=>$this->request()->getValue('title'),
            'question'=>$question
        ]);
    }


    public function getAllUsers(){
        return $this->json(User::getAll());
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
        $answers=Answer::getAll('question_id = ?',[$question->getId()]);
        return $this->html([
            'question'=>$question,
            'answers'=>$answers,
            'error'=>$this->request()->getValue('error')
        ]);
    }

    public function getQuestionForm(){
        $id=$this->request()->getValue('id');
        $this->redirect('home','getQuestion',['id'=>$id]);
    }

    public function getOnlineUser(){
        return $this->json(User::getOne(Auth::getId()));
    }


    public function addLike(){
        $id_answer=$this->request()->getValue('answer_id');
        $question_id = $this->request()->getValue('question_id');
        $like = new Like();
        $like->setUserId(Auth::getId());
        $like->setAnswerId($id_answer);
        $like->save();
        $this->redirect('home','getQuestionForm',['id'=>$question_id]);

    }

    public function removeLike(){
        $id_answer=$this->request()->getValue('answer_id');
        $question_id = $this->request()->getValue('question_id');
        $like_id=Forum::alreadyLikedAnswer(Auth::getId(),$id_answer);
        $like=Like::getOne($like_id);
        $like->delete();
        $this->redirect('home','getQuestionForm',['id'=>$question_id]);
    }

    public function addAnswer(){
        $question_id = $this->request()->getValue('question_id');
        $author_id=Auth::getId();
        $date = date('d.m.Y');
        $text = $this->request()->getValue('text');

        if(!$text)
        {
            $this->redirect('home','getQuestionForm',['error'=>'Zadajte text','id'=>$question_id]);
        }
        else
        {
            $answer= new Answer();
            $answer->setQuestionId($question_id);
            $answer->setAuthorId($author_id);
            $answer->setDate($date);
            $answer->setText($text);
            $answer->save();
            $this->redirect('home','getQuestionForm',['id'=>$question_id]);
        }

    }

    public function publicQuestion(){
        $title = $this->request()->getValue('title');
        $text = $this->request()->getValue('text');
        $question_id=$this->request()->getValue('question_id');
        $errorExists=false;

        if(!$title || !$text)
        {
            $errorExists=true;
            $error='Je potrebné vyplniť všetky polia';
        }
        if (!Auth::correctLengthOfInput($title)){
            $errorExists=true;
            $errorTitle='Nadpis je príliš dlhý';
        }
        if($errorExists)
        {
            $this->redirect('home','addQuestionForm',
                ['error'=>$error,
                    'errorTitle'=>$errorTitle,
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
        $id = $this->request()->getValue('id');
        $user=User::getOne($id);
        $reviews=Review::getAll('receiver_id = ?',[$id]);
        return $this->html([
            'reviews'=>$reviews,
            'user'=>$user]);
    }

    public function deleteQuestion(){
        $id_question = $this->request()->getValue('id_question');
        $answers=Answer::getAll('question_id = ?',[$id_question]);
        $likes = Like::getAll();
        foreach ($likes as $like)
        {
                foreach ($answers as $answer){
                if($like->getAnswerId()==$answer->getId())
                {
                    $like->delete();
                }
            }

        }

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
        $id = $this->request()->getValue('id');
        if (!$id) {
            $id = Auth::getId();
        }
        $this->redirect('home','profile',['id'=>$id]);

    }

    public function deleteReview()
    {
        $review_id = $this->request()->getValue('review_id');
        $review = Review::getOne($review_id);
        $receiver_id = $review->getReceiverId();
        $review->delete();
        $reviews = Review::getAll('receiver_id = ?',[$receiver_id]);
        if(empty($reviews))
        {
            return $this->json('noResults');

        }
        return $this->json($reviews);
    }


    public function addReview()
    {
        $text = $this->request()->getValue('text');
        $rating = $this->request()->getValue('rating');
        if(!$text || !$rating)
        {
            return $this->json('error');
        }
        $receiver_id = $this->request()->getValue('receiver_id');
        $writer = $this->request()->getValue('writer_id');


        $review = new Review();
        $review->setReceiverId($receiver_id);
        $review->setWriterId($writer);
        $review->setText($text);
        $review->setDate(date('d.m.Y'));
        $review->setRating($rating);
        $review->save();

        $reviews = Review::getAll('receiver_id = ?',[$receiver_id]);

        return $this->json($reviews);

    }


}