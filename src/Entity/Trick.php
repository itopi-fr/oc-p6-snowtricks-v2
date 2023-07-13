<?php

namespace App\Entity;

use App\Repository\TrickRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TrickRepository::class)]
class Trick
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title = null;

    #[ORM\Column(length: 10000)]
    private ?string $content = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $excerpt = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreated = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateModified = null;

    #[ORM\Column(length: 10)]
    private ?string $status = null;

    #[ORM\ManyToOne(inversedBy: 'tricks')]
    #[ORM\JoinColumn(onDelete:"SET NULL")]
    private ?TrickCategory $category = null;

    #[ORM\OneToMany(mappedBy: 'trick', targetEntity: File::class)]
    private Collection $media;

    #[ORM\OneToMany(mappedBy: 'trick', targetEntity: ForumMessage::class)]
    private Collection $forumMessages;

    #[ORM\ManyToOne]
    private ?User $user = null;

    public function __construct()
    {
        $this->media = new ArrayCollection();
        $this->forumMessages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getExcerpt(): ?string
    {
        return $this->excerpt;
    }

    public function setExcerpt(?string $excerpt): static
    {
        $this->excerpt = $excerpt;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated): static
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTimeInterface
    {
        return $this->dateModified;
    }

    public function setDateModified(?\DateTimeInterface $dateModified): static
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCategory(): ?TrickCategory
    {
        return $this->category;
    }

    public function setCategory(?TrickCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection<int, File>
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(File $medium): static
    {
        if (!$this->media->contains($medium)) {
            $this->media->add($medium);
            $medium->setTrick($this);
        }

        return $this;
    }

    public function removeMedium(File $medium): static
    {
        if ($this->media->removeElement($medium)) {
            // set the owning side to null (unless already changed)
            if ($medium->getTrick() === $this) {
                $medium->setTrick(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ForumMessage>
     */
    public function getForumMessages(): Collection
    {
        return $this->forumMessages;
    }

    public function addForumMessage(ForumMessage $forumMessage): static
    {
        if (!$this->forumMessages->contains($forumMessage)) {
            $this->forumMessages->add($forumMessage);
            $forumMessage->setTrick($this);
        }

        return $this;
    }

    public function removeForumMessage(ForumMessage $forumMessage): static
    {
        if ($this->forumMessages->removeElement($forumMessage)) {
            // set the owning side to null (unless already changed)
            if ($forumMessage->getTrick() === $this) {
                $forumMessage->setTrick(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
