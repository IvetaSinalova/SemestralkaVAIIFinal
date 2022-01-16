<?php

namespace App\Models;

use App\Config\Configuration;

class User extends \App\Core\Model
{
    public function __construct(
        public int $id = 0,
        public ?string $name = null,
        public ?string $last_name = null,
        public ?string $bday = null,
        public ?string $password = null,
        public ?string $email = null,
        public ?string $profile_picture = null,
        public ?string $city= null,
        public float $payment=0,
        public ?string $days_available=null
    )
    {
    }

    /**
     * @return string|null
     */
    public function getDaysAvailable(): ?string
    {
        return $this->days_available;
    }

    /**
     * @param string|null $days_available
     */
    public function setDaysAvailable(?string $days_available): void
    {
        $this->days_available = $days_available;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return int
     */
    public function getPayment(): float
    {
        return $this->payment;
    }

    /**
     * @param int $payment
     */
    public function setPayment(float $payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void
    {
        $this->last_name = $last_name;
    }

    /**
     * @return int|string|null
     */
    public function getBday(): int|string|null
    {
        return $this->bday;
    }

    /**
     * @param int|string|null $bday
     */
    public function setBday(int|string|null $bday): void
    {
        $this->bday = $bday;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    static public function setDbColumns()
    {
        return ['id','name','last_name','bday','password','email','profile_picture','city','payment','days_available'];
    }

    static public function setTableName()
    {
        return "users";
    }

    /**
     * @return string|null
     */
    public function getProfilePicture(): ?string
    {
        return $this->profile_picture;
    }

    /**
     * @param string|null $profile_picture
     */
    public function setProfilePicture(?string $profile_picture): void
    {
        $this->profile_picture = $profile_picture;
    }

    public function getRating()
    {
        $numOfRanks=0;
        $ranking=0;
        foreach (Review::getAll() as $review)
        {
            if($this->getId()==$review->receiver_id)
            {
                $numOfRanks++;
                $ranking+=$review->getRating();
            }
        }
        if($numOfRanks>0)
        {
            return round($ranking/$numOfRanks,1);
        }
        return -1;
    }

}