<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $PhotoController->edit(1)
return [
    '' => ['PhotoController', 'index',],
    'add' => ['PhotoController', 'add',],
    'items' => ['PhotoController', 'index',],
    'items/edit' => ['PhotoController', 'edit', ['id']],
    'items/show' => ['PhotoController', 'show', ['id']],
    'items/delete' => ['PhotoController', 'delete',],
];
