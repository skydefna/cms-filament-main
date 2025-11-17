<?php

namespace App\Filament\TiptapExtensions;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class Iframe extends Node
{
    public static $name = 'iframe';

    public static $priority = 100;

    public function addOptions(): array
    {
        return [
            'HTMLAttributes' => [
                'frameborder' => '0',
                'allowfullscreen' => true,
            ],
        ];
    }

    public function addAttributes(): array
    {
        return [
            'src' => [
                'default' => null,
                'parseHTML' => fn ($element) => $element->getAttribute('src'),
            ],
            'width' => [
                'default' => null,
                'parseHTML' => fn ($element) => $element->getAttribute('width'),
            ],
            'height' => [
                'default' => null,
                'parseHTML' => fn ($element) => $element->getAttribute('height'),
            ],
            'title' => [
                'default' => null,
                'parseHTML' => fn ($element) => $element->getAttribute('title'),
            ],
        ];
    }

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'iframe',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): array
    {
        return [
            'iframe',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes, [
                'src' => $node->attrs->src ?? null,
                'width' => $node->attrs->width ?? null,
                'height' => $node->attrs->height ?? null,
                'title' => $node->attrs->title ?? null,
            ]),
        ];
    }
}
