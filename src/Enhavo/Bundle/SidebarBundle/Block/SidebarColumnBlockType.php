<?php
/**
 * Created by PhpStorm.
 * User: philippsester
 * Date: 30.05.19
 * Time: 16:26
 */

namespace Enhavo\Bundle\SidebarBundle\Block;

use Enhavo\Bundle\BlockBundle\Block\AbstractBlockType;
use Enhavo\Bundle\SidebarBundle\Entity\SidebarColumnBlock;
use Enhavo\Bundle\SidebarBundle\Factory\SidebarColumnBlockFactory;
use Enhavo\Bundle\SidebarBundle\Form\Type\SidebarColumnBlockType as SidebarColumnBlockFormType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SidebarColumnBlockType extends AbstractBlockType
{
    public function configureOptions(OptionsResolver $optionsResolver)
    {
        parent::configureOptions($optionsResolver);

        $optionsResolver->setDefaults([
            'model' => SidebarColumnBlock::class,
            'parent' => SidebarColumnBlock::class,
            'form' => SidebarColumnBlockFormType::class,
            'factory' => SidebarColumnBlockFactory::class,
            'repository' => 'EnhavoSidebarBundle:SidebarColumn',
            'template' => 'theme/block/sidebar-column.html.twig',
            'form_template' => '@EnhavoBlock/admin/form/block/block_fields.html.twig',
            'label' => 'sidebar_column.label.sidebar_column',
            'translationDomain' => 'EnhavoSidebarBundle',
            'groups' => ['default', 'layout']
        ]);
    }

    public function getType()
    {
        return 'sidebar_column';
    }
}
