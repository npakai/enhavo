<?php
/**
 * AbstractViewer.php
 *
 * @since 29/05/15
 * @author gseidel
 */

namespace esperanto\AdminBundle\Viewer;


use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class AbstractViewer implements ContainerAwareInterface
{
    private $resource;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @var \Symfony\Component\HttpFoundation\Request
     */
    private $request;

    /**
     * @var \Symfony\Component\Form\Form
     */
    private $form;

    /**
     * @var \esperanto\AdminBundle\Config\ConfigParser
     */
    private $config;

    /**
     * @var string
     */
    private $bundlePrefix;

    /**
     * @var string
     */
    private $resourceName;

    /**
     * @param mixed $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * @return mixed
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param mixed $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    public function dispatchEvent()
    {

    }

    public function setResource($resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return mixed
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }
    
    abstract function getParameters();

    public function getTheme()
    {
        return '::admin.html.twig';
    }

    protected function getTemplateVars()
    {
        return $this->getConfig()->get('parameters');
    }

    public function getTemplate()
    {
        return 'esperantoAdminBundle:App:index.html.twig';
    }

    public function setBundlePrefix($bundlePrefix)
    {
        $this->bundlePrefix = $bundlePrefix;
    }

    public function setResourceName($resourceName)
    {
        $this->resourceName = $resourceName;
    }

    /**
     * @return string
     */
    public function getBundlePrefix()
    {
        return $this->bundlePrefix;
    }

    /**
     * @return string
     */
    public function getResourceName()
    {
        return $this->resourceName;
    }
}