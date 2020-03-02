<?php

namespace ChinLeung\Factories\Tests\Factories;

use ChinLeung\Factories\Builder;
use ChinLeung\Factories\Tests\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserFactory extends Builder
{
    /**
     * The class of the model for the factory.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * The number of pets each user has.
     *
     * @var int
     */
    protected $pets = 0;

    /**
     * Hook to alter the created user to create the pets.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function created(Model $user): Model
    {
        app(PetFactory::class)->withOwner($user)->create($this->pets);

        return $user;
    }

    /**
     * Set the number of pets for the users.
     *
     * @param  int  $count
     * @return self
     */
    public function withPets(int $count): self
    {
        $this->pets = $count;

        return $this;
    }
}
