<?php
// 1) Create Account At Unsplash
// 2) Go To https://unsplash.com/developers
// 3) Create Project At https://unsplash.com/oauth/applications
// 4) Type Your Unsplash Project Client ID
$client_id = "YourClientID";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.unsplash.com/photos/?client_id={$client_id}");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

$output = json_decode(curl_exec($ch));
curl_close($ch);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unsplash Gallery Project</title>
    <link rel="icon" type="image/png" href="assets/images/u-favicon.png">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
    <!-- dataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.css" />
</head>

<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12 mb-4">
                <h1>Welcome to, Unsplash Photo Album!</h1>
            </div>
            <table id="table" class="table">
                <thead>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    <th>Width</th>
                    <th>Height</th>
                    <th>Color</th>
                    <th></th>
                </thead>
                <tbody>
                    <?php
                    foreach ($output as $row) {
                        $created_date = strtotime($row->created_at);
                        $created_date = date("m.d.Y H:i:s"); ?>
                        <tr>
                            <td>
                                <a href="<?php echo $row->urls->full ?>" target="_blank" rel="nofollow">
                                    <img src="<?php echo $row->urls->small ?>" class="card-img-top" alt="<?php echo $row->alt_description ?>" style="width: 100%; height: 50px;">
                                </a>
                            </td>
                            <td><?php echo ucwords($row->alt_description) ?>.</td>
                            <td><?php echo $created_date ?></td>
                            <td><?php echo $row->width ?></td>
                            <td><?php echo $row->height ?></td>
                            <td><?php echo $row->color ?></td>
                            <td>
                                <a href="<?php echo $row->urls->full ?>" class="btn btn-block" style="background-color: <?php echo $row->color ?>; color: gray" target="_blank" rel="nofollow">Get Full Image</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- dataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>
    <script>
        $('#table').DataTable({
		pageLength: 5,
		lengthMenu: [
			[5,10, 20, 30, 40, 50, 100, -1],
			["5","10", "20", "30", "40", "50", "100", "TÃ¼mÃ¼"]
		]
	});
    </script>
</body>

</html>