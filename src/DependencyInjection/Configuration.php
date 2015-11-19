<?php

/*
 * This file is part of the Scribe Symfony Swim Bundle.
 *
 * (c) Scribe Inc. <https://scribe.software>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace Scribe\SwimBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Scribe\WonkaBundle\Component\DependencyInjection\AbstractConfiguration;

/**
 * Class Configuration.
 */
class Configuration extends AbstractConfiguration
{
    /**
     * Create the config tree builder object.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $this
            ->getBuilderRoot()
            ->getNodeBuilder()
            ->children()
                ->append($this->getCachingNode())
                ->append($this->getFeatureNode())
                ->append($this->getBlacklistNode())
            ->end();

        return $this
            ->getBuilderRoot()
            ->getTreeBuilder();
    }

    /**
     * Create the general state node.
     *
     * @return \Symfony\Component\Config\Definition\Builder\NodeDefinition
     */
    private function getCachingNode()
    {
        return $this
            ->getBuilder('caching')
            ->getNodeBuilder()
            ->addDefaultsIfNotSet()
            ->children()
                ->booleanNode('enabled')
                    ->defaultTrue()
                    ->info('Enable or disabled the entire Swim renderer chain. When disabled, content will be passed through unaltered.')
                ->end()
                ->booleanNode('enabled')
                    ->defaultTrue()
                    ->info('Utilize caching for rendered nodes.')
                ->end()
                ->enumNode('strategy')
                    ->values(['on_update_trigger', 'time_to_live', 'both'])
                    ->defaultValue('time_to_live')
                    ->info(
                        'At this time two caching strategies are available. The first, ("on_update_trigger") will only render '.
                        'content when it is explicitly edited by an administrator using the UI. The second, ("time_to_live") will '.
                        're-render the content whenever it is deemed "stale", which occurs after it is older than the specified '.
                        'time. These two methods can be alternatively used in tandem by selecting ("both"). It is important to note '.
                        'that these strategies are *defaults* and a renderer may, due to any number of conditions, ignore this '.
                        'setting to ensure content is fresh.'
                    )
                ->end()
                ->integerNode('time_to_live')
                    ->min(0)
                    ->max(2592000)
                    ->defaultValue(10800)
                    ->info(
                        'Used only when the time based caching strategies, ("time_to_live" or "both") are selected. This value is '.
                        'the number of seconds before content that has been rendered is deemed "stale" and must be re-rendered. It '.
                        'must be greater than zero seconds and less than a month (or 2592000 seconds). It defaults to a value of '.
                        'three hours, or 10800 seconds.'
                    )
                ->end()
            ->end();
    }

    private function getFeatureNode()
    {
        return $this
            ->getBuilder('feature_matrix')
            ->getNodeBuilder()
            ->addDefaultsIfNotSet()
            ->children()
                ->booleanNode('block_excludes')
                    ->defaultTrue()
                    ->info('Allows for content to be excluded from rendering and added back afterwards.')
                ->end()
                ->booleanNode('block_restrictions')
                    ->defaultTrue()
                    ->info('Allows for content to be hidden or displayed based on a single or collection of client codes.')
                ->end()
                ->booleanNode('block_level_general')
                    ->defaultTrue()
                    ->info('Handles parsing block-level elements within the content.')
                ->end()
                ->booleanNode('inline_level_general')
                    ->defaultTrue()
                    ->info('Handles parsing inline-level elements within the content.')
                ->end()
                ->booleanNode('link_internal_routes')
                    ->defaultTrue()
                    ->info('Enabled generating linking between nodes and generic Symfony routes using the router service.')
                ->end()
                ->booleanNode('link_decorating')
                    ->defaultTrue()
                    ->info(
                        'Decorates internal and external links to help provide context to the user. For examples, generic external links '.
                        'should a small exit error to their left while Wikipedia/Google links show a small brand icon to their left.'
                    )
                ->end()
                ->booleanNode('markdown_basic')
                    ->defaultTrue()
                    ->info('Enables or disabled parsing of Markdown syntax using http://parsedown.org/')
                ->end()
                ->booleanNode('markdown_extra')
                    ->defaultTrue()
                    ->info('Enables or disables parsing of Markdown Extra syntax using http://parsedown.org/')
                ->end()
                ->booleanNode('bootstrap_components')
                    ->defaultTrue()
                    ->info('Enables or disables a collection of Bootstrap-specific renderers.')
                ->end()
            ->end();
    }

    private function getBlacklistNode()
    {
        return $this
            ->getBuilder('blacklist')
            ->getNodeBuilder()
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('rendering_handlers')
                    ->defaultValue([])
                    ->info('List of renderer steps to blacklist (they will not be registered with the renderer chain and therefore will not run.')
                    ->prototype('scalar')->end()
                ->end()
            ->end();
    }
}

/* EOF */
