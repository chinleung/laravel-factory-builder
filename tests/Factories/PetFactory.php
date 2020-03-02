<?php

namespace ChinLeung\Factories\Tests\Factories;

use ChinLeung\Factories\Builder;
use ChinLeung\Factories\Tests\Models\Pet;
use ChinLeung\Factories\Tests\Models\User;

class PetFactory extends Builder
{
    /**
     * The class of the model for the factory.
     *
     * @var string
     */
    protected $model = Pet::class;

    /**
     * Set the owner of the pet.
     *
     * @param  \ChinLeung\Factories\Tests\Models\User  $user
     * @return self
     */
    public function withOwner(User $user): self
    {
        return $this->setProperty('user_id', $user->id);
    }
}
