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

    public function storeBulkFromImap($messages, $emailAccountId, $mailbox = 'INBOX')
    {
        $models = [];
        foreach ($messages as $m)
        {
            // here is where i think laravel-imap has some issues..

            // we need to call this before asking for bodies
            $m->parseBody();
            $data = [
                'uid'       => $m->getUid(),
                // changed to $mailbox, since $m->getContainingFolder doesnt
                // seem to work (tries localhost ?)
                'mailbox'   => $mailbox,
                'from'      => $m->getFrom()[0]->full,
                'cc'        => $this->consolidate_array($m->getCc()),
                'bcc'       => $this->consolidate_array($m->getBcc()),
                'to'        => $this->consolidate_array($m->getTo()),
                'reply_to'  => $this->consolidate_array($m->getReplyTo()),
                'subject'   => $m->getSubject(),
                'body'      => $m->hasHTMLBody()
                                ? $m->getHTMLBody()
                                : $m->getTextBody(),
                'flags'     => (string) $m->getFlags(),
                'priority'  => $m->getPriority(),

                'email_account_id' => $emailAccountId,
            ];

            $models[] = $this->create($data);
        }

        return $models;
    }

    private function consolidate_array(array $a)
    {
        $fulls = array_map(
            function ($x) { return $x->full ?? ''; },
            $a
        );
        return implode('|', $fulls);
    }
}
