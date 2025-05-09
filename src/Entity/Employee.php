<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee implements  UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "employee_id")]
    private ?int $employeeId = null;

    #[ORM\Column(length: 40, nullable: false)]
    private string $firstName;

    #[ORM\Column(length: 40, nullable: false)]
    private string $lastName;

    #[ORM\Column(length: 40, nullable: false)]
    private string $email;

    #[ORM\Column(length: 255, nullable: false)]
    private string $passwordHash;

    private ?string $plainPassword = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: false)]
    private \DateTimeInterface $createdAt;

    /**
     * @var Collection<int, Deal>
     */
    #[ORM\OneToMany(targetEntity: Deal::class, mappedBy: 'employee')]
    private Collection $deals;

    #[ORM\ManyToOne(inversedBy: 'employees')]
    #[ORM\JoinColumn(name: "role_id", referencedColumnName: "role_id")]
    private Roles $role;

    public function __construct()
    {
        $this->deals = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    public function getEmployeeId(): ?int
    {
        return $this->employeeId;
    }

    public function setEmployeeId(int $employeeId): static
    {
        $this->employeeId = $employeeId;

        return $this;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(?string $plainPassword): static
    {
        $this->plainPassword = $plainPassword;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPasswordHash(): string
    {
        return $this->passwordHash;
    }

    public function setPasswordHash(string $passwordHash): static
    {
        $this->passwordHash = $passwordHash;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Deal>
     */
    public function getDeals(): Collection
    {
        return $this->deals;
    }

    public function addDeal(Deal $deal): static
    {
        if (!$this->deals->contains($deal)) {
            $this->deals->add($deal);
            $deal->setEmployee($this);
        }

        return $this;
    }

    public function removeDeal(Deal $deal): static
    {
        $this->deals->removeElement($deal);
        return $this;
    }

    public function getRole(): Roles
    {
        return $this->role;
    }

    public function setRole(Roles $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }


    // Applying functions required for UserInterface
    public function getRoles(): array
    {
        $roleName = $this->role ? $this->role->getRoleName() : 'ROLE_USER';
        return [$roleName];
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->passwordHash;
    }

    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }
}
