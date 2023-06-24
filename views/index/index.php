
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://use.fontawesome.com/6afbc1327d.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Spartan:wght@900&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/public/css/styles.css">
	<title>Панель управления - AGGroup</title>
</head>
<body>
<?php include ROOT.'/public/layouts/header.php'; ?>
<section class="content">
<div class="container">
    <div class="d-flex row">
        <div class="col-9">
            <div class="d-flex row gallery" style="padding-top: 20px;">
                <?
                foreach ($images as $img){
                        ?>
                        <a href="/p/<?= $img['url']?>" class="col-md-3 col-6 gallery-item no-tilte" title="<?= $img['promt']?>" style="max-height: 700px;">

                            <img src="<?= $img['img']?>" alt="<?= $img['promt']?>" style="max-width: 100%; max-width: 100%;" loading="lazy">

                        </a>
                        <?
                }
                ?>
            </div>
        </div>
        <div class="col-3">
            <div class="sticky-top" style="padding-top: 20px;">
                <div class="blue-box">
                    <div style="position: absolute; bottom: 40px; left: 40px; right: 40px;">
                    <h1>Save your promts for all</h1>
                    </div>
                </div>
                <div class="white-box">
                    <div style="position: absolute; bottom: 40px; left: 40px; right: 40px;">
                        <h1>Save your promts for all</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
	
</body>
</html>