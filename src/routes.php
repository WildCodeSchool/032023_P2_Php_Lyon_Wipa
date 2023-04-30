<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $PhotoController->edit(1)
return [
    '' => ['PhotoController', 'index',],
    'photos/add' => ['PhotoController', 'add',],
    'photos' => ['PhotoController', 'index',],
    'photo/edit' => ['PhotoController', 'edit', ['id']],
    'photo/delete' => ['PhotoController', 'delete',],

    'photos/show' => ['PhotoController', 'show', ['id']],

    'register' => ['RegisterController', 'register',],
    'login'  => ['UserController', 'login',],
    'logout'  => ['UserController', 'logout',],
    'user'  => ['UserController', 'profil',],
    'user/follow'  => ['UserController', 'follow',],
    'fav/add' => ['FavController', 'addFav',],
];
