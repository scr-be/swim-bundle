<?php

/*
 * This file is part of the Scribe Symfony Swim Bundle.
 *
 * (c) Scribe Inc. <https://scribe.software>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\Teavee\ScribbleDownBundle\DependencyInjection\Compiler\Pass;

use Scribe\WonkaBundle\Component\DependencyInjection\Compiler\Pass\AbstractCompilerPass;

/**
 * Class RendererCompilerPass.
 */
class RendererCompilerPass extends AbstractCompilerPass
{
    /**
     * {@inheritdoc}
     */
    public function getRegistrarSrvName()
    {
        return 's.teavee_scribble_down.renderer_registrar';
    }

    /**
     * {@inheritdoc}
     */
    public function getAttendantTagName()
    {
        return 's.teavee_scribble_down.renderer_attendant';
    }
}

/* EOF */
