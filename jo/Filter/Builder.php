<?php

namespace Jo\Filter;

use App\Models\Email;


class Builder
{
    protected $model;

    public function __construct(Email $model)
    {
        $this->model = $model;

        // was here before  vv
        // here we can add any possible joins that we need to implement
        // the filters whole scope

        // ...
    }

    public function from($name)
    {
        $this->model = $this->model->where('from', '=', $name);

        return $this;
    }
    
    /*
    public function where($property, $value, $operator = null)
    {
        $operator = $operator ?? '=';

        $this->model->where($property, $operator, $value);

        return $this;
    }
    */

    public function get()
    {
        return $this->model->get();
    }


    public function __call($method, $parameters)
    {
        return $this->model->$method(...$parameters);
    }
}