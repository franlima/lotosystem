<a class="active item" href="<?php echo ROOT_URL; ?>">
    <i class="home icon"></i>
    Home
</a>
<?php if(isset($_SESSION['is_logged_in'])) : ?>
    <a class="item" href="<?php echo ROOT_URL; ?>operations/add">
        <i class="block layout icon"></i>
        Operations
    </a>
    <a class="item" href="<?php echo ROOT_URL; ?>reports/">
        <i class="calendar icon"></i>
        Reports
    </a>
<?php endif; ?>
<?php if(isset($_SESSION['is_logged_in'])) : ?>
    <a class="item" href="<?php echo ROOT_URL; ?>users/logout">
        <i class="sign-out icon"></i>
        Logout
    </a>
<?php else : ?>
    <a class="item" href="<?php echo ROOT_URL; ?>users/login">
        <i class="sign-in icon"></i>
        Login
    </a>
<?php endif; ?>
</div>