<?php

namespace Jo\IMAP\Data;

use Illuminate\Support\Collection;

class FoldersList extends Collection
{

    protected $children;
    
    /**
     * Get the value of children
     */ 
    public function getChildren()
    {
        return $this->children;
    }
}
