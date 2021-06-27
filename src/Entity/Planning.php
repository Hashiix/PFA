<?php

namespace App\Entity;

use App\Repository\PlanningRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningRepository::class)
 */
class Planning
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=member::class, inversedBy="plannings")
     */
    private $member;

    /**
     * @ORM\Column(type="integer")
     */
    private $anime;

    public function __construct()
    {
        $this->member = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|member[]
     */
    public function getMember(): Collection
    {
        return $this->member;
    }

    public function addMember(member $member): self
    {
        if (!$this->member->contains($member)) {
            $this->member[] = $member;
        }

        return $this;
    }

    public function removeMember(member $member): self
    {
        $this->member->removeElement($member);

        return $this;
    }

    public function getAnime(): ?int
    {
        return $this->anime;
    }

    public function setAnime(int $anime): self
    {
        $this->anime = $anime;

        return $this;
    }
}
