<?php

namespace App\Entity;

use App\Repository\ShoppingCartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: ShoppingCartRepository::class)]
class ShoppingCart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToOne(inversedBy: 'cart', targetEntity: User::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $client;

    #[ORM\OneToMany(
        mappedBy: 'shoppingCart',
        targetEntity: ShoppingCartItem::class,
        cascade: ['persist', 'remove'])]
    private Collection $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(User $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection<int, ShoppingCartItem>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(ShoppingCartItem $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setShoppingCart($this);
        }

        return $this;
    }

    public function removeItem(ShoppingCartItem $item): self
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getShoppingCart() === $this) {
                $item->setShoppingCart(null);
            }
        }

        return $this;
    }

    public function getTotal(): int{
        $total = 0;
        foreach ($this->items as $item){
            $total += $item->getPrice();
        }

        return $total;
    }

}
