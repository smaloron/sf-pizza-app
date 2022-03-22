<?php

namespace App\Factory;

use App\Entity\PizzaSize;
use App\Repository\PizzaSizeRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<PizzaSize>
 *
 * @method static PizzaSize|Proxy createOne(array $attributes = [])
 * @method static PizzaSize[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static PizzaSize|Proxy find(object|array|mixed $criteria)
 * @method static PizzaSize|Proxy findOrCreate(array $attributes)
 * @method static PizzaSize|Proxy first(string $sortedField = 'id')
 * @method static PizzaSize|Proxy last(string $sortedField = 'id')
 * @method static PizzaSize|Proxy random(array $attributes = [])
 * @method static PizzaSize|Proxy randomOrCreate(array $attributes = [])
 * @method static PizzaSize[]|Proxy[] all()
 * @method static PizzaSize[]|Proxy[] findBy(array $attributes)
 * @method static PizzaSize[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static PizzaSize[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PizzaSizeRepository|RepositoryProxy repository()
 * @method PizzaSize|Proxy create(array|callable $attributes = [])
 */
final class PizzaSizeFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'name' => self::faker()->text(),
            'price' => self::faker()->randomNumber(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(PizzaSize $pizzaSize): void {})
        ;
    }

    protected static function getClass(): string
    {
        return PizzaSize::class;
    }
}
