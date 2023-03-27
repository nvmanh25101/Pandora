<?php

  session_start();
  require './database/connect.php';

  $where = 1;
  if(isset($_GET['category'])) {
    $category = $_GET['category'];
    $where = "category_detail_id = '$category'";
  }

  $search = '';
  if(isset($_POST['search'])) {
      $search = htmlspecialchars($_POST['search'], ENT_QUOTES);
      $where = "products.name like '%$search%'";
  }

  $sql = "SELECT products.*, category_detail.name as category_name FROM products
  join category_detail on category_detail.id = products.category_detail_id
  where $where
  order by category_detail_id ASC, products.id desc";

  $result = mysqli_query($connect, $sql);
  if(mysqli_num_rows($result) == 0) {
    $error = 'Không có sản phẩm nào';
  }
  else {
    $category_name = mysqli_fetch_array($result)['category_name'];
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pandora Việt Nam</title>
	<link rel="shortcut icon" type="image" href="">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="js/app.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
</head>

<body>
	<?php require './header.php'; ?>

	<?php require './footer.php'; ?>

	<div id="hotline">
		<a href="tel:0333135698" id="yBtn">
			<i class="bi bi-telephone-fill"></i>
		</a>
		<div class="text-quotes">
			<a href="tel:0333135698">0333135698</a>
		</div>
	</div>
	<div id="backtop">
		<i class="bi bi-chevron-compact-up"></i>
	</div>



	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>


	<script src="js/app.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
	<script src="./assets/js/notify.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
	<script>
		$('document').ready(function () {
			$("#search").autocomplete({
				source: "search.php"
			}).autocomplete("instance")._renderItem = function (ul, item) {
				return $("<li class='sub-search-item'>")
					.append(`<a href='./product.php?id=${item.value}' class='sub-search-link'>
                <img class='sub-search-link__img' src='./assets/images/products/${item.image}' alt=''>
                <h5 class='sub-search-link__name'>
                  ${item.label}
                </h5>
                <span class='sub-search-link__price'>
                ${item.price}&#8363
                </span>
              </a>`
					)
					.appendTo(ul);
			};

			$.notify("<?php echo $_SESSION['success']; unset($_SESSION['success']); ?>", "success");
		});
	</script>

</body>

</html>