<?php

namespace MultiRoleAclBase\View\Helper;

use Zend\Permissions\Acl\Acl;
use Zend\View\Helper\AbstractHelper;

class AclHelper extends AbstractHelper {
	/**
	 *
	 * @var Acl
	 */
	private $acl;

	/**
	 *
	 * @param Acl $acl        	
	 */
	public function __construct(Acl $acl) {
		$this->acl = $acl;
	}

	public function __invoke() {
		return $this->acl;
	}

}
