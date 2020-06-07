<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
//use App\Repository\CommentRepository;  Такой еще пример записи
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 * @ORM\HasLifecycleCallbacks()
 *
 * @ApiResource(
 *     collectionOperations={"get"={"normalization_context"={"groups"="comment:list"}}},
 *     itemOperations={"get"={"normalization_context"={"groups"="comment:item"}}},
 *     order={"createAt"="DESC"},
 *     paginationEnabled=false
 * )
 *
 * @ApiFilter(SearchFilter::class, properties={"conference": "exact"})
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Groups({"comment:list", "comment:item"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     *
     * @Groups({"comment:list", "comment:item"})
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank
     *
     * @Groups({"comment:list", "comment:item"})
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Email
     *
     * @Groups({"comment:list", "comment:item"})
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     *
     * @Groups({"comment:list", "comment:item"})
     */
    private $createAt;

    /**
     * @ORM\ManyToOne(targetEntity=Conference::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Groups({"comment:list", "comment:item"})
     */
    private $conference;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Groups({"comment:list", "comment:item"})
     */
    private $photoFilename;

    /**
     * @ORM\Column(type="string", length=255, options={"default": "submitted"})
     */
    private $state = 'submitted';

    public function __toString(): string
    {
        return (string) $this->getEmail();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getauthor(): ?string
    {
        return $this->author;
    }

    public function setauthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreateAtValue()
    {
        /*Событие @ ORM \ PrePersist срабатывает, когда объект впервые
        сохранятся в базе данных. В этот момент вызывается метод
        setCreateAtValue() , который использует текущие дату и время в
        качестве значения для свойства createAt .*/
        $this->createAt = new \DateTime();
    }

    public function getConference(): ?Conference
    {
        return $this->conference;
    }

    public function setConference(?Conference $conference): self
    {
        $this->conference = $conference;

        return $this;
    }

    public function getPhotoFilename(): ?string
    {
        return $this->photoFilename;
    }

    public function setPhotoFilename(?string $photoFilename): self
    {
        $this->photoFilename = $photoFilename;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }
}
