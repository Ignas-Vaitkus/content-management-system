<?php

use Controllers\Application;

$path = $_SERVER["REQUEST_URI"];
$editing = str_contains($path, 'edit');

//Get id from URI

if ($editing) {
    for ($i = strlen($path) - 1; $i > 0; $i--) {
        if ($path[$i] == '/') {
            $id = substr($path, $i + 1 - strlen($path));
            break;
        }
    }
    $id = intval($id);

    //The cycle is not optimized because of expected low batches
    foreach (Application::$pages as $page) {
        if ($page->getID() == $id) {
            $editedPage = $page;
            break;
        }
    }
    //If the page entity is not found return status code 4xx.
}

?>

<div class="container mt-5">
    <form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
        <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
            <input type="text" class="form-control" id="Title" value="<?php $editing
                                                                            ? print $editedPage->getTitle()
                                                                            : '' ?>">
        </div>
        <div class="mb-3">
            <label for="Content" class="form-label">Content</label>
            <textarea class="form-control" id="Content" rows="10"><?php $editing
                                                                        ? print $editedPage->getContent()
                                                                        : '' ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">
            <?php
            $editing ? print 'Edit page' : print 'Add page';
            ?></button></a>
    </form>
</div>