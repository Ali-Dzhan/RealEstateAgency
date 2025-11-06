<?php

if (! function_exists('export_csv')) {

    function export_csv($filename, $headers, $rows)
    {
        return response()->stream(function () use ($headers, $rows) {
            $handle = fopen('php://output', 'w');

            // Fix Cyrillic
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($handle, $headers);

            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }

            fclose($handle);
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}

