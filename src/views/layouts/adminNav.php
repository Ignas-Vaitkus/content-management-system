<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="./admin">Mini CVS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php
                                        $_SERVER['PATH_INFO'] == '/admin' ? print('active" aria-current="page') : null;

                                        ?>" aria-current="page" href="./admin">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php
                                        $_SERVER['PATH_INFO'] == '/admin/view' ? print('active" aria-current="page') : null;
                                        ?>" href="./admin/view">View Website</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?action=logout">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>