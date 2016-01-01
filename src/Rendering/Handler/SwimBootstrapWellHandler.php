<?php

/*
 * This file is part of the Scribe World Application.
 *
 * (c) Scribe Inc. <scribe@scribenet.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\ScribbleDownBundle\Rendering\Handler;

/**
 * Class SwimBootstrapWellHandler.
 */
class SwimBootstrapWellHandler extends AbstractRenderer
{
    /**
     * @return string
     */
    public function getCategory()
    {
        return self::CATEGORY_BOOTSTRAP_COMPONENTS;
    }

    /**
     * @param string $string
     * @param array  $args
     *
     * @return string
     */
    public function render($string, array $args = [])
    {
        $string = str_ireplace('{~well:start}', '<div class="well">', $string);
        $string = str_ireplace('{~well:end}',   '</div>',             $string);

        return $string;
    }
}
