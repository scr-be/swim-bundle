<?php

/*
 * This file is part of the Scribe Swim Bundle.
 *
 * (c) Scribe Inc. <source@scribe.software>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\ScribbleDownBundle;

use Scribe\Teavee\ScribbleDownBundle\DependencyInjection\Compiler\Pass\RendererCompilerPass;
use Scribe\WonkaBundle\Component\Bundle\AbstractCompilerAwareBundle;

/**
 * Class ScribeTeaveeScribbleDownBundle.
 */
class ScribeTeaveeScribbleDownBundle extends AbstractCompilerAwareBundle
{
    /**
     * {@inheritdoc}
     */
    public function getCompilerPassInstances()
    {
        return [
            new RendererCompilerPass(),
        ];
    }
}

/* EOF */
