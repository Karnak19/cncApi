<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 */
class City
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $cp;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserId", mappedBy="city")
     */
    private $userIds;

    public function __construct()
    {
        $this->userIds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): self
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * @return Collection|UserId[]
     */
    public function getUserIds(): Collection
    {
        return $this->userIds;
    }

    public function addUserId(UserId $userId): self
    {
        if (!$this->userIds->contains($userId)) {
            $this->userIds[] = $userId;
            $userId->setCity($this);
        }

        return $this;
    }

    public function removeUserId(UserId $userId): self
    {
        if ($this->userIds->contains($userId)) {
            $this->userIds->removeElement($userId);
            // set the owning side to null (unless already changed)
            if ($userId->getCity() === $this) {
                $userId->setCity(null);
            }
        }

        return $this;
    }
}
