<?php

namespace App\Entity;

use App\Repository\MemberRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=MemberRepository::class)
 * @UniqueEntity(
 *     fields={"email"},
 *     message="L'email que vous avez indiqué est déjà utilisé !"
 * )
 * @UniqueEntity(
 *     fields={"username"},
 *     message="Le pseudo que vous avez indiqué est déjà utilisé !"
 * )
 */
class Member implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(
     *     min= "8",
     *     max= "50",
     *     minMessage= "Votre mot de passe doit faire au moins 8 caractères",
     *     maxMessage= "Votre mot de passe ne doit pas faire plus de 50 caractères",
     *     )
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $registration_date;

    /**
     * @Assert\EqualTo(
     *     propertyPath= "password",
     *     message="Vous n'avez pas tapé le même mot de passe"
     * )
     */
    public $passwordVerify;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $avatar;

    /**
     * @ORM\ManyToMany(targetEntity=Watching::class, mappedBy="member")
     */
    private $watchings;

    /**
     * @ORM\ManyToMany(targetEntity=Complete::class, mappedBy="member")
     */
    private $completes;

    /**
     * @ORM\ManyToMany(targetEntity=Planning::class, mappedBy="member")
     */
    private $plannings;

    public function __construct()
    {
        $this->watchings = new ArrayCollection();
        $this->completes = new ArrayCollection();
        $this->plannings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

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

    public function getRegistrationDate(): ?\DateTimeInterface
    {
        return $this->registration_date;
    }

    public function setRegistrationDate(\DateTimeInterface $registration_date): self
    {
        $this->registration_date = $registration_date;

        return $this;
    }

    public function eraseCredentials()
    {
    }

    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return ['ROLE_USER'];
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection|Watching[]
     */
    public function getWatchings(): Collection
    {
        return $this->watchings;
    }

    public function addWatching(Watching $watching): self
    {
        if (!$this->watchings->contains($watching)) {
            $this->watchings[] = $watching;
            $watching->addMember($this);
        }

        return $this;
    }

    public function removeWatching(Watching $watching): self
    {
        if ($this->watchings->removeElement($watching)) {
            $watching->removeMember($this);
        }

        return $this;
    }

    /**
     * @return Collection|Complete[]
     */
    public function getCompletes(): Collection
    {
        return $this->completes;
    }

    public function addComplete(Complete $complete): self
    {
        if (!$this->completes->contains($complete)) {
            $this->completes[] = $complete;
            $complete->addMember($this);
        }

        return $this;
    }

    public function removeComplete(Complete $complete): self
    {
        if ($this->completes->removeElement($complete)) {
            $complete->removeMember($this);
        }

        return $this;
    }

    /**
     * @return Collection|Planning[]
     */
    public function getPlannings(): Collection
    {
        return $this->plannings;
    }

    public function addPlanning(Planning $planning): self
    {
        if (!$this->plannings->contains($planning)) {
            $this->plannings[] = $planning;
            $planning->addMember($this);
        }

        return $this;
    }

    public function removePlanning(Planning $planning): self
    {
        if ($this->plannings->removeElement($planning)) {
            $planning->removeMember($this);
        }

        return $this;
    }
    

}
