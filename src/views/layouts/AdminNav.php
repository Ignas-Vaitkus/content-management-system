<nav class="navbar navbar-expand-lg bg-secondary bor">
    <div class="container-fluid">
        <a class="navbar-brand" href="/content-management-system/Admin">Mini CMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php
                                        $_SERVER['PATH_INFO'] == '/Admin'
                                            ? print('active" aria-current="page')
                                            : null;
                                        ?>" aria-current="page" href="/content-management-system/Admin">Admin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php
                                        $_SERVER['PATH_INFO'] == '/Admin/view'
                                            ? print('active" aria-current="page')
                                            : null;
                                        ?>" href="/content-management-system/Admin/view">View Websites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/content-management-system/Admin/logout">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

{{Content}}