<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">

  <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Navigation</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-around" id="navbarResponsive">
    <ul class="navbar-nav">
      <li class="nav-item <?= ($loc == 'recipe') ? 'active' : ''; ?> px-lg-4">
        <a class="nav-link" href="http://<?= BASE_URL ?>index.php?loc=recipe">Recipes</a>
      </li>
      <li class="nav-item <?= ($loc == 'article') ? 'active' : ''; ?> px-lg-4">
        <a class="nav-link" href="http://<?= BASE_URL ?>index.php?loc=article">Articles</a>
      </li>
      <li class="nav-item <?= ($loc == 'user') ? 'active' : ''; ?> px-lg-4">
        <a class="nav-link" href="http://<?= BASE_URL ?>index.php?loc=user">Users</a>
      </li>
      <li class="nav-item <?= ($loc == 'statistic') ? 'active' : ''; ?> px-lg-4">
        <a class="nav-link" href="http://<?= BASE_URL ?>index.php?loc=statistic">Statistics</a>
      </li>
      <li class="nav-item <?= ($loc == 'logOut') ? 'active' : ''; ?> px-lg-4">
        <a class="nav-link" href="http://<?= BASE_URL ?>index.php?loc=logOut">Log Out</a>
      </li>
    </ul>
  </div>
</nav>