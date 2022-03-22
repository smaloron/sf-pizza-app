<?php

namespace App\Entity;

use App\Repository\ShoppingCartItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ShoppingCartItemRepository::class)]
class ShoppingCartItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $qt;

    #[ORM\ManyToOne(targetEntity: ShoppingCart::class, inversedBy: 'items')]
    private $shoppingCart;

    #[ORM\ManyToOne(targetEntity: Pizza::class)]
    private $pizza;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQt(): ?int
    {
        return $this->qt;
    }

    public function setQt(int $qt): self
    {
        $this->qt = $qt;

        return $this;
    }

    public function getPrice(): int{
        return $this->pizza->getTotalPrice() * $this->qt;
    }

    public function getShoppingCart(): ?ShoppingCart
    {
        return $this->shoppingCart;
    }

    public function setShoppingCart(?ShoppingCart $shoppingCart): self
    {
        $this->shoppingCart = $shoppingCart;

        return $this;
    }

    public function getPizza(): ?Pizza
    {
        return $this->pizza;
    }

    public function setPizza(?Pizza $pizza): self
    {
        $this->pizza = $pizza;

        return $this;
    }

    public function increaseQt(int $val = 1): void{
        $this->qt += 1;
    }
}
