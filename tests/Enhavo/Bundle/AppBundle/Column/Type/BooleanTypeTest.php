<?php

namespace Enhavo\Bundle\AppBundle\Column\Type;

use Enhavo\Bundle\AppBundle\Mock\EntityMock;

class BooleanTypeTest extends AbstractTypeTest
{
    public function testInitialize()
    {
        $type = new BooleanType();
        $this->assertInstanceOf(BooleanType::class, $type);
        $this->assertEquals('boolean', $type->getType());
    }

    public function testCreateResourceView()
    {
        $column = $this->createColumn(new BooleanType(), [
            'property' => 'name'
        ]);

        $entity = new EntityMock();
        $entity->setName('Test');
        $value = $column->createResourceViewData($entity);
        $this->assertTrue($value);

        $entity->setName(null);
        $value = $column->createResourceViewData($entity);
        $this->assertFalse($value);
    }
}
