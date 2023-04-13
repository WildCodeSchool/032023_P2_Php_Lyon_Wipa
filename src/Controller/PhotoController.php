<?php

namespace App\Controller;

use App\Model\PhotoManager;

class PhotoController extends AbstractController
{
    /**
     * List items
     */
    public function index(): string
    {
        $photoManager = new PhotoManager();
        $items = $photoManager->selectAll('photo_title', 'ASC');

        return $this->twig->render('Item/index.html.twig', ['items' => $items]);
    }

    /**
     * Show informations for a specific item
     */
    public function show(int $id): string
    {
        $photoManager = new PhotoManager();
        $item = $photoManager->selectOneById($id);

        return $this->twig->render('Item/show.html.twig', ['item' => $item]);
    }

    /**
     * Edit a specific item
     */
    public function edit(int $id): ?string
    {
        $photoManager = new PhotoManager();
        $item = $photoManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $item = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $photoManager->update($item);

            header('Location: /items/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Item/edit.html.twig', [
            'item' => $item,
        ]);
    }

    /**
     * Add a new item
     */
    public function add(): ?string
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $item = array_map('trim', $_POST);

            $this->validateURL($item, $errors);

            if (!isset($item['prompt']) || empty($item['prompt'])) {
                $errors[] = 'You must write a prompt';
            }
            if (!isset($item['description']) || empty($item['description'])) {
                $errors[] = 'You must write a comment';
            }
            if (empty($errors)) {
                $photoManager = new PhotoManager();
                $id = $photoManager->insert($item);

                header('Location:/items/show?id=' . $id);
                return null;
            }
        }

        return $this->twig->render('Item/add.html.twig', ['errors' => $errors]);
    }

    public function validateURL(array $item, array &$errors): void
    {
        if (!isset($item['picture']) || empty($item['picture'])) {
            $errors[] = 'You must enter an URL';
        }
        if (!filter_var($item['picture'], FILTER_VALIDATE_URL)) {
            $errors[] = 'Wrong URL format';
        }
    }

    /**
     * Delete a specific item
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $photoManager = new PhotoManager();
            $photoManager->delete((int)$id);

            header('Location:/items');
        }
    }
}
