<?php 
namespace Ens\JobeetBundle\Admin;
 
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
 
class JobAdmin extends Admin
{
	protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('company')
            ->add('position')
            ->add('location')
            ->add('url')
            ->add('is_activated')
            ->add('email')
            ->add('category')
            ->add('expires_at')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    public function getBatchActions()
	{
	    // retrieve the default (currently only the delete action) actions
	    $actions = parent::getBatchActions();
	 
	    // check user permissions
	    if($this->hasRoute('edit') && $this->isGranted('EDIT') && $this->hasRoute('delete') && $this->isGranted('DELETE')) {
	        $actions['extend'] = array(
	            'label'            => 'Extend',
	            'ask_confirmation' => true // If true, a confirmation will be asked before performing the action
	        );

	        $actions['deleteNeverActivated'] = array(
	            'label'            => 'Delete never activated jobs',
	            'ask_confirmation' => true // If true, a confirmation will be asked before performing the action
        	);
	 
	    }
	    
	    return $actions;
	}

}