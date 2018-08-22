<?php

namespace Jo\Resources\Repos;

use App\EmailAccount;
use Jo\Abstracts\AbstractRepository;

class EmailAccountsRepo extends AbstractRepository
{
    public function __construct(EmailAccount $model)
    {
        parent::__construct($model);
    }
}
