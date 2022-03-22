<?php

namespace App\Service;

use App\Entity\Pizza;
use App\Entity\ShoppingCart;
use App\Entity\ShoppingCartItem;
use App\Repository\ShoppingCartItemRepository;
use App\Repository\ShoppingCartRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class ShoppingCartService
{
    private ShoppingCartRepository $cartRepository;
    private ShoppingCartItemRepository $itemRepository;
    private EntityManagerInterface $manager;
    private Security $security;
    private RequestStack $requestStack;

    /**
     * @param ShoppingCartRepository $cartRepository
     * @param ShoppingCartItemRepository $itemRepository
     * @param EntityManagerInterface $manager
     */
    public function __construct(
        ShoppingCartRepository $cartRepository,
        ShoppingCartItemRepository $itemRepository,
        EntityManagerInterface $manager,
        Security $security,
        RequestStack $requestStack
    ) {
        $this->cartRepository = $cartRepository;
        $this->itemRepository = $itemRepository;
        $this->manager = $manager;
        $this->security = $security;
        $this->requestStack = $requestStack;
    }

    public function getCart(){
        $user = $this->security->getUser();
        $cart = $this->cartRepository->getShoppingCart($user);

        if(! $cart){
            $cart = new ShoppingCart();
            $cart->setClient($user);
        }

        return $cart;
    }

    public function addToCart(Pizza $pizza){
        $cart = $this->getCart();
        $item = $this->itemRepository->findOneBy([
            'shoppingCart' => $cart,
            'pizza' => $pizza
        ]);

        dump($item);

        if($item){

            $item->increaseQt();
            $this->manager->persist($cart);
            $this->manager->flush();
        } else {
            $item = new ShoppingCartItem();
            $item->setPizza($pizza);
            $item->setShoppingCart($cart);
            $item->setQt(1);

            $cart->addItem($item);
        }

        $this->cartRepository->add($cart);

    }




}