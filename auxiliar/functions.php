<?php

    function arrayToHtml($array, $table = true)
    {
        $out = '';
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (!isset($tableHeader)) {
                    $tableHeader =
                        '<thead><th>' .
                        implode('</th><th>', array_keys($value)) .
                        '</th></thead>';
                }
                array_keys($value);
                $out .= '<tr>';
                $out .= arrayToHtml($value, false);
                $out .= '</tr>';
            } else {
                $out .= "<td>$value</td>";
            }
        }

        if ($table) {
            return '<table class="table table-striped table-hover">' . $tableHeader . $out . '</table>';
        } else {
            return $out;
        }
    }

    function updateModal()
    {
    }
?>