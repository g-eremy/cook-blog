<?php
namespace App\Service;

use App\Entity\PageEntity;

use Doctrine\ORM\EntityManagerInterface;

class PageService extends AbstractContentService
{
	public function __construct(EntityManagerInterface $em)
	{
		$rep = $this->em->getRepository(PageEntity::class);
		
		parent::__construct($em, $rep);
	}
	
}