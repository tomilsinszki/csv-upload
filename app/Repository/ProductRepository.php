<?php

namespace App\Repository;

use App\Entities\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
    /**
     * @var string
     */
    private $class = Product::class;

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
