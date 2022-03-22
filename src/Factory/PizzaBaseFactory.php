<?php

namespace App\Factory;

use App\Entity\PizzaBase;
use App\Repository\PizzaBaseRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<PizzaBase>
 *
 * @method static PizzaBase|Proxy createOne(array $attributes = [])
 * @method static PizzaBase[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static PizzaBase|Proxy find(object|array|mixed $criteria)
 * @method static PizzaBase|Proxy findOrCreate(array $attributes)
 * @method static PizzaBase|Proxy first(string $sortedField = 'id')
 * @method static PizzaBase|Proxy last(string $sortedField = 'id')
 * @method static PizzaBase|Proxy random(array $attributes = [])
 * @method static PizzaBase|Proxy randomOrCreate(array $attributes = [])
 * @method static PizzaBase[]|Proxy[] all()
 * @method static PizzaBase[]|Proxy[] findBy(array $attributes)
 * @method static PizzaBase[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static PizzaBase[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PizzaBaseRepository|RepositoryProxy repository()
 * @method PizzaBase|Proxy create(array|callable $attributes = [])
 */
final class PizzaBaseFactory extends ModelFactory
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
            'price' => self::faker()->randomNumber(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(PizzaBase $pizzaBase): void {})
        ;
    }

    protected static function getClass(): string
    {
        return PizzaBase::class;
    }
}
