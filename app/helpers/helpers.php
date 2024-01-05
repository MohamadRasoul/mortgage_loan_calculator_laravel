<?php


if (!function_exists('convertDecimalToYearsMonths')) {
    function convertDecimalToYearsMonths($decimalYears)
    {
        // Get the integer part (years) and the decimal part (months)
        $years = floor($decimalYears);
        $months = round(($decimalYears - $years) * 12);


        $output = "{$years} Years, {$months} Months";

        // Format the result
        return $output;
    }
}
