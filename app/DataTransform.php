<?php

declare(strict_types=1);


namespace App;


use App\Contract\DataTransformInterface;

final class DataTransform implements DataTransformInterface
{
    public function __construct(
        private CSVFileHandler $csvFileHandler,
        private JSONFileHandler $jsonFileHandler
    ){}

    private function filter(): ?array
    {
        $result = [];
        foreach($this->csvFileHandler->read() as $key => $line) {
            if ($key !== 0) {
                $result[] =  [
                    'itemName' => $line[0],
                    'parent' => $line[2] !== "" ? $line[2] : null
                ];
            }
        };
        return $result;
    }

    private function getTree(): array
    {
        return $this->buildTree($this->filter());
    }

    private function buildTree(array &$array, string $parentId = ""): array
    {
        $branch = [];

        foreach ($array as  $key => $element) {
            if ($element['parent'] == $parentId) {
                $children = $this->buildTree($array, $element['itemName']);
                $element['children'] = $children;

                $branch[] = $element;
                unset($array[$key]);
            }
        }

        return $branch;
    }

    public function write(): void
    {
        $this->jsonFileHandler->write($this->getTree());
    }
}