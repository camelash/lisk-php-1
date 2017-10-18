<?php
namespace LiskPhpBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;

class LiskPhpExtension extends Extension {
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $def = $container->getDefinition('LiskPhpBundle\Service\Lisk');
        if(!empty($config['base_url'])) {
            $def->replaceArgument("\$baseUrl", $config['base_url']);
        }
        if(!empty($config['network_hash'])) {
            $def->replaceArgument("\$networkHash", $config['network_hash']);
        }
    }
}