<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $title ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/360805e100.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/css/index.css" />
    <?php include_css(); ?>
  </head>

  <body>
    <div class="layer">
      <header>
        <?php include_partial('header') ?>
      </header>

      <section class="content">
        <div class="container">
          <?php include_view() ?>
        </div>
      </section>
    </div>

    <script src="/assets/js/index.js"></script>
    <?php include_scripts(); ?>
  </body>
</html>