<?php

namespace Jo\Abstracts;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    public function create($data)
    {
        return $this->model->create($data);
    }

    public function updateOrCreate($attributes, $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    public function createOrUpdate($data, $idField = 'id')
    {
        // try to find the instance
        if (is_array($idField))
        {
            // init a builder
            $builder = $this->model;

            foreach ($idField as $field)
            {
                $builder->where($field, '=', $data[$field]);
            }

            $model = $builder->first();
        }
        else
        {
            $model = $this->find($data[$idField]);
        }

        if ($model)
        {
            // record exists, lets update it
            $updateResult = $this->update($model->id, $data);

            // return model -- or return $model ?
            return $this->find($model->id);
        }
        else
        {
            // record doesn't exist, lets create it, then return it
            return $this->create($data);
        }
    }

    public function find($id, $eagerLoadRelations = [])
    {
        return $this->model->with($eagerLoadRelations)->find($id);
    }

    public function findOrFail($id, $eagerLoadRelations = [])
    {
        return $this->model->with($eagerLoadRelations)->findOrFail($id);
    }

    public function all($eagerLoadRelations = [])
    {
        return $this->model->all()->load($eagerLoadRelations);
    }


    public function paginate($pagination = 15, $eagerLoadRelations = [])
    {
        return $this->model->with($eagerLoadRelations)->paginate($pagination);
    }

    public function update($id, $data)
    {
        // this uses the class's findOrFail method
        return $this->findOrFail($id, [])->update($data);
    }

    public function delete($id)
    {
        // this uses the class's findOrFail method
        return $this->findOrFail($id, [])->delete($id);
    }

    public function destroy($ids)
    {
        return $this->model->destroy($ids);
    }



    public function getOptionList($header = [], $titleProperty = 'name')        # this $titleProperty could be a model and/or Repo's property
    {
        $list = $this->model->all()
            ->sortBy($titleProperty)
            ->pluck($titleProperty, 'id')
#            ->lists($titleProperty, 'id')
            ->toArray();

        return (empty($header))
            ? $list
            : $header + $list;
    }


    public function getFiltersBuilder($relations = [])
    {
        return $this->model->with($relations);
    }


    public function filtersB($attributes)
    {
        // create builder object
        $builder = $this->getFiltersBuilder();

        // add filters
        foreach ($attributes as $fieldName => $_)
        {
            $isSpecial = substr($fieldName, 0, 1) == '_';

            if ($isSpecial)
            {
                // special attribute - filter for relations
                $this->addFilter($builder, $fieldName, $_);
            }
            else
            {
                // normal field attribute filter
                list($operator, $value) = $this->parseAttribute($_);

                // we add the filter into the builder, according to operator
                if ($operator == 'between')
                {
                    $builder->whereBetween($fieldName, $value);
                }
                elseif ($operator == 'in')
                {
                    $builder->whereIn($fieldName, $value);
                }
                else
                {
                    $builder->where($fieldName, $operator, $value);
                }
            }
        }

        // return the builder
        return $builder;
    }

    // Protected / Private internal convenience functions ----------------------


    # 'field' => 'exact'                    ['=', 'exact']
    # 'field' => ['<>', 'exact']            ['<>', 'exact']
    # 'field' => ['between', ['a', 'b']     ['between', 'a AND b']

    protected function parseAttribute($filterValue)
    {
        // here was // zhuangzi style :)
        /*
         * return (is_array($filterValue)) ? $filterValue : ['=', $filterValue];
         * * returning just whatever was there to be handled by laravel, if
         * * it was an array or a nested array..
         */

        // zhuangzi version, since we check operator later
        return (is_array($filterValue)) ? $filterValue : ['=', $filterValue];

        /*
        return (is_array($filterValue))
            ? [
                $filterValue[0],                        # operator
                is_array($filterValue[1])               # is multi parameter?
                    ? implode(' AND ', $filterValue[1]) # y? implode!
                    : $filterValue[1]                   # n? ret!
              ]
            : ['=', $filterValue];                      # not arr? mk with =
         */
    }


    // to override as per below
    protected function addFilter($bulder, $fieldName, $_)
    {
        // add filters on builder depending the fieldname
        switch ($fieldName)
        {
            # syntax '_clients' : array of client_id
            /*
            case '_clients':
                $builder->whereHas('client', function ($query) use ($_) {
                    $query->whereIn('id', $_);
                });
                break;
            */
        }

        // return builder instance
        return $builder;
    }

}
