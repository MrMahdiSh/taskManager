<?php

namespace App\Services;

use App\Models\Session;
use App\Services\BaseService;

class SessionService extends BaseService
{
    public function __construct(Session $session)
    {
        parent::__construct($session);
    }
}