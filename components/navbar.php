<nav>
    <div class="container">
        <div class="left-nav">
            <ul>
                <li class="navbar-item">
                    <a href="/" class="<?php active(''); ?>">Images</a>
                </li>
                <li class="navbar-item">
                    <a href="/tags" class="<?php active('tags'); ?>">Tags</a>
                </li>
                <li class="navbar-item">
                    <a href="/users" class="<?php active('users'); ?>">Users</a>
                </li>
                <li class="navbar-item">
                    <a href="/upload" class="<?php active('upload') ?>">Upload</a>
                </li>
            </ul>
        </div>
        <div class="right-nav">
            <ul>
                <?php if(!isset($_SESSION['id'])): ?>
                    <li class="navbar-item">
                        <a href="/register" class="<?php active('register'); ?>">Register</a>
                    </li>
                    <li class="navbar-item">
                        <a href="/login" class="<?php active('login'); ?>">Log in</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>