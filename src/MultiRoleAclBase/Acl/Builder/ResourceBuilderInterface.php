<?php

namespace MultiRoleAclBase\Acl\Builder;

use Zend\Permissions\Acl\AclInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

interface ResourceBuilderInterface {

	/**
	 * function sets all the resources in $acl that are used later on in ruleBuilder
	 *
	 * @param AclInterface $Acl        	
	 * @return array of all resources (optional. set all resources in $acl right away)
	 */
	public function buildResources(AclInterface $Acl, ServiceLocatorInterface $serviceLocator);

}
