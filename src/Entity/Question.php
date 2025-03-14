<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
class Question
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['question', 'test'])]
    private ?int $id = null;

    #[ORM\Column(type: "text")]
    #[Groups(['question', 'test'])]
    private ?string $question = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['question', 'test'])]
    private ?string $type = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['question', 'test'])]
    private ?string $difficulteeeee = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['question', 'test'])]
    private ?string $reponseCorrecte = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY, nullable: true)]
    #[Groups(['question', 'test'])]
    private ?array $reponses = null;

    #[ORM\Column(length: 500, nullable: true)]
    #[Groups(['question', 'test'])]
    private ?string $audio = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['question'])]
    private ?string $userReponse = null;

    /**
     * @var Collection<int, ReponseEtudiant>
     */
    #[ORM\OneToMany(targetEntity: ReponseEtudiant::class, mappedBy: 'question')]
    private Collection $reponseEtudiants;

    #[ORM\ManyToOne(inversedBy: 'questions')]
    #[Groups(['question'])]
    private ?Test $test = null;

    public function __construct()
    {
        $this->reponseEtudiants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(?string $question): static
    {
        $this->question = $question;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDifficulteeeee(): ?string
    {
        return $this->difficulteeeee;
    }

    public function setDifficulteeeee(?string $difficulteeeee): static
    {
        $this->difficulteeeee = $difficulteeeee;

        return $this;
    }

    public function getReponseCorrecte(): ?string
    {
        return $this->reponseCorrecte;
    }

    public function setReponseCorrecte(?string $reponseCorrecte): static
    {
        $this->reponseCorrecte = $reponseCorrecte;

        return $this;
    }


    public function getReponses(): ?array
    {
        return $this->reponses;
    }

    public function setReponses(?array $reponses): static
    {
        $this->reponses = $reponses;

        return $this;
    }

    public function getAudio(): ?string
    {
        return $this->audio;
    }

    public function setAudio(?string $audio): static
    {
        $this->audio = $audio;

        return $this;
    }

    public function getUserReponse(): ?string
    {
        return $this->userReponse;
    }

    public function setUserReponse(?string $userReponse): static
    {
        $this->userReponse = $userReponse;

        return $this;
    }

    /**
     * @return Collection<int, ReponseEtudiant>
     */
    public function getReponseEtudiants(): Collection
    {
        return $this->reponseEtudiants;
    }

    public function addReponseEtudiant(ReponseEtudiant $reponseEtudiant): static
    {
        if (!$this->reponseEtudiants->contains($reponseEtudiant)) {
            $this->reponseEtudiants->add($reponseEtudiant);
            $reponseEtudiant->setQuestion($this);
        }

        return $this;
    }

    public function removeReponseEtudiant(ReponseEtudiant $reponseEtudiant): static
    {
        if ($this->reponseEtudiants->removeElement($reponseEtudiant)) {
            // set the owning side to null (unless already changed)
            if ($reponseEtudiant->getQuestion() === $this) {
                $reponseEtudiant->setQuestion(null);
            }
        }

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