<?php

namespace App\Factory;

use App\Entity\Pizza;
use App\Repository\PizzaRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Pizza>
 *
 * @method static Pizza|Proxy createOne(array $attributes = [])
 * @method static Pizza[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Pizza|Proxy find(object|array|mixed $criteria)
 * @method static Pizza|Proxy findOrCreate(array $attributes)
 * @method static Pizza|Proxy first(string $sortedField = 'id')
 * @method static Pizza|Proxy last(string $sortedField = 'id')
 * @method static Pizza|Proxy random(array $attributes = [])
 * @method static Pizza|Proxy randomOrCreate(array $attributes = [])
 * @method static Pizza[]|Proxy[] all()
 * @method static Pizza[]|Proxy[] findBy(array $attributes)
 * @method static Pizza[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Pizza[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PizzaRepository|RepositoryProxy repository()
 * @method Pizza|Proxy create(array|callable $attributes = [])
 */
final class PizzaFactory extends ModelFactory
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
            'name' => 'Pizza ' .self::faker()->words(1, true),
            'createdAt' => self::faker()->datetime(),
            'size' => PizzaSizeFactory::random(),
            'base' => PizzaBaseFactory::random(),
            'ingredients' => [],
            'creator' => null
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Pizza $pizza): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Pizza::class;
    }
}
