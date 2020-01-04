<?php

/**
 * @file     CSVReportTraitTest.php
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    04/01/2020
 * @version  1.0
 */


namespace Tests\Unit;


use App\Traits\CSVReportTrait;
use Tests\TestCase;

class CSVReportTraitTest extends TestCase
{
    use CSVReportTrait;

    protected $file;

    /**
     * Set up the variables necessary for the unit testing.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->file = storage_path("export.csv");
    }

    /**
     * Test the filter function of the trait of the CSV.
     */
    public function testFilterCSVData()
    {
        $this->assertIsArray($this->filterCSVData($this->file, ";"));
    }
}
