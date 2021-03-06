<?php

namespace Enhavo\Bundle\TaxonomyBundle\Form\Type;

use Enhavo\Bundle\FormBundle\Form\Type\EntityTreeType;
use Enhavo\Bundle\TaxonomyBundle\Repository\TermRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TermTreeChoiceType extends AbstractType
{
    /*
     * @var string
     */
    private $dataClass;

    /**
     * @var TermRepository
     */
    private $repository;


    public function __construct($dataClass, TermRepository $repository)
    {
        $this->dataClass = $dataClass;
        $this->repository = $repository;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'class' => $this->dataClass,
            'multiple' => false,
            'expanded' => true,
        ]);
        $resolver->setRequired(['taxonomy']);

        $repository = $this->repository;
        $resolver->setNormalizer('query_builder', function($options) use($repository) {
            $taxonomy = $options['taxonomy'];
            $query = $repository->createQueryBuilder('t');
            $query->join('t.taxonomy', 'ta');
            $query->andWhere('ta.name = :name');
            $query->setParameter('name', $taxonomy);
            return $query;
        });
    }

    public function getParent()
    {
        return EntityTreeType::class;
    }
}
