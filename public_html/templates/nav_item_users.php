<?php if (in_array(8, $_SESSION['permissions'])) : ?>
<li id="users"
    class="nav-item">
  <a class="btn nav-link link-light<?php echo ($dir == "users") ? ' active' : ''; ?>"
     href="/users/list"
     tabindex="0">
    <?= $lang['navbar_users']; ?></a>
</li>
<?php endif; ?>
