<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use App\Repository\ShoppingCartItemRepository;
use App\Repository\ShoppingCartRepository;
use App\Service\ShoppingCartService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/cart')]
class ShoppingCartController extends AbstractController
{

    private ShoppingCartService $cartService;

    /**
     * @param ShoppingCartService $cartService
     */
    public function __construct(ShoppingCartService $cartService)
    {
        $this->cartService = $cartService;
    }


    #[Route('/view', name: 'app_cart_view')]
    public function index(): Response
    {
        return $this->render('shopping_cart/index.html.twig', [
            'cart' => $this->cartService->getCart(),
        ]);
    }

    #[Route('/add/{id<\d+>}', name: 'app_cart_add')]
    public function addTo(
        Pizza $pizza,
    PizzaRepository $pizzaRepository){

        $this->cartService->addToCart($pizza);

        return $this->render('pizza/index.html.twig', [
            'pizzas' => $pizzaRepository->findAll(),
        ]);
    }

    #[Route('/ajax/addTo/{id<\d+>}', name: 'app_ajax_cart_add')]
    public function ajaxAddToCart(
        Pizza $pizza): Response{

        $this->cartService->addToCart($pizza);
        $cart = $this->cartService->getCart();

        return $this->json([
            "numberOfItems" => $cart->getItems()->count(),
            "totalPrice" => $cart->getTotal()
        ]);
    }

    #[Route('/ajax/details', name: 'app_ajax_cart_details')]
    public function ajaxCartDetails(): Response{

        $cart = $this->cartService->getCart();

        return $this->json([
            "numberOfItems" => $cart->getItems()->count(),
            "totalPrice" => $cart->getTotal()
        ]);
    }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    #[Route('/ajax/update', name: 'app_cart_ajax_update')]
    public function ajaxUpdate(
        Request $request,
        ShoppingCartItemRepository $itemRepository,
        ShoppingCartRepository $cartRepository): Response{

        $id = $request->get('id');
        $qt = $request->get('qt');

        $item = $itemRepository->findOneById($id);
        $item->setQt($qt);

       try {
            $itemRepository->add($item);

            $cart = $item->getShoppingCart();

            return $this->json([
                'itemTotal' => $item->getPrice(),
                'cartTotal' => $cart->getTotal()
            ]);
        } catch(Exception $e){
            return $this->json(['error' => $e->getMessage()], 500);
        }
    }

    #[Route('/ajax/remove', name: 'app_cart_ajax_delete')]
    public function ajaxDelete(
        Request $request,
        ShoppingCartItemRepository $itemRepository,
        EntityManagerInterface $manager
        ): Response{

        $id = $request->get('id');

        $item = $itemRepository->findOneById($id);

        try {
            $cart = $item->getShoppingCart();
            $cart->removeItem($item);
            $manager->persist($cart);
            $manager->flush();


            return $this->json([
                'itemTotal' => $item->getPrice(),
                'cartTotal' => $cart->getTotal()
            ]);

        } catch(Exception $e){
            return $this->json(['error' => $e->getMessage()], 500);
        }
    }


}
