<?php

namespace App\Models;

class WalkingPost extends \App\Core\Model
{

    public function __construct(
        public int $user_id=0,
        public int $payment=0,
        public ?string $city=null,
        public int $id=0)
    {
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

    /**
     * @return int
     */
    public function getPayment(): int
    {
        return $this->payment;
    }

    /**
     * @param int $payment
     */
    public function setPayment(int $payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
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

    static public function setDbColumns()
    {
        return ['id','user_id','city','payment'];
    }

    static public function setTableName()
    {
        return "walking_posts";
    }
}