<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\Type\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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

    /**
     * @Route("/category/add", name="add_category")
     */
    public function addCategory()
    {
        $form = $this->createForm(CategoryType::class);

        return $this->render('category/add_category.html.twig', [
            'form' => $form->createView(),
            'slug' => 'Add category'
        ]);
    }
}
