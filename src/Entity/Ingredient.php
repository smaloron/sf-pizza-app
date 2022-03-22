<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IngredientRepository::class)]
class Ingredient
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 80)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $unitPrice;

    #[ORM\Column(type: 'integer')]
    private $calories;

    #[ORM\ManyToMany(targetEntity: Pizza::class, mappedBy: 'ingredients')]
    private $pizzas;

    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
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

    public function getUnitPrice(): ?int
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(int $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getCalories(): ?int
    {
        return $this->calories;
    }

    public function setCalories(int $calories): self
    {
        $this->calories = $calories;

        return $this;
    }

    /**
     * @return Collection<int, Pizza>
     */
    public function getPizzas(): Collection
    {
        return $this->pizzas;
    }

    public function addPizza(Pizza $pizza): self
    {
        if (!$this->pizzas->contains($pizza)) {
            $this->pizzas[] = $pizza;
            $pizza->addIngredient($this);
        }

        return $this;
    }

    public function removePizza(Pizza $pizza): self
    {
        if ($this->pizzas->removeElement($pizza)) {
            $pizza->removeIngredient($this);
        }

        return $this;
    }
}
