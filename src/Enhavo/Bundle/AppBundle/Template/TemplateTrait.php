<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 2019-07-08
 * Time: 16:00
 */

namespace Enhavo\Bundle\AppBundle\Template;

use Psr\Container\ContainerInterface;

/**
 * Trait TemplateControllerTrait
 * @package Enhavo\Bundle\AppBundle\Controller
 * @property ContainerInterface $container
 */
trait TemplateTrait
{
    public function getTemplate($name)
    {
        return $this->container->get('enhavo_app.template.manager')->getTemplate($name);
    }
}
