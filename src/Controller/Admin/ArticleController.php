<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/article', name: 'admin_article_')]
class ArticleController extends AbstractController
{
    private function getUploadDir(): string
    {
        return $this->getParameter('kernel.project_dir') . '/public/uploads/articles';
    }

    private function deleteImageFile(?string $filename): void
    {
        if (!$filename) {
            return;
        }

        $path = $this->getUploadDir() . '/' . $filename;

        if (is_file($path)) {
            @unlink($path);
        }
    }

    #[Route('', name: 'index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if ($this->isGranted('ROLE_ADMIN')) {
            $articles = $articleRepository->findBy([], ['createdAt' => 'DESC']);

        } else {
            $articles = $articleRepository->findByAuthor($this->getUser());
        }

        return $this->render('pages/admin/article/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $em,
        SluggerInterface $slugger,
        ArticleRepository $articleRepository
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $baseSlug = $slugger->slug((string) $article->getTitle())->lower();
            $slug = (string) $baseSlug;
            $i = 2;

            while ($articleRepository->findOneBy(['slug' => $slug])) {
                $slug = (string) $baseSlug . '-' . $i;
                $i++;
            }

            $article->setSlug($slug);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $article->setAuthor($this->getUser());

            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $newFilename = uniqid('article_', true) . '.' . $imageFile->guessExtension();
                $imageFile->move($this->getUploadDir(), $newFilename);
                $article->setImage($newFilename);
            }

            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('admin_article_index');
        }

        return $this->render('pages/admin/article/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(
        Article $article,
        Request $request,
        EntityManagerInterface $em,
        SluggerInterface $slugger,
        ArticleRepository $articleRepository
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$this->isGranted('ROLE_ADMIN') && $article->getAuthor() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        $oldImage = $article->getImage();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $baseSlug = $slugger->slug((string) $article->getTitle())->lower();
            $slug = (string) $baseSlug;
            $i = 2;

            while (true) {
                $existing = $articleRepository->findOneBy(['slug' => $slug]);

                if (!$existing || $existing->getId() === $article->getId()) {
                    break;
                }

                $slug = (string) $baseSlug . '-' . $i;
                $i++;
            }

            $article->setSlug($slug);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $removeImage = $form->has('removeImage') ? (bool) $form->get('removeImage')->getData() : false;

            if ($removeImage) {
                $this->deleteImageFile($oldImage);
                $article->setImage(null);
                $oldImage = null;
            }

            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $this->deleteImageFile($oldImage);

                $newFilename = uniqid('article_', true) . '.' . $imageFile->guessExtension();
                $imageFile->move($this->getUploadDir(), $newFilename);
                $article->setImage($newFilename);
            }

            $em->flush();

            return $this->redirectToRoute('admin_article_index');
        }

        return $this->render('pages/admin/article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(
        Article $article,
        Request $request,
        EntityManagerInterface $em
    ): Response {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$this->isGranted('ROLE_ADMIN') && $article->getAuthor() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Accès refusé.');
        }

        if ($this->isCsrfTokenValid(
            'delete_article_' . $article->getId(),
            (string) $request->request->get('_token')
        )) {
            $this->deleteImageFile($article->getImage());

            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('admin_article_index');
    }
}
