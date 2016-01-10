<?php

namespace MultiRoleAclBase\Acl\Builder;

class DefaultRoleBuilder implements RoleBuilderInterface {
	/*
	 * (non-PHPdoc) @see \MultiRoleAclBase\Acl\Builder\RoleBuilderInterface::buildRoles()
	 */
	public function buildRoles(Zend\Permissions\Acl\Acl $Acl, \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator) {
		$config = $serviceLocator->get ( 'config' );
		
		return $config ['MultiRoleAclBase'] ['roles'];
	}

}
