<?php

namespace App\Entity;

use App\Repository\PizzaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PizzaRepository::class)]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\ManyToOne(targetEntity: PizzaSize::class, inversedBy: 'pizzas')]
    #[ORM\JoinColumn(nullable: false)]
    private $size;

    #[ORM\ManyToOne(targetEntity: PizzaBase::class, inversedBy: 'pizzas')]
    #[ORM\JoinColumn(nullable: false)]
    private $base;

    #[ORM\OneToMany(mappedBy: 'base', targetEntity: self::class)]
    private $pizzas;

    #[ORM\ManyToMany(targetEntity: Ingredient::class, inversedBy: 'pizzas')]
    private $ingredients;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'pizzas')]
    private $creator;


    public function __construct()
    {
        $this->pizzas = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
        $this->shoppingCarts = new ArrayCollection();
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSize(): ?PizzaSize
    {
        return $this->size;
    }

    public function setSize(?PizzaSize $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getBase(): ?PizzaBase
    {
        return $this->base;
    }

    public function setBase(?PizzaBase $base): self
    {
        $this->base = $base;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getPizzas(): Collection
    {
        return $this->pizzas;
    }

    public function addPizza(self $pizza): self
    {
        if (!$this->pizzas->contains($pizza)) {
            $this->pizzas[] = $pizza;
            $pizza->setBase($this);
        }

        return $this;
    }

    public function removePizza(self $pizza): self
    {
        if ($this->pizzas->removeElement($pizza)) {
            // set the owning side to null (unless already changed)
            if ($pizza->getBase() === $this) {
                $pizza->setBase(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        $this->ingredients->removeElement($ingredient);

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }



    public function getTotalPrice(): int
    {
        return array_reduce(
            $this->ingredients->map(function ($item) {
                return $item->getUnitPrice();
            })->toArray(),
            static function ($acc, $current) {
                return $acc + $current;
            }
        )
            + $this->size->getPrice()
            + $this->base->getPrice();
    }
}
