<?php

/**
 * @file     CSVReportsClassTest.php
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    04/01/2020
 * @version  1.0
 */


namespace Tests\Unit;


use App\Classes\CSVReports;
use App\Traits\CSVReportTrait;
use Tests\TestCase;

class CSVReportsClassTest extends TestCase
{
    use CSVReportTrait;

    /**
     * The property MUST BE a type of CSV Reports.
     *
     * @var CSVReports
     */
    protected CSVReports $csvReport;

    /**
     * Test the class with custom input array.
     */
    public function testClassInitWithCustomArray()
    {
        $this->csvReport = new CSVReports([
            [
                "user_id" => "3525",
                "created_at" => "2016-08-10",
                "onboarding_perentage" => "99",
                "count_applications" => "0",
                "count_accepted_applications" => "0",
                "week" => "32"
            ],
            [
                "user_id" => "3526",
                "created_at" => "2016-08-10",
                "onboarding_perentage" => "99",
                "count_applications" => "0",
                "count_accepted_applications" => "0",
                "week" => "32"
            ],
        ]);

        $this->assertIsArray($this->csvReport->getReportResult());
    }

    /**
     * Test the class with .csv file input.
     */
    public function testClassInitWithCSVFile()
    {
        $this->csvReport = new CSVReports($this->filterCSVData(storage_path("export.csv")));

        $this->assertIsArray($this->csvReport->getReportResult());
    }

    /**
     * Test the class stability with empty array object.
     */
    public function testClassInitWithEmptyArray()
    {
        $this->csvReport = new CSVReports([]);

        $this->assertIsArray($this->csvReport->getReportResult());
    }
}
