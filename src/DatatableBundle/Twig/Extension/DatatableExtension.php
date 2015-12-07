<?php

namespace RP\DatatableBundle\Twig\Extension;

use RP\DatatableBundle\Datatable\Registry;
use Symfony\Component\Form\FormFactory;

class DatatableExtension extends \Twig_Extension
{
    /**
     * @var FormFactory
     */
    protected $formFactory;

    /**
     * @var Registry
     */
    protected $datatableRegistry;

    /**
     * @param FormFactory $formFactory
     * @param Registry    $datatableRegistry
     */
    public function __construct(FormFactory $formFactory, Registry $datatableRegistry)
    {
        $this->formFactory = $formFactory;
        $this->datatableRegistry = $datatableRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('datatable', [$this, 'datatable'], [
                'is_safe' => ['html'],
                'needs_environment' => true,
            ]),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function datatable(\Twig_Environment $twig, $options)
    {
        if (!isset($options['id'])) {
            throw new \InvalidArgumentException('Option id is required');
        }

        $dt = $this->datatableRegistry->getDatatable($options['id']);
        $config = $dt->getConfiguration();
        $options['js_conf'] = json_encode($config['js']);
        $options['js'] = json_encode($options['js']);
        $options['action'] = $dt->getHasAction();
        $options['action_twig'] = $dt->getHasRendererAction();
        $options['fields'] = $dt->getFields();
        $options['delete_form'] = $this->createDeleteForm('_id_')->createView();
        $options['search'] = $dt->getSearch();
        $options['search_fields'] = $dt->getSearchFields();
        $options['multiple'] = $dt->getMultiple();
        $options['sort'] = is_null($dt->getOrderField()) ? null : array(
            array_search(
                $dt->getOrderField(), array_values($dt->getFields())),
            $dt->getOrderType(),
        );
        $main_template = 'AliDatatableBundle:Main:index.html.twig';
        if (isset($options['main_template'])) {
            $main_template = $options['main_template'];
        }

        return $twig->render($main_template, $options);
    }

    protected function createDeleteForm($id)
    {
        return $this->formFactory->createBuilder('form', ['id' => $id])
            ->add('id', 'hidden')
            ->getForm();
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'DatatableBundle';
    }
}
