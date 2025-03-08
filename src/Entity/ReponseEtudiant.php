<?php

namespace App\Entity;

use App\Repository\ReponseEtudiantRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponseEtudiantRepository::class)]
class ReponseEtudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\ManyToOne(inversedBy: 'reponseEtudiants')]
    private ?Question $question = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $userAnswer = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_correct = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\ManyToOne(targetEntity: Test::class, cascade: ['persist'], inversedBy: 'yes')]
    private ?Test $test = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getQuestion(): ?Question
    {
        return $this->question;
    }

    public function setQuestion(?Question $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getUserAnswer(): ?string
    {
        return $this->userAnswer;
    }

    public function setUserAnswer(?string $userAnswer): static
    {
        $this->userAnswer = $userAnswer;

        return $this;
    }

    public function isCorrect(): ?bool
    {
        return $this->is_correct;
    }

    public function setIsCorrect(?bool $is_correct): static
    {
        $this->is_correct = $is_correct;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getTest(): ?Test
    {
        return $this->test;
    }

    public function setTest(?Test $test): static
    {
        $this->test = $test;

        return $this;
    }
}
