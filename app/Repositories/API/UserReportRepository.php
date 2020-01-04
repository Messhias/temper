<?php

/**
 * @file     UserReportRepository.php
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    01/01/2020
 * @version  1.0
 */


namespace App\Repositories\API;


use App\Classes\CSVReports;
use App\Models\User\Reports;
use App\Repositories\RepositoryEloquent;
use App\Traits\CSVReportTrait;
use Illuminate\Container\Container as App;
use Symfony\Component\Debug\Exception\FatalThrowableError;

/**
 * Default user reports class to be a layer between the controller and models.
 * Also this class can handle csv files and for assessment purposes we use a custom constructor.
 *
 * All the necessary information it's on the methods bellow.
 *
 * Class UserReportRepository
 * @package App\Repositories\API
 */
class UserReportRepository extends RepositoryEloquent
{
    use CSVReportTrait;

    /**
     * The CSV parsed array, it could be mixed since if you want to work with
     * the file itself.
     *
     * @var mixed
     */
    private $csv;

    /**
     * @return mixed
     */
    public function getCSV()
    {
        return $this->csv;
    }

    /**
     * @param mixed $csv
     */
    public function setCSV($csv): void
    {
        $this->csv = $csv;
    }

    /**
     * @inheritDoc
     */
    protected function model()
    {
        return Reports::class;
    }

    /**
     * @inheritDoc
     */
    protected function module()
    {
        return "User report";
    }

    /**
     * @inheritDoc
     */
    protected function redis_key()
    {
        return Reports::class;
    }

    /**
     * It's not normal the repository that extends the RepositoryEloquent class has a class
     * constructor, but since this is a special case and we need to filter a file with .csv extension
     * it's best for us trait this information at beginning of class construction.
     *
     * UserReportRepository constructor.
     * @param App $app
     * @throws \Exception
     */
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->setCSV($this->filterCSVData("export.csv"));
    }

    /**
     * @inheritDoc
     * @override
     */
    public function get()
    {
        $result = new CSVReports($this->getCSV());


        return $result->getReportResult();
    }
}
