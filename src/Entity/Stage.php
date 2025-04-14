<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StageRepository::class)]
class Stage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "stage_id")]
    private ?int $stageId = null;

    #[ORM\Column(length: 50, nullable: false)]
    private string $stageName;

    /**
     * @var Collection<int, Deal>
     */
    #[ORM\OneToMany(targetEntity: Deal::class, mappedBy: 'stage')]
    private Collection $deals;

    public function __construct()
    {
        $this->deals = new ArrayCollection();
    }

    public function getStageId(): ?int
    {
        return $this->stageId;
    }

    public function setStageId(int $stageId): static
    {
        $this->stageId = $stageId;

        return $this;
    }

    public function getStageName(): string
    {
        return $this->stageName;
    }

    public function setStageName(string $stageName): static
    {
        $this->stageName = $stageName;

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
            $deal->setStage($this);
        }

        return $this;
    }

    public function removeDeal(Deal $deal): static
    {
       $this->deals->removeElement($deal);
       return $this;
    }
}
