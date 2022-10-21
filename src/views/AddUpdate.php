<?php

$adding = $_SERVER["REQUEST_URI"][strlen('add')];

?>

<div class="container mt-5">
    <form action="<?php echo $_SERVER["REQUEST_URI"] ?>" method="POST">
        <div class="mb-3">
            <label for="Title" class="form-label">Title</label>
            <input type="text" class="form-control" id="Title" value="">
        </div>
        <div class="mb-3">
            <label for="Content" class="form-label">Content</label>
            <textarea class="form-control" id="Content" rows="10"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add page</button></a>
    </form>
</div>