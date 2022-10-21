<nav class="navbar navbar-expand-lg bg-light border">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link 
                        <?php

                        use Controllers\Application;

                        $pages = Application::$pages;

                        //The values are hardcoded because there are only two instances
                        (!isset($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO'] == '/Admin/view')
                            ? print('active" aria-current="page') : null;
                        ?>
                        " href="/content-management-system<?php
                                                            Application::$isAdmin
                                                                ? print('/Admin/view')
                                                                : print('/');
                                                            ?>">
                        <?php
                        echo $pages[0]->getTitle();
                        ?>
                    </a>
                </li>

                <?php
                foreach (array_slice($pages, 1) as $page) :

                    if (isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] != '/Admin/view') {
                        $keyword = substr($_SERVER['PATH_INFO'], -strlen($page->getTitle()));
                    } else {
                        $keyword = $pages[0]->getTitle();
                        $currentPage = $pages[0];
                    }

                    $isCurrentPage = ($keyword == $page->getTitle());

                    $isCurrentPage ? $currentPage = $page : null;

                ?>
                    <li class="nav-item">
                        <a class="nav-link<?php

                                            $isCurrentPage ? print(' active" aria-current="page') : null;

                                            ?>" href="/content-management-system/<?php


                                                                                    if (isset($_SERVER['PATH_INFO']) && Application::$isAdmin) {
                                                                                        $prefix = 'Admin/view/';
                                                                                    } else {
                                                                                        $prefix = '';
                                                                                    }

                                                                                    echo $prefix . $page->getTitle();

                                                                                    ?>">
                            <?php
                            echo $page->getTitle();
                            ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container">
    <?php
    isset($currentPage) ? print($currentPage->getContent()) : print('{{Content}}');
    ?>
</div>