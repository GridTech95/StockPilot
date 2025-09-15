<?php require_once("models/seg.php");?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>StockPilot</title>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
	<script src="https://cdn.datatables.net/2.3.0/js/dataTables.bootstrap5.js"></script>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.0/css/dataTables.bootstrap5.css">

	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<header>
		<?php
        $pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"]:NULL;
        require_once("models/conexion.php");
        require_once("views/vpf.php");
        require_once("controllers/misfun.php");
        require_once("views/vmen.php");
        
        ?>
	</header>
	<section>
		<?php
		 $pg = isset($_REQUEST["pg"]) ? $_REQUEST["pg"]:NULL;
			if(!$pg OR $pg==1001)
				require_once("views/vemp.php");
			elseif($pg==1002)
				require_once("views/vprod.php");
			elseif($pg==1003)
				require_once("views/vprov.php");
			elseif($pg==1004)
				require_once("views/vusemp.php");
			elseif($pg==1005)
				require_once("views/vcat.php");
			elseif($pg==1006)
				require_once("views/vaud.php");
			elseif($pg==1007)
				require_once("views/vkard.php");
			elseif($pg==1008)
				require_once("views/vlote.php");
			elseif($pg==1009)
				require_once("views/vinv.php");
			elseif($pg==1010)
				require_once("views/vmovim.php");
			elseif($pg==1011)
				require_once("views/vdom.php");
			elseif($pg==1012)
				require_once("views/vval.php");
			elseif($pg==1013)
				require_once("views/vsal.php");
			elseif($pg==1014)
				require_once("views/vsolsal.php");
			elseif($pg==1015)
				require_once("views/vusemp.php");
			elseif($pg==1016)
				require_once("views/vubi.php");
			else
				echo "Pagina No Disponible Para Este Usuario";
		?>
	</section>
	<footer>
		
	</footer>
</body>
	<script src="js/code.js"></script>
</html>