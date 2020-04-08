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
    /**
     * @param string $slug
     * @return Response
     */
    public function displayListOfCategories(string $slug): Response
    {
        $categories = $this->getDoctrine()->getRepository(Categories::class)
            ->findAll();

        return $this->render('category/categories_list.html.twig', [
            'categories' => $categories,
            'slug' => $slug
        ]);
    }

    /**
     * @Route("/category/add", name="category_add")
     * @param Request $request
     * @return Response
     */
    public function addCategory(Request $request): Response
    {
        $form = $this->createForm(CategoryType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $categories = $form->getData();
            $categories->setName(preg_replace(
                '#\s+#', ' ', $categories->getName()));

            $categories->setCategoryUri(strtolower(str_replace(
                ' ', '-', $categories->getName())));

            $this->getDoctrine()->getRepository(Categories::class)
                ->addOneCategory($categories);

            return $this->redirectToRoute('flashcard_index');
        }

        return $this->render('category/add_category.html.twig', [
            'form' => $form->createView(),
            'slug' => 'Add category'
        ]);
    }
}
