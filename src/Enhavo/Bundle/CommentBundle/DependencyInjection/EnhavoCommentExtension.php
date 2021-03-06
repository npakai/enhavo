<?php

namespace Enhavo\Bundle\CommentBundle\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class EnhavoCommentExtension extends AbstractResourceExtension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $config);
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $this->registerResources('enhavo_comment', $config['driver'], $config['resources'], $container);

        $container->setParameter('enhavo_comment.submit_form.form', $config['submit_form']['form']);
        $container->setParameter('enhavo_comment.submit_form.validation_groups', $config['submit_form']['validation_groups']);
        $container->setParameter('enhavo_comment.publish_strategy.strategy', $config['publish_strategy']['strategy']);
        $container->setParameter('enhavo_comment.publish_strategy.options', $config['publish_strategy']['options']);

        $configFiles = array(
            'services.yml',
        );

        foreach ($configFiles as $configFile) {
            $loader->load($configFile);
        }
    }
}
