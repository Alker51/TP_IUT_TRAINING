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
        $contactInCat = $categoryRepository->findByIdCategory($category);
        dump($contactInCat);
        return $this->render('category/show.html.twig', ['categoryContacts' => $contactInCat, 'isCategory' => false, 'category' => $category]);
    }

    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $list = $categoryRepository->findAllAlphabeticallyWithContactCount();
        dump($list);
        return $this->render('category/index.html.twig', [
            'list' => $list,
            'isCategory' => true,
        ]);
    }
}
