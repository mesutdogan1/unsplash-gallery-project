<?php
// 1) Create Account At Unsplash
// 2) Go To https://unsplash.com/developers
// 3) Create Project At https://unsplash.com/oauth/applications
// 4) Type Your Unsplash Project Client ID
$client_id="YourClientID";

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
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12 mb-4">
                <h1>Welcome to, Unsplash Photo Album!</h1>
            </div>
            <?php
            foreach ($output as $row) {
                $created_date=strtotime($row->created_at);
                $created_date=date("m.d.Y H:i:s");?>
                <div class="col-md-4 mb-5">
                    <div class="card h-100">
                        <a href="<?php echo $row->urls->full ?>" target="_blank" rel="nofollow">
                            <img src="<?php echo $row->urls->small ?>" class="card-img-top" alt="<?php echo $row->alt_description ?>" style="height: 300px;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">ID: <?php echo $row->id ?></h5>
                            <p class="card-text">
                                <b>Created Date:</b> <?php echo $created_date ?> <br>
                                <b>Width:</b> <?php echo $row->width ?> <br>
                                <b>Height:</b> <?php echo $row->height ?> <br>
                                <b>Color:</b> <?php echo $row->color ?> <br>
                                <?php echo ucwords($row->alt_description) ?>.
                            </p>
                        </div>
                        <div class="card-footer">
                            <a href="<?php echo $row->urls->full ?>" class="btn btn-block" style="background-color: <?php echo $row->color ?>; color: gray" target="_blank" rel="nofollow">Get Full Image</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.2.0/mdb.min.js"></script>
</body>

</html>