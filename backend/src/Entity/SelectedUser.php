<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SelectedUserRepository")
 */
class SelectedUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $UserId;

    /**
     * @ORM\Column(type="integer")
     */
    private $SelectedUserId;

    public function getId()
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->UserId;
    }

    public function setUserId(int $UserId): self
    {
        $this->UserId = $UserId;

        return $this;
    }

    public function getSelectedUserId(): ?int
    {
        return $this->SelectedUserId;
    }

    public function setSelectedUserId(int $SelectedUserId): self
    {
        $this->SelectedUserId = $SelectedUserId;

        return $this;
    }

    public function __toString()
    {
        return "UserId: ".$this->UserId.' SelectedUserId: '.$this->SelectedUserId;
    }

    public function toJsonObj()
    {
        return json_encode($this);
    }
}
