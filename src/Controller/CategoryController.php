<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category/{slug}', name: 'category_show')]
    public function show(string $slug, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy(['slug' => $slug]);

        if (!$category) {
            throw $this->createNotFoundException('Catégorie introuvable.');
        }

        return $this->render('pages/category/show.html.twig', [
            'category' => $category,
            'articles' => $category->getArticles(), // grâce à la relation
        ]);
    }
}
