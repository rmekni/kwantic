<?php

declare(strict_types=1);

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class ProductAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter
            ->add('id')
            ->add('name')
            ->add('specifications');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list
            ->addIdentifier('id')
            ->add('name')
            ->add('image', null, array('template' => 'admin/poster.html.twig'))
            ->add(ListMapper::NAME_ACTIONS, null, [
                'actions' => [
                    'show' => [],
                    'edit' => [],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $form): void
    {
        $fileFormOptions = ['required' => false, 'data_class' => null];
        $product = $this->getSubject();
        if ($product && ($webPath = $product->getImage())) {
            $fileFormOptions['help'] = '<img style="width: 150px;" src="' . $webPath . '" class="admin-preview"/>';
            $fileFormOptions['help_html'] = true;
        }
        $form
            ->add('subCategory', ModelType::class, ['label' => 'Product category'])
            ->add('name')
            ->add('specifications', TextareaType::class)
            ->add('image', FileType::class, ['data_class' => null, ...$fileFormOptions]);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show
            ->add('id')
            ->add('name')
            ->add('specifications')
            ->add('image');
    }
}
