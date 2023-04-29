<?php

namespace App\Controller;

use App\Model\PhotoManager;
use App\Model\FavManager;

class PhotoController extends AbstractController
{
    /**
     * List photos
     */
    public function index(): string
    {
        $photoManager = new PhotoManager();
        $photos = $photoManager->selectAllWithUsername();
        // A perfect and beautiful function that manage to put all the photos in the best index page ever.
        if ($this->user) {
            $favManager = new FavManager();
            $favIds = $favManager->selectUserFavs($this->user['id']);
            return $this->twig->render('Photo/index.html.twig', ['photos' => $photos, 'favIds' => $favIds]);
        } else {
            shuffle($photos);
        }
        return $this->twig->render('Photo/index.html.twig', ['photos' => $photos]);
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
    public function edit(): ?string
    {
        // allowed only for users
        if (!$this->user) {
            header('Location: /');
            exit();
        }

        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $photo = array_map('trim', $_POST);
            // is there a title text ?
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
                $photoManager->update($photo);

                header('Location: /user');
                die();
            }
        }

        return $this->twig->render('User/profil.html.twig');
    }

    /**
     * Add a new photo
     */
    public function add(): ?string
    {
        // allowed only for users
        if (!$this->user) {
            header('Location: /');
            exit();
        }

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

                header('Location: /user');
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
        // allowed only for users
        if (!$this->user) {
            header('Location: /');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $photoId = trim($_POST['id']);
            $photoManager = new PhotoManager();
            $photoManager->delete((int)$photoId);

            header('Location: /user');
        }
    }
}
