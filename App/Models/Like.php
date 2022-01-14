<?php

namespace App\Models;

class Like extends \App\Core\Model
{

    public function __construct(public int $id=0,
                                public int $answer_id=0,
                                public int $user_id=0)
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getAnswerId(): int
    {
        return $this->answer_id;
    }

    /**
     * @param int $answer_id
     */
    public function setAnswerId(int $answer_id): void
    {
        $this->answer_id = $answer_id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }



    static public function setDbColumns()
    {
        return ['id','answer_id','user_id'];
    }

    static public function setTableName()
    {
        return 'likes';
    }
}