<?php

namespace TestApp;

/**
 * Class User
 */
class User extends Model
{
    public static $table_name = 'users';
    public static $saved_fields = ['email', 'username', 'hashed_password', 'first_name', 'last_name', 'father_name'];

    /**
     * @var string
     */
    protected $email;

    /**
     * @var
     */
    protected $username;

    /**
     * @var
     */
    protected $hashed_password;

    /**
     * @var
     */
    protected $first_name;

    /**
     * @var
     */
    protected $last_name;

    /**
     * @var
     */
    protected $father_name;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return User
     */
    public function setUsername($username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHashedPassword()
    {
        return $this->hashed_password;
    }

    /**
     * @param mixed $hashed_password
     * @return User
     */
    public function setHashedPassword($hashed_password): User
    {
        $this->hashed_password = $hashed_password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param mixed $first_name
     * @return User
     */
    public function setFirstName($first_name): User
    {
        $this->first_name = $first_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param mixed $last_name
     * @return User
     */
    public function setLastName($last_name): User
    {
        $this->last_name = $last_name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFatherName()
    {
        return $this->father_name;
    }

    /**
     * @param mixed $father_name
     * @return User
     */
    public function setFatherName($father_name): User
    {
        $this->father_name = $father_name;
        return $this;
    }


}