<?php

namespace ChinLeung\Tests;

use ChinLeung\Factories\FactoriesServiceProvider;
use ChinLeung\Factories\Tests\Factories\UserFactory;
use ChinLeung\Factories\Tests\Models\User;
use Facades\ChinLeung\Factories\Tests\Factories\UserFactory as UserFactoryFacade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase;

class BuilderTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup for the tests.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        config([
            'factories.namespace' => 'ChinLeung\\Factories\\Tests\\Models',
        ]);

        $this->withFactories(__DIR__.'/database/factories');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * A new user can be created.
     *
     * @test
     * @return void
     */
    public function a_new_user_can_be_created(): void
    {
        $this->assertInstanceOf(
            User::class,
            $user = app(UserFactory::class)->create()
        );

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }

    /**
     * A new user can be created via the real-time facade.
     *
     * @test
     * @depends a_new_user_can_be_created
     * @return void
     */
    public function a_new_user_can_be_created_via_the_real_time_facade(): void
    {
        $this->assertInstanceOf(
            User::class,
            $user = UserFactoryFacade::create()
        );

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
        ]);
    }

    /**
     * A new user can be created without being persistent.
     *
     * @test
     * @return void
     */
    public function a_new_user_can_be_created_without_persistence(): void
    {
        $this->assertInstanceOf(
            User::class,
            $user = app(UserFactory::class)->make()
        );

        $this->assertFalse($user->exists);

        $this->assertCount(0, User::all());
    }

    /**
     * A new user with a pet can be created.
     *
     * @test
     * @return void
     */
    public function a_new_user_with_a_pet_can_be_created(): void
    {
        $user = app(UserFactory::class)->withPets(3)->create();

        $this->assertCount(3, $user->pets);
    }

    /**
     * Retrieve the providers of the application.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            FactoriesServiceProvider::class,
        ];
    }
}
