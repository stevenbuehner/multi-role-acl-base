<?php

namespace MultiRoleAclBase\Acl\Builder;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Permissions\Acl\Acl;

interface ResourceBuilderInterface {

	/**
	 * function sets all the resources in $acl that are used later on in ruleBuilder
	 *
	 * @param Acl $Acl        	
	 * @return array of all resources (optional. set all resources in $acl right away)
	 */
	public function buildResources(Acl $Acl, ServiceLocatorInterface $serviceLocator);

}
