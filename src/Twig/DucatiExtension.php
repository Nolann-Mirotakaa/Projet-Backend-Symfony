<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DucatiExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('ducati_badge', [$this, 'getBadge'], ['is_safe' => ['html']])
        ];
    }

    public function getBadge(int $power): string
    {
        if ($power >= 200) {
            return '<span>🔥 Superbike</span>';
        }

        if ($power >= 150) {
            return '<span>⚡ Sport</span>';
        }

        return '<span>🏍️ Road</span>';
    }
}
