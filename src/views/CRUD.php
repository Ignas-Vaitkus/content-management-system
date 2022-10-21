<?php

use Controllers\Application;
?>

<div class="container">
    <h1 class="display-3 p-4">Manage pages</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

            <tr id="1">
                <td><?php echo Application::$pages[0]->getTitle(); ?></td>
                <td>
                    <a class="text-decoration-none" href="/content-management-system/Admin/edit/1"><button type="button" class="btn btn-primary btn-sm">Edit</button></a>
                    <form action="/content-management-system/Admin/delete/1" class="d-inline-flex" method="POST">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>

            <?php

            foreach (array_slice(Application::$pages, 1) as $page) :
            ?>
                <tr>
                    <td><?php echo $page->getTitle(); ?></td>
                    <td>
                        <a class="text-decoration-none" href="/content-management-system/Admin/edit/<?php
                                                                                                    echo $page->getID();
                                                                                                    ?>">
                            <button type="button" class="btn btn-primary btn-sm">Edit</button>
                        </a>
                        <form action="/content-management-system/Admin/delete/<?php
                                                                                echo $page->getID();
                                                                                ?>" class="d-inline-flex" method="POST">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="mt-5"><a href="/content-management-system/Admin/add"><button type="button" class="btn btn-secondary">Add page</button></a></div>
</div>