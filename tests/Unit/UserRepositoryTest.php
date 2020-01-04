<?php

/**
 * @file     UserRepositoryTest.php
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    04/01/2020
 * @version  1.0
 */


namespace Tests\Unit;


use App\Models\User\Reports;
use App\Repositories\API\UserReportRepository;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    protected UserReportRepository $repository;

    /**
     * @throws \Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new UserReportRepository($this->createApplication());
        $this->repository->setModel(Reports::class);
        $this->repository->setModel(Reports::class);
    }

    /**
     * First we test if the file exists
     */
    public function testCSVFileExist()
    {
        $this->assertFileExists(storage_path("export.csv"), "File exist.");
    }

    /**
     * Test if we can set and retrieve the file that we want to.
     */
    public function testSetCSVFile()
    {
        $this->repository->setCSV(storage_path("export.csv"));
        $this->assertFileEquals(storage_path("export.csv"), $this->repository->getCSV(), "File retrieved.");
    }

    /**
     * Test if the repository return an array and handle the errors gracefully.
     */
    public function testGet()
    {
        $this->assertIsArray($this->repository->get(), "Get returned right information.");
    }
}
