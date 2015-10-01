<?php

namespace Application\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Custom repository for persons.
 * Required in order to implement custom queries,
 * such as looking for a person by their credentials.
 */
class PersonRepository 
extends EntityRepository
{
	public function findWithCredentialsLike ($trait)
	{
		return $this
			->createQueryBuilder('p')
			->addSelect('c')
			->leftJoin('p.credentials', 'c')
			->where('LOWER(CONCAT(c.nameFirst, \' \', COALESCE(c.nameLast, \'\'))) LIKE LOWER(:trait)')
			->setParameter('trait', '%'.$trait.'%')
			->getQuery( )
			->getResult( )
		;
	}
}
