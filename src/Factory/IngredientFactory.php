<?php

namespace App\Factory;

use App\Entity\Ingredient;
use App\Repository\IngredientRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Ingredient>
 *
 * @method static Ingredient|Proxy createOne(array $attributes = [])
 * @method static Ingredient[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Ingredient|Proxy find(object|array|mixed $criteria)
 * @method static Ingredient|Proxy findOrCreate(array $attributes)
 * @method static Ingredient|Proxy first(string $sortedField = 'id')
 * @method static Ingredient|Proxy last(string $sortedField = 'id')
 * @method static Ingredient|Proxy random(array $attributes = [])
 * @method static Ingredient|Proxy randomOrCreate(array $attributes = [])
 * @method static Ingredient[]|Proxy[] all()
 * @method static Ingredient[]|Proxy[] findBy(array $attributes)
 * @method static Ingredient[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Ingredient[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static IngredientRepository|RepositoryProxy repository()
 * @method Ingredient|Proxy create(array|callable $attributes = [])
 */
final class IngredientFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'name' => self::faker()->text(),
            'unitPrice' => self::faker()->randomNumber(),
            'calories' => self::faker()->randomNumber(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Ingredient $ingredient): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Ingredient::class;
    }
}
