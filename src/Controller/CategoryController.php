<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Form\Type\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    public function displayListOfCategories(string $slug)
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
     * @param Request $request
     * @return Response
     */
    public function addCategory(Request $request)
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $categories = new Categories();
            $categories = $form->getData();
            $categories->setCategoryUri(strtolower($categories->getName()));
            //TODO: Find and make it better to set URI by category name and pass it to CategoryRepository
            dump($categories);
        }

        return $this->render('category/add_category.html.twig', [
            'form' => $form->createView(),
            'slug' => 'Add category'
        ]);
    }
}
