<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tasks</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    <script src="js/randomColor.js"></script>
    <script src="js/Chart.bundle.min.js"></script>
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="index.php">Tasks</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          
        </div>
      </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="container">

      <?php
      include_once("functions.php");
      ?>


      <div class="container-fluid">
        <div class="row">
        
          <div class="col-md-12">
            <?php
             echo getControlForm(); 
			 
			 
             ?>
			 
			
          </div>
        
        </div>
      </div>

    </main>

    <footer class="footer">
      <div class="container">
        <span class="text-muted">
          <?php echo "Bitcoin: ".file_get_contents("bitcoin_price.txt")." USD"; ?>
        </span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script src="https://code.jquery.com/jquery-3.1.1.min.js">
    <script src="js/script.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-slim.min.js"><\/script>')</script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/find.js"></script>
	<script src="js/buttons.js"></script>
	
	
  </body>
</html>
