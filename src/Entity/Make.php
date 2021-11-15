<?php

namespace App\Entity;

use App\Repository\MakeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MakeRepository::class)
 */
class Make extends Basic
{
    /**
     * @ORM\ManyToOne(targetEntity=VehicleType::class, inversedBy="makes")
     * @ORM\JoinColumn(nullable=false)
     */
    private VehicleType $type;

    /**
     * @ORM\OneToMany(targetEntity=Model::class, mappedBy="make")
     */
    private $models;

    public function __construct()
    {
        $this->models = new ArrayCollection();
    }

    public function getType(): VehicleType
    {
        return $this->type;
    }

    public function setType(VehicleType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Model[]
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): self
    {
        if (!$this->models->contains($model)) {
            $this->models[] = $model;
            $model->setMake($this);
        }

        return $this;
    }

    public function removeModel(Model $model): self
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getMake() === $this) {
                $model->setMake(null);
            }
        }

        return $this;
    }
}
