<?php

/**
 * @file     CSVReports.php
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    02/01/2020
 * @version  1.0
 */


namespace App\Classes;


/**
 * Class CSVReports
 * @package App\Classes
 */
class CSVReports
{
    /**
     * The reports passed to array.
     * The reports to treatment should be receive as array.
     *
     * @var array
     */
    private array $report = [];

    /**
     * @var array
     */
    protected array $reportResult = [];

    /**
     * @return array
     */
    public function getReportResult(): array
    {
        return $this->reportResult;
    }

    /**
     * @param array $reportResult
     */
    public function setReportResult(array $reportResult): void
    {
        $this->reportResult = $reportResult;
    }

    /**
     * @return array
     */
    public function getReport(): array
    {
        return $this->report;
    }

    /**
     * @param array $report
     */
    public function setReport(array $report): void
    {
        $this->report = $report;
    }

    /**
     * Receive the report file array to filter and make all the data
     * treatment at the class constructor.
     *
     * CSVReports constructor.
     * @param array $report
     */
    public function __construct(array $report = [])
    {
        if (!is_array($report))
        {
            $this->setReportResult([]);
            $this->setReport([]);
        }
        else
        {
            $this->setReport($report);
            $this->setUpReport($report);
        }

    }

    /**
     * While the constructor is called we start set up all the data.
     * Here we receive the report variable as reference to point to same
     * address on the memory.
     *
     * @param array $report
     */
    private function setUpReport(array &$report = [])
    {
        try
        {
           if (!empty($report))
           {
               $this->setUpWeeklyRetention($report);
           }
           else
           {
                $this->setReportResult([]);
           }
        }
        catch (\Exception $exception)
        {
            error_log($exception);

            $this->setReportResult([]);
        }
    }

    /**
     * Set up the weekly retention reports.
     *
     * @param array $report
     */
    private function setUpWeeklyRetention(array &$report = [])
    {
        $result = [];

        array_map(function($data) use (&$result) {
            $week = new \DateTime($data['created_at']);
            $first_day_week = new \DateTime();
            $first_day_week->setISODate($week->format("Y"), $week->format("W"));

            $data['week'] = $week->format("W");

            $result[$first_day_week->format('d/m/Y')][] = $data;
        }, $report);

        $this->setReportResult($result);
    }
}
