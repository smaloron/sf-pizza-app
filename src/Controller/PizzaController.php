<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Form\PizzaSearchType;
use App\Form\PizzaType;
use App\Repository\PizzaRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pizza')]
class PizzaController extends AbstractController
{
    #[Route('/', name: 'app_pizza_index', methods: ['GET'])]
    public function index(
        PizzaRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $form = $this->createForm(PizzaSearchType::class, null, [
            'method' => 'get',
            'attr' => ['class' =>'d-flex']
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //$search = $request->query->get('pizza_search');
            //dump($search);
            dump($request);
        }

        $pagination = $paginator->paginate(
            $repository->getAll(),
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('pizza/index.html.twig', [
            'pizzas' => $pagination,
            'searchForm' => $form->createView()
        ]);
    }

    #[Route('/new', name: 'app_pizza_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PizzaRepository $pizzaRepository): Response
    {
        $pizza = new Pizza();
        $pizza  ->setCreatedAt(new \DateTime())
                ->setCreator($this->getUser());

        $form = $this->createForm(PizzaType::class, $pizza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pizzaRepository->add($pizza);
            return $this->redirectToRoute('app_pizza_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pizza/new.html.twig', [
            'pizza' => $pizza,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pizza_show', methods: ['GET'])]
    public function show(Pizza $pizza): Response
    {
        return $this->render('pizza/show.html.twig', [
            'pizza' => $pizza,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pizza_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pizza $pizza, PizzaRepository $pizzaRepository): Response
    {
        $form = $this->createForm(PizzaType::class, $pizza);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pizzaRepository->add($pizza);
            return $this->redirectToRoute('app_pizza_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pizza/edit.html.twig', [
            'pizza' => $pizza,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pizza_delete', methods: ['POST'])]
    public function delete(Request $request, Pizza $pizza, PizzaRepository $pizzaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pizza->getId(), $request->request->get('_token'))) {
            $pizzaRepository->remove($pizza);
        }

        return $this->redirectToRoute('app_pizza_index', [], Response::HTTP_SEE_OTHER);
    }
}
