<?php

namespace App\Models;

class Review extends \App\Core\Model
{
    public function __construct(public int $receiver_id=0,
                                public int $writer_id=0,
                                public ?string $text=null,
                                public ?string $date=null,
                                public int $id=0,
                                public int $rating=0)
    {
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getWriterId(): int
    {
        return $this->writer_id;
    }

    /**
     * @param int $writerId
     */
    public function setWriterId(int $writerId): void
    {
        $this->writer_id = $writerId;
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
    public function getReceiverId(): int
    {
        return $this->receiver_id;
    }

    /**
     * @param int $receiver_id
     */
    public function setReceiverId(int $receiver_id): void
    {
        $this->receiver_id = $receiver_id;
    }



    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     */
    public function setText(?string $text): void
    {
        $this->text = $text;
    }

    static public function setDbColumns()
    {
        return ['id','receiver_id','writer_id','text','date','rating'];
    }

    static public function setTableName()
    {
        return 'reviews';
    }
}