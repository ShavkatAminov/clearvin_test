<?php

namespace App\Transformer;

abstract class BaseTransformer
{
    /**
     * @param $entry
     * @return array
     */
    public function getFormattedData($entry): ?array
    {
        return is_array($entry) ? $this->getMultiFormatted($entry) : $this->getSingleFormatted($entry);
    }

    protected function getSingleFormatted($entry): ?array
    {
        if (!$entry) {
            return null;
        }
        return $this->format($entry);
    }

    protected function getMultiFormatted($entry): array
    {
        $formatted = [];
        foreach ($entry as $index => $item) {
            $formatted[$index] = $this->format($item);
        }
        return $formatted;
    }

    /**
     * @param $entity
     * @return array
     */
    protected abstract function format($entity):array;

}