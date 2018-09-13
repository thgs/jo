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

    public function storeBulkFromImap($messages, $emailAccountId)
    {
        $models = [];
        foreach ($messages as $m)
        {

            $data = [
                'uid'       => $m->getUid(),
                'from'      => $m->getFrom(),
                'cc'        => $m->getCc(),
                'bcc'       => $m->getBcc(),
                'to'        => $m->getTo(),
                'reply_to'  => $m->getReplyTo(),
                'subject'   => $m->getSubject(),
                'body'      => $m->hasHTMLBody()
                                ? $m->getHTMLBody()
                                : $m->getTextBody(),
                'flags'     => $m->getFlags(),
                'priority'  => $m->getPriority(),

                'email_account_id' => $emailAccountId,
            ];

            $models[] = $this->create($data);
        }

        return $models;
    }
}
