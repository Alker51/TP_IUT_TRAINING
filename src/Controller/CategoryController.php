<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'app_category_show')]
    public function show(Category $category, CategoryRepository $categoryRepository): Response
    {
        $contactInCat = $categoryRepository->findByidCategory($category);

        return $this->render('category/show.html.twig', ['categories' => $contactInCat]);
    }

    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $list = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'list' => $list,
            'isCategory' => true,
        ]);
    }
}
