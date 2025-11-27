<?php

namespace App\Controller;

use App\Service\DatabaseConnection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class DBtestController extends AbstractController
{
    #[Route('/dbtest', name: 'app_db_test')]
    public function index(DatabaseConnection $db): JsonResponse
    {
        $pdo = $db->getConnection();
        $stmt = $pdo->query("SHOW TABLES");
        if ($stmt === false) {
        return $this->json(['error' => 'Query failed'], 500);
        }
        $result =  $stmt->fetchAll();
        return $this->json($result);
    }
}
