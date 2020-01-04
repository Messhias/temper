<?php

/**
 * @file     UsersReportsControllerTest.php
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    04/01/2020
 * @version  1.0
 */


namespace Tests\Unit;


use App\Http\Controllers\API\UsersReportsController;
use App\Repositories\API\UserReportRepository;
use Tests\TestCase;

class UsersReportsControllerTest extends TestCase
{
    protected UsersReportsController $controller;

    protected function setUp(): void
    {
        parent::setUp();

        $this->controller = new UsersReportsController(new UserReportRepository($this->createApplication()));
    }

    /**
     * test the class initialization.
     */
    public function testInit()
    {
        $this->assertIsObject($this->controller);
    }
}
