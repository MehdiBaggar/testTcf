<?php

namespace App\Entity;

use App\Repository\TestRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TestRepository::class)]
class Test
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'tests')]
    private ?Etudiant $user = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $data = null;

    #[ORM\Column(nullable: true)]
    private ?int $scoreTotal = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $niveau = null;



    /**
     * @var Collection<int, ReponseEtudiant>
     */
    #[ORM\OneToMany(targetEntity: ReponseEtudiant::class, mappedBy: 'test')]
    private Collection $reponseEtudiants;

    /**
     * @var Collection<int, Question>
     */
    #[ORM\OneToMany(targetEntity: Question::class, mappedBy: 'test')]
    private Collection $questions;

    public function __construct()
    {
        $this->reponseEtudiants = new ArrayCollection();
        $this->questions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Etudiant
    {
        return $this->user;
    }

    public function setUser(?Etudiant $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(?\DateTimeInterface $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getScoreTotal(): ?int
    {
        return $this->scoreTotal;
    }

    public function setScoreTotal(?int $scoreTotal): static
    {
        $this->scoreTotal = $scoreTotal;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(?string $niveau): static
    {
        $this->niveau = $niveau;

        return $this;
    }





    /**
     * @return Collection<int, ReponseEtudiant>
     */
    public function getYes(): Collection
    {
        return $this->reponseEtudiants;
    }

    public function addReponseEtudiant(ReponseEtudiant $reponseEtudiants): static
    {
        if (!$this->reponseEtudiants->contains($reponseEtudiants)) {
            $this->reponseEtudiants->add($reponseEtudiants);
            $reponseEtudiants->setTest($this);
        }

        return $this;
    }

    public function removeReponseEtudiant(ReponseEtudiant $reponseEtudiants): static
    {
        if ($this->$reponseEtudiants->removeElement($reponseEtudiants)) {
            // set the owning side to null (unless already changed)
            if ($reponseEtudiants->getTest() === $this) {
                $reponseEtudiants->setTest(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Question>
     */
    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function addQuestion(Question $question): static
    {
        if (!$this->questions->contains($question)) {
            $this->questions->add($question);
            $question->setTest($this);
        }

        return $this;
    }

    public function removeQuestion(Question $question): static
    {
        if ($this->questions->removeElement($question)) {
            // set the owning side to null (unless already changed)
            if ($question->getTest() === $this) {
                $question->setTest(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return (string) $this->getId(); // or any unique property that makes sense
    }
}
