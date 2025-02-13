<?php
require_once("header.php");
?><div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
<ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-link d-flex align-items-center gap-2 " aria-current="page" href="home.php">
      <svg class="bi"><use xlink:href="#house-fill"/></svg>
      Dashboard
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link d-flex align-items-center gap-2 active" href="posts.php">
      <svg class="bi"><use xlink:href="#file-earmark"/></svg>
      Posts
    </a>
  </li>          
  <li class="nav-item">
    <a class="nav-link d-flex align-items-center gap-2" href="../../handle_logout.php">
      <svg class="bi"><use xlink:href="#door-closed"/></svg>
      Logout
    </a>
  </li>
</ul>
</div>
</div>
</div>
<?php
require_once("footer.php");
?>
