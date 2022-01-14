<?php

namespace App\Models;

class Question extends \App\Core\Model
{
    public function __construct(public int $id=0,
                                public int $id_author=0,
                                public ?string $text=null,
                                public ?string $date=null,
                                public ?string $title=null)
    {
    }


    public function getNumOfAnswers(){
        $answers=Answer::getAll();
        $counter=0;
        foreach ($answers as $answer)
        {
            if($answer->getQuestionId()==$this->id)
            {
                $counter++;
            }

        }
        return $counter;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }


    static public function setDbColumns()
    {
        return ['id','id_author','text','date','title'];
    }

    static public function setTableName()
    {
        return 'questions';

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
    public function getIdAuthor(): int
    {
        return $this->id_author;
    }

    /**
     * @param int $id_author
     */
    public function setIdAuthor(int $id_author): void
    {
        $this->id_author = $id_author;
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


}