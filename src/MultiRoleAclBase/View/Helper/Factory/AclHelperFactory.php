<?php

namespace MultiRoleAclBase\View\Helper\Factory;

use MultiRoleAclBase\View\Helper\AclHelper;

class AclHelperFactory {

	public function __invoke($serviceLocator) {
		$sm = $serviceLocator->getServiceLocator ();
		$acl = $sm->get ( 'MultiRoleAclBase\Acl\Acl' );
		
		return new AclHelper ( $acl );
	}

}