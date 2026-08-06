<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Damyan Tsvetkov — Software Engineer</title>
    <meta name="description" content="Portfolio of Damyan Tsvetkov — Computer Technologies student and software engineer building Android apps, web projects and more." />
    <link rel="icon" type="image/x-icon" href="Image-Main Page/graphic-design.ico" />
    <link href="CSS/variables.css" rel="stylesheet" />
    <link href="CSS/base.css" rel="stylesheet" />
    <link href="CSS/loading-screen.css" rel="stylesheet" />
    <link href="CSS/navigation-bar.css" rel="stylesheet" />
    <link href="CSS/hero.css" rel="stylesheet" />
    <link href="CSS/highlights.css" rel="stylesheet" />
    <link href="CSS/skills.css" rel="stylesheet" />
    <link href="CSS/timeline.css" rel="stylesheet" />
    <link href="CSS/projects.css" rel="stylesheet" />
    <link href="CSS/certificates.css" rel="stylesheet" />
    <link href="CSS/contact.css" rel="stylesheet" />
    <link href="CSS/footer.css" rel="stylesheet" />
    <link href="CSS/btn-back-top.css" rel="stylesheet" />
    <link href="CSS/responsive.css" rel="stylesheet" />
  </head>
  <body class="loading">
    <?php require __DIR__ . '/partials/loading-screen.php'; ?>
    <?php require __DIR__ . '/partials/navbar.php'; ?>

    <div id="container">
      <main>
        <?php require __DIR__ . '/partials/hero.php'; ?>
        <?php require __DIR__ . '/partials/highlights.php'; ?>
        <?php require __DIR__ . '/partials/skills.php'; ?>
        <?php require __DIR__ . '/partials/experience.php'; ?>
        <?php require __DIR__ . '/partials/education.php'; ?>
        <?php require __DIR__ . '/partials/projects.php'; ?>
        <?php require __DIR__ . '/partials/certificates.php'; ?>
        <?php require __DIR__ . '/partials/contact-section.php'; ?>
      </main>
    </div>

    <?php require __DIR__ . '/partials/back-to-top.php'; ?>
    <?php require __DIR__ . '/partials/footer.php'; ?>

    <script src="JS/loading.js"></script>
    <script src="JS/menu.js"></script>
    <script src="JS/btn-back-top.js"></script>
    <script src="JS/reveal.js"></script>
    <script src="JS/contact.js"></script>
  </body>
</html>
