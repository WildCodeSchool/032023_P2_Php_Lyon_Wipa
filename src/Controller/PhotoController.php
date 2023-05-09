<?php

namespace App\Controller;

use App\Model\PhotoManager;
use App\Model\FavManager;
use App\Model\FollowManager;
use App\Model\UserManager;

class PhotoController extends AbstractController
{
    /**
     * List photos
     */
    public function index(): string
    {
        $photoManager = new PhotoManager();
        $photos = $photoManager->selectAllWithUsername('id');
        // A perfect and beautiful function that manage to put all the photos in the best index page ever.
        if ($this->user) {
            $favManager = new FavManager();
            $favIds = $favManager->selectUserFavs($this->user['id']);

            $followManager = new FollowManager();
            $followByUser = $followManager->selectFollowedByUser($this->user['id']);
            return $this->twig->render('Photo/index.html.twig', [
                'photos' => $photos,
                'favIds' => $favIds,
                'followedUsers' => $followByUser,
                'errors' => $this->errors,
                'successes' => $this->successes,
            ]);
        } else {
            shuffle($photos);
        }
        return $this->twig->render('Photo/index.html.twig', [
            'photos' => $photos
        ]);
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $photo = array_map('trim', $_POST);

                    // Retrieve the photo from the database
                    $photoManager = new PhotoManager();
                    $dbPhoto = $photoManager->selectOneById(intval($photo['id']));

        // Check if the photo belongs to the current user
            if ($dbPhoto['user_id'] !== $this->user['id']) {
                header('Location: /user');
                exit();
            }
            // is there a title text ?
            $this->validateTitle($photo);
            // is there a prompt text ?
            if (!isset($photo['prompt']) || empty($photo['prompt'])) {
                $this->errors[] = 'You must write a prompt';
            }
            // is there a description text ?
            if (!isset($photo['description']) || empty($photo['description'])) {
                $this->errors[] = 'You must write a comment';
            }
            // if validated, photo is stored in database
            if (empty($this->errors)) {
                $photoManager = new PhotoManager();
                $photoManager->update($photo);

                header('Location: /user');
                die();
            }
        }

        return $this->twig->render('User/profil.html.twig', [
            'errors' => $this->errors
        ]);
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $photo = array_map('trim', $_POST);

            $this->validateURL($photo);
            $this->validateTitle($photo);

            // is there a prompt text ?
            if (!isset($photo['prompt']) || empty($photo['prompt'])) {
                $this->errors[] = 'You must write a prompt';
            }
            // is there a description text ?
            if (!isset($photo['description']) || empty($photo['description'])) {
                $this->errors[] = 'You must write a comment';
            }
            // if validated, photo is stored in database
            if (empty($this->errors)) {
                $photoManager = new PhotoManager();
                $photoManager->insert($photo, $this->user['id']);

                header('Location: /user');
                die();
            }
        }

        return $this->twig->render('Photo/add.html.twig', ['errors' => $this->errors]);
    }

    public function validateURL(array $photo): void
    {
    // is there a photo ?
        if (!isset($photo['picture']) || empty($photo['picture'])) {
            $this->errors[] = 'You must enter an URL';
        } else {
            // is the URL well formatted ?
            if (!filter_var($photo['picture'], FILTER_VALIDATE_URL)) {
                $this->errors[] = 'Wrong URL format';
            } else {
                // is the URL a valid image?
                try {
                    $imageInfo = getimagesize($photo['picture']);
                    if (!$imageInfo || !in_array($imageInfo[2], [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG])) {
                        $this->errors[] = 'Invalid image URL';
                    } else {
                        // check if the image size is at least 256px x 256px
                        if ($imageInfo[0] < 256 || $imageInfo[1] < 256) {
                            $this->errors[] = 'Image dimensions must be at least 256px x 256px';
                        }
                    }
                } catch (\Exception $e) {
                    $this->errors[] = 'An error occurred while validating the image: ' . $e->getMessage();
                }
            }
        }
    }



    public function validateTitle(array $photo): void
    {
        if (!isset($photo['title']) || empty($photo['title'])) {
            $this->errors[] = 'You must write a title';
        } elseif (mb_strlen($photo['title']) > 255) {
            $this->errors[] = 'The title is too long';
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

    public function userPhotos(): string
    {

        if ($this->user) {
            if ($_SERVER["REQUEST_METHOD"] == "GET") {
                $data = array_map('trim', $_GET);
                if (isset($data['userPhoto']) && !empty($data['userPhoto'])) {
                    $userManager = new UserManager();
                    $photos = $userManager->selectUserPictures($data['userPhoto']);
                    $favManager = new FavManager();
                    $favIds = $favManager->selectUserFavs($this->user['id']);
                    $username = $userManager->selectOneById((int)$data['userPhoto']);
                    return $this->twig->render('User/photos.html.twig', [
                    'photos' => $photos,
                    'favIds' => $favIds,
                    'username' => $username,
                    ]);
                }
            }
        }
        header('location : /');
        die();
    }
}
