<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\OfficeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfficeRepository::class)
 */
class Office
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     */
    public ?string $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public ?string $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    public ?\DateTimeInterface $date_beginn;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    public ?\DateTimeInterface $date_end;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="office")
     */
    private $users;

    /**
     * @ORM\ManyToMany(targetEntity=Role::class, inversedBy="offices")
     */
    private $role;

    public function __toString(): string
    {
        $rol = [];
        foreach ($this->getRole() as $ro) {
            $rol = $ro->getRole();
        }
        $rolArray = json_encode($rol);
        return "$this->name ($rolArray)";
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->role = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateBeginn(): ?\DateTimeInterface
    {
        return $this->date_beginn;
    }

    public function setDateBeginn(\DateTimeInterface $date_beginn): self
    {
        $this->date_beginn = $date_beginn;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->date_end;
    }

    public function setDateEnd(\DateTimeInterface $date_end): self
    {
        $this->date_end = $date_end;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addOffice($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeOffice($this);
        }

        return $this;
    }

    /**
     * @return Collection|Role[]
     */
    public function getRole(): Collection
    {
        return $this->role;
    }

    public function addRole(Role $role): self
    {
        if (!$this->role->contains($role)) {
            $this->role[] = $role;
        }

        return $this;
    }

    public function removeRole(Role $role): self
    {
        $this->role->removeElement($role);

        return $this;
    }
}
