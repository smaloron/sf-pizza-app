<?php

namespace App\DataFixtures;

use App\Factory\IngredientFactory;
use App\Factory\PizzaBaseFactory;
use App\Factory\PizzaFactory;
use App\Factory\PizzaSizeFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Taille des pizzas

        PizzaSizeFactory::createOne([
            'name' => 'Petite',
            'price' => 3
        ]);
        PizzaSizeFactory::createOne([
            'name' => 'Moyenne',
            'price' => 5
        ]);
        PizzaSizeFactory::createOne([
            'name' => 'Grande',
            'price' => 8
        ]);

    // Base des pizzas
        PizzaBaseFactory::createOne([
            'name' => 'Tomate',
            'price' => 2
        ]);
        PizzaBaseFactory::createOne([
            'name' => 'Crème',
            'price' => 3
        ]);

        // Ingrédients
        IngredientFactory::createOne([
            'name' => 'Poivrons',
            'unitPrice' => 2,
            'calories' => 2,
        ]);
        IngredientFactory::createOne([
            'name' => 'Oignons',
            'unitPrice' => 3,
            'calories' => 3,
        ]);


        IngredientFactory::createOne([
            'name' => 'Fromage',
            'unitPrice' => 4,
            'calories' => 8,
        ]);
        IngredientFactory::createOne([
            'name' => 'Formage de chèvre',
            'unitPrice' => 4,
            'calories' => 6,
        ]);


        IngredientFactory::createOne([
            'name' => 'Poulet',
            'unitPrice' => 5,
            'calories' => 9,
        ]);
        IngredientFactory::createOne([
            'name' => 'Jambon',
            'unitPrice' => 5,
            'calories' => 10,
        ]);


        UserFactory::createOne([
            'email' => 'moi@moi.com',
            'plainPassword' => '123'
        ]);

        PizzaFactory::new()->many(30)->create(function(){
            return [
                'ingredients' => IngredientFactory::randomRange(1,4)
            ];
        });


    }
}
