<?php

namespace App\Repository;

use App\Entities\ProductCustomField;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class ProductCustomFieldRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $class = ProductCustomField::class;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager) {
        /*
        $metadata = new ClassMetadata($this->entity());
        parent::__construct($entityManager, $metadata);
        */
        $this->entityManager = $entityManager;
    }
}
