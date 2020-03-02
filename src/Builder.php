<?php

namespace ChinLeung\Factories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

abstract class Builder
{
    /**
     * The model class that has been registered in the factory.
     *
     * @var string
     */
    protected $model;

    /**
     * The list of properties to pass to the factory.
     *
     * @var array
     */
    protected $properties = [];

    /**
     * Create a new instance of a factory builder.
     */
    public function __construct()
    {
        if (is_null($this->model)) {
            $this->model = config('factories.namespace').Str::replaceLast(
                'Factory',
                '',
                class_basename(get_called_class())
            );
        }
    }

    /**
     * Create the model.
     *
     * @param  int  $count
     * @return mixed
     */
    public function create(int $count = null)
    {
        return $this->build(true, $count);
    }

    /**
     * Create the model without saving it in the database.
     *
     * @param  int  $count
     * @return mixed
     */
    public function make(int $count = null)
    {
        return $this->build(false, $count);
    }

    /**
     * Hook to alter the model after it has been created.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return \Illuminate\Database\Eloquent\Model
     */
    protected function created(Model $model): Model
    {
        return $model;
    }

    /**
     * Set a property to pass to the factory.
     *
     * @param  string  $property
     * @param  mixed  $value
     * @return self
     */
    public function setProperty(string $property, $value)
    {
        Arr::set($this->properties, $property, $value);

        return $this;
    }

    /**
     * Retrieve the properties for the factory.
     *
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * Build the models with the parameters.
     *
     * @param  bool  $persistent
     * @param  int|null  $count
     * @return mixed
     */
    private function build(bool $persistent, ?int $count)
    {
        $method = $persistent ? 'create' : 'make';

        $models = factory($this->model, $count ?? 1)->{$method}(
            $this->getProperties()
        );

        $models->each(fn ($model) => $this->created($model, $persistent));

        return is_null($count) ? $models->first() : $models;
    }
}
