<?php

namespace App\Entity;

use App\Repository\MessagesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessagesRepository::class)]
class Messages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $message;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\ManyToOne(targetEntity: users::class, inversedBy: 'sent')]
    #[ORM\JoinColumn(nullable: false)]
    private $sender;

    #[ORM\ManyToOne(targetEntity: users::class, inversedBy: 'recieved')]
    #[ORM\JoinColumn(nullable: false)]
    private $recipient;
    public function __construct()
    {
        $this->created_at =new \DateTimeImmutable();
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

   

    

    public function getSender(): ?users
    {
        return $this->sender;
    }

    public function setSender(?users $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    public function getRecipient(): ?users
    {
        return $this->recipient;
    }

    public function setRecipient(?users $recipient): self
    {
        $this->recipient = $recipient;

        return $this;
    }
}
