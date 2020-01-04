<?php

/**
 * @file     CSVReportTrait.php
 * @author   Fabio William Conceição <messhias@gmail.com>
 * @since    01/01/2020
 * @version  1.0
 */


namespace App\Traits;


/**
 * Supportive trait to handle CSV provided files as report for
 * users reports.
 *
 * Trait CSVReportTrait
 * @package App\Traits
 */
trait CSVReportTrait
{
    /**
     * We receive the file itself and the kind of delimiter
     * that the CSV holds, by default the .csv files has ';' delimiters
     * but also is common we see delimiters using ','.
     *
     * @param $file
     * @param string $delimiter
     * @param int $length
     * @return array
     */
    public function filterCSVData($file, $delimiter = ";", int $length = 1000)
    {
        try
        {
            if ($file && !empty($delimiter))
            {
                if (file_exists(storage_path($file)))
                {

                    $file = storage_path($file);
                    $csv = [];
                    $keys = [];
                    if (($handle = fopen($file, "r")) !== false)
                    {
                        // open for reading
                        if (($data = fgetcsv($handle, $length, $delimiter)) !== false)
                        {
                            // extract header data and save as keys.
                            $keys = $data;
                        }
                        // loop remaining rows of data
                        while (($data = fgetcsv($handle, $length, $delimiter)) !== false)
                        {
                            // push associative sub arrays
                            $csv[] = array_combine($keys, $data);
                        }
                        // close when done
                        fclose($handle);
                    }

                    unset($keys);

                    return $csv;

                }

                return [];

            }
            else
            {
                return [];
            }

        }
        catch (\Exception $exception)
        {
            error_log($exception);
            return [];
        }
    }
}
