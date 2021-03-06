<?php
/**
 * ThreeColumnConfiguration.php
 *
 * @since 08/08/18
 * @author gseidel
 */

namespace Enhavo\Bundle\BlockBundle\Block\Type;

use Enhavo\Bundle\BlockBundle\Model\Column\ThreeColumnBlock;
use Enhavo\Bundle\BlockBundle\Factory\ThreeColumnBlockFactory;
use Enhavo\Bundle\BlockBundle\Form\Type\ThreeColumnBlockType as ThreeColumnBlockFormType;
use Enhavo\Bundle\BlockBundle\Block\AbstractBlockType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ThreeColumnBlockType extends AbstractBlockType
{
    public function configureOptions(OptionsResolver $optionsResolver)
    {
        parent::configureOptions($optionsResolver);

        $optionsResolver->setDefaults([
            'model' => ThreeColumnBlock::class,
            'parent' => ThreeColumnBlock::class,
            'form' => ThreeColumnBlockFormType::class,
            'factory' => ThreeColumnBlockFactory::class,
            'repository' => 'EnhavoBlockBundle:ThreeColumnBlock',
            'template' => 'theme/block/three-column.html.twig',
            'form_template' => '@EnhavoBlock/admin/form/block/block_fields.html.twig',
            'label' => 'three_column.label.three_column',
            'translationDomain' => 'EnhavoBlockBundle',
            'groups' => ['default', 'layout']
        ]);
    }

    public function getType()
    {
        return 'three_column';
    }
}
