<?php
/**
 * StrategyInterface.php
 *
 * @since 21/09/16
 * @author gseidel
 */

namespace Enhavo\Bundle\NewsletterBundle\Strategy;

use Enhavo\Bundle\AppBundle\Type\TypeInterface;
use Enhavo\Bundle\NewsletterBundle\Model\SubscriberInterface;

interface StrategyInterface extends TypeInterface
{
    public function addSubscriber(SubscriberInterface $subscriber, $type);

    /**
     * @return boolean
     */
    public function exists(SubscriberInterface $subscriber, $groupNames);

    /**
     * @return string
     */
    public function handleExists(SubscriberInterface $subscriber);
}