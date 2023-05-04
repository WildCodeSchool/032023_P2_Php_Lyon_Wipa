<?php

namespace App\Controller;

use App\Model\VoteManager;
use App\Model\PhotoManager;
use App\Model\FavManager;

class VoteController extends AbstractController
{
    public function vote(): string
    {
        if ($this->user) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $vote = array_map('trim', $_POST);

                if (isset($vote['addVote']) && !empty($vote['addVote'])) {
                    $voteManager = new VoteManager();
                    // Checks if the user has already voted for this photo
                    $hasUserAlreadyVoted = $voteManager->hasUserVotedForPhoto($this->user['id'], $vote['addVote']);

                    // If the user has not yet voted for this photo, add a vote
                    if (!$hasUserAlreadyVoted) {
                        $voteManager->addVote($vote['addVote'], $this->user['id']);
                    }
                }
            } else {
                $voteManager = new VoteManager();
                // Retrieves total number of votes per photo
                $totalVotesByPhoto = $voteManager->getTotalVotesByPhoto();

                // Retrieves the identifiers of the photos for which the user has voted
                $votedPhotosIds = $voteManager->getVotedPhotosByUser($this->user['id']);
                // Retrieves all photos with their total number of votes
                $photos = $voteManager->selectAllWithVotes();

                // Create an associative table to store the votes by photo
                $votesByPhoto = [];
                foreach ($totalVotesByPhoto as $voteData) {
                    $votesByPhoto[$voteData['photo_id']] = $voteData['total_votes'];
                }

                return $this->twig->render('Photo/vote.html.twig', [
                    'photos' => $photos,
                    'votesByPhoto' => $votesByPhoto,
                    'votedPhotosIds' => $votedPhotosIds
                ]);
            }

            header('Location: /vote');
            exit();
        }

        $photoManager = new PhotoManager();
        $photos = $photoManager->selectAllWithUsername('id');

        shuffle($photos);

        return $this->twig->render('Photo/index.html.twig', [
            'photos' => $photos,]);
    }
}
