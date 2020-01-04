<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResourceAPIController;
use App\Repositories\API\UserReportRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UsersReportsController extends ResourceAPIController
{
    //
    /**
     * @inheritDoc
     */
    protected function getKeyIdentifier()
    {
        return "users_reports";
    }

    /**
     * @inheritDoc
     */
    protected function getSingularIdentifier()
    {
        return "User Report";
    }

    /**
     * @inheritDoc
     */
    protected function getPluralIdentifier()
    {
        return "Users Reports";
    }

    /**
     * @inheritDoc
     */
    protected function foundMessage(): string
    {
        return "Found " . strtolower($this->getPluralIdentifier());
    }

    /**
     * @inheritDoc
     */
    protected function createMessage(): string
    {
        return "Created " . strtolower($this->getSingularIdentifier());
    }

    /**
     * @inheritDoc
     */
    protected function updateMessage(): string
    {
        return "Updated " . strtolower($this->getSingularIdentifier());
    }

    /**
     * @inheritDoc
     */
    protected function deletedMessage(): string
    {
        return "Deleted " . strtolower($this->getSingularIdentifier());
    }

    /**
     * @inheritDoc
     */
    protected function genericMessage(): string
    {
        return "Operation complete";
    }

    /**
     * UsersReportsController constructor.
     * @param UserReportRepository $repository
     */
    public function __construct(UserReportRepository $repository)
    {
        $this->setRepository($repository);
    }
}
