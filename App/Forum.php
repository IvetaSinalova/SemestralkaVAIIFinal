<?php

namespace App;

use App\Models\Like;
use App\Models\User;

class Forum
{
    public static function getAuthorProfilePicture($id_author){
        $user=User::getOne($id_author);
        return $user->getProfilePicture();
    }

    public static function getAuthorName($id_author){
        $user=User::getOne($id_author);
        return $user->getName(). " " . $user->getLastName();
    }

    public static function alreadyLikedAnswer($id_user,$id_answer){
        $likes=Like::getAll();
        foreach ($likes as $like)
        {
            if($id_user==$like->getUserId() && $id_answer==$like->getAnswerId())
            {
                return $like->getId();
            }
        }
        return -1;
    }
}