<?php

namespace Enhavo\Bundle\AppBundle\Column\Type;

use Enhavo\Bundle\AppBundle\Mock\EntityMock;

class ListTypeTest extends AbstractTypeTest
{
    public function testInitialize()
    {
        $type = new ListType();
        $this->assertInstanceOf(ListType::class, $type);
        $this->assertEquals('list', $type->getType());
    }

    public function testCreateResourceView()
    {
        $column = $this->createColumn(new ListType(), [
            'property' => 'entities',
            'item_property' => 'name',
            'separator' => '-'
        ]);

        $entity = $this->getEntityMock();
        $value = $column->createResourceViewData($entity);
        $this->assertEquals('one-two', $value);
    }

    private function getEntityMock()
    {
        $childOne = new EntityMock();
        $childOne->setName('one');

        $childTwo = new EntityMock();
        $childTwo->setName('two');

        $entity = new EntityMock();
        $entity->addEntity($childOne);
        $entity->addEntity($childTwo);

        return $entity;
    }
}
