<?php

namespace App\Controller;

use App\Model\PhotoManager;

class PhotoController extends AbstractController
{
    /**
     * List photos
     */
    public function index(): string
    {
        $photoManager = new PhotoManager();
        $photos = $photoManager->selectAll('title');
        if ($this->user) {
        // A perfect and beautiful function that manage to put all the photos in the best index page ever.
            return $this->twig->render('Photo/index.html.twig', ['photos' => $photos]);
        } else {
            shuffle($photos);
        }
        return $this->twig->render('Photo/index.html.twig', ['photos' => $photos]);
    }

    public function index1(): string
    {
        $photoManager = new PhotoManager();
        $photos = $photoManager->selectAll('title');
        $favManager = new PhotoManager();
        $isFavUser = [];

        if ($this->user) {
            $favUsers = $favManager->selectFavPhoto($this->user['id']);
            foreach ($favUsers as $favUser) {
                $isFavUser[$favUser['photo_id']] = $favUser['is_fav'];
            }
        }

        return $this->twig->render('Photo/index.html.twig', ['photos' => $photos, 'isFavUser' => $isFavUser]);
    }

    /**
     * Show informations for a specific photo
     */
    public function show(int $id): string
    {
        $photoManager = new PhotoManager();
        $photo = $photoManager->selectOneById($id);

        return $this->twig->render('Photo/show.html.twig', ['photo' => $photo]);
    }

    /**
     * Edit a specific photo
     */
    public function edit(int $id): ?string
    {
        $photoManager = new PhotoManager();
        $photo = $photoManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $photo = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $photoManager->update($photo);

            header('Location: /photos/show?id=' . $id);

            // we are redirecting so we don't want any content rendered
            return null;
        }

        return $this->twig->render('Photo/edit.html.twig', [
            'photo' => $photo,
        ]);
    }

    /**
     * Add a new photo
     */
    public function add(): ?string
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $photo = array_map('trim', $_POST);

            $this->validateURL($photo, $errors);
            $this->validateTitle($photo, $errors);

            // is there a prompt text ?
            if (!isset($photo['prompt']) || empty($photo['prompt'])) {
                $errors[] = 'You must write a prompt';
            }
            // is there a description text ?
            if (!isset($photo['description']) || empty($photo['description'])) {
                $errors[] = 'You must write a comment';
            }
            // if validated, photo is stored in database
            if (empty($errors)) {
                $photoManager = new PhotoManager();
                $photoManager->insert($photo, $this->user['id']);

                header('Location: /');
                die();
            }
        }

        return $this->twig->render('Photo/add.html.twig', ['errors' => $errors]);
    }

    public function validateURL(array $photo, array &$errors): void
    {
        // is there a photo ?
        if (!isset($photo['picture']) || empty($photo['picture'])) {
            $errors[] = 'You must enter an URL';
        }
        // is the URL well formated ?
        if (!filter_var($photo['picture'], FILTER_VALIDATE_URL)) {
            $errors[] = 'Wrong URL format';
        }
    }

    public function validateTitle(array $photo, array &$errors): void
    {
        if (!isset($photo['title']) || empty($photo['title'])) {
            $errors[] = 'You must write a title';
        }
    }

    /**
     * Delete a specific photo
     */
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = trim($_POST['id']);
            $photoManager = new PhotoManager();
            $photoManager->delete((int)$id);

            header('Location:/photos');
        }
    }
}
