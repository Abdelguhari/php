<?php

namespace app\models;

use app\core\Model;

class User extends Model
{


    private string $title;

    private string $content;

    private string $user_id;


    /**
     * @param string $title
     * @param string $content
     * @param int $user_id
     */
    public function __construct(
        ?int $id,
        string $title,
        string $content,
        int $user_id
    ) {
        parent::__construct($id);
        $this->title = $title;
        $this->content = $content;
        $this->user_id = $user_id;
    }


    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $first_name
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $second_name
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user_id;
    }

    /**
     * @param string $email
     */
    public function setUser(int $user_id): void
    {
        $this->user_id = $user_id;
    }
}