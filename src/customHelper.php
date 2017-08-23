<?php

namespace viotile\excel;

use PHPExcel_IOFactory;

/**
 * Created by PhpStorm.
 * User: viotile development
 * Date: 22-08-2017
 * Time: 04:39 PM
 */
class customHelper
{
    /**
     * @var string
     */
    private $inputFileName;

    /**
     * customHelper constructor.
     */
    public function __construct($filepath = '')
    {
        if (!empty($filepath)) {
            $this->setInputFileName($filepath);
        }
    }

    /**
     * @return string
     */
    public function getInputFileName()
    {
        return $this->inputFileName;
    }

    /**
     * @param string $inputFileName
     */
    public function setInputFileName($inputFileName)
    {
        $this->inputFileName = $inputFileName;
    }


    /**
     * Read Excel file and return data array on success
     * @return array|bool
     */
    function import($fileName = '')
    {
        if (!empty($filepath)) {
            $this->setInputFileName($filepath);
        }

        if (empty($this->getInputFileName())) {
            return false;
        }

        //  Read your Excel workbook
        try {
            $inputFileType = PHPExcel_IOFactory::identify($this->getInputFileName());
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($this->getInputFileName());
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($this->getInputFileName(), PATHINFO_BASENAME) . '": ' . $e->getMessage());
        }

        //Itrating through all the sheets in the excel workbook and storing the array data
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            $data = $worksheet->toArray();
            $data = array_map('array_filter', $data);
            $data = array_filter($data);
        }
        return $data;
    }
}