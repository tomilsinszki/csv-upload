<?php

namespace App\Http\Controllers;

use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function selectFile()
    {
        return view('selectFile');
    }
}
