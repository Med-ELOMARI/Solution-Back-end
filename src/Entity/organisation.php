<?php


namespace App\Entity;


class organisation
{
    protected $name;
    protected $description;
    protected $Users;


    public function getName()
    {
        return $this->name;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getUsers()
    {
        return $this->Users;
    }

    public function setUsers($Users): void
    {
        $this->Users = $Users;
    }

}