<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    public function listOfCategories(string $slug)
    {
        $categories = $this->getDoctrine()->getRepository(Categories::class)
            ->findAll();

        return $this->render('category/categories_list.html.twig', [
            'categories' => $categories,
            'slug' => $slug
        ]);
    }
}
