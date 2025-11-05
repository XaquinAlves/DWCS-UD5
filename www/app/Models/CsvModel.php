<?php

declare(strict_types=1);

namespace Com\Daw2\Models;

class CsvModel
{
    private $filename;

    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }

    public function getPoblacionPontevedra(): array
    {
        $csvFile = file($this->filename);
        $data = [];

        foreach ($csvFile as $line) {
            $data[] = str_getcsv($line, ";");
        }

        return $data;
    }
}
