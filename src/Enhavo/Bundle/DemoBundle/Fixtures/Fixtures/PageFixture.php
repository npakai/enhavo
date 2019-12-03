<?php

/**
 * PageFixture.php
 *
 * @since 27/07/16
 * @author Gerhard Seidel <gseidel.message@googlemail.com>
 */

namespace Enhavo\Bundle\DemoBundle\Fixtures\Fixtures;

use Enhavo\Bundle\DemoBundle\Fixtures\AbstractFixture;
use Enhavo\Bundle\PageBundle\Entity\Page;

class PageFixture extends AbstractFixture
{
    /**
     * @inheritdoc
     */
    function create($args)
    {
        $page = new Page();
        $page->setTitle($args['title']);
        $page->setPublic($args['public']);
        $page->setContent($this->createContent($args['content']));
        $page->setRoute($this->createRoute($args['route'], $page));
        $this->translate($page);
        return $page;
    }

    /**
     * @inheritdoc
     */
    function getName()
    {
        return 'Page';
    }

    /**
     * @inheritdoc
     */
    function getOrder()
    {
        return 20;
    }
}
