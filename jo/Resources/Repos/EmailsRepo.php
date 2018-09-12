<?php

namespace Jo\Resources\Repos;

use App\Models\Email;
use Jo\Abstracts\AbstractRepository;

class EmailsRepo extends AbstractRepository
{
    public function __construct(Email $model)
    {
        parent::__construct($model);
    }
}
