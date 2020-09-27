<?php

return [

    /*
     * The class to use to handle the export functionality
     */
    'exports' => \Rappasoft\LaravelLivewireTables\Exports\Export::class,

    /*
     * Which library you want to use for PDF generation
     * Supports dompdf, mpdf
     * You must install the appropriate third party package for each
     * See: https://docs.laravel-excel.com/3.1/exports/export-formats.html
     * And: https://phpspreadsheet.readthedocs.io/en/latest/topics/reading-and-writing-to-file/#pdf
     */
    'pdf_library' => 'dompdf',

    /*
     * The frontend styling framework to use
     * Options: bootstrap-4
     */
    'theme' => 'bootstrap-4',
];
