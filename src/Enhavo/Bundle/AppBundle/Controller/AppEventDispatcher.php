<?php
/**
 * EventDispatcher.php
 *
 * @since 26/06/16
 * @author gseidel
 */

namespace Enhavo\Bundle\AppBundle\Controller;

use Enhavo\Bundle\AppBundle\Event\PreviewEvent;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Bundle\ResourceBundle\Controller\RequestConfiguration;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class AppEventDispatcher
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatchPreEvent($eventName, RequestConfiguration $requestConfiguration, ResourceInterface $resource)
    {
        $eventName = $requestConfiguration->getEvent() ?: $eventName;
        $this->eventDispatcher->dispatch(sprintf('enhavo_app.pre_%s', $eventName), new ResourceControllerEvent($resource));
    }

    /**
     * {@inheritdoc}
     */
    public function dispatchPostEvent($eventName, RequestConfiguration $requestConfiguration, ResourceInterface $resource)
    {
        $eventName = $requestConfiguration->getEvent() ?: $eventName;
        $this->eventDispatcher->dispatch(sprintf('enhavo_app.post_%s', $eventName), new ResourceControllerEvent($resource));
    }

    public function dispatchInitEvent($eventName, RequestConfiguration $requestConfiguration)
    {
        $this->eventDispatcher->dispatch($eventName, new PreviewEvent($requestConfiguration->getRequest(), $requestConfiguration));
    }
}