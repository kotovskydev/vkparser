
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="<?= $keywords?>, Midjourney Promts, AI promts, Image By AI, png, clipart, art by AI">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://use.fontawesome.com/6afbc1327d.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Spartan:wght@900&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/public/css/styles.css">
	<title><?= $title?> | ByMidjourney</title>
</head>
<body>
<div class="content-block">
<?php include ROOT.'/public/layouts/header.php'; ?>
<section class="content">
<div class="container">
    <div class="d-flex row" style="">
        <div class="col-md-9">
            <div class="d-flex align-items-center flex-wrap">
                <a href="/"><div class="breadcrumb">MidjourneyPromts</div></a>
                <a href="/p/<?= $img['url'] ?>"><div class="breadcrumb"><?= $title;?></div></a>

            </div>
            <p>Image by Midjourney</p>
            <h1><?= $title;?></h1>
            <div class="d-flex row gallery" style="padding-top: 20px;">
                <div class="col-md-4 item">
                    <img src="<?= $img['img']?>" alt="<?= $img['promt']?>" style="max-width: 100%; max-width: 100%;" loading="lazy">
                </div>
                <div class="col-md-6">
                    <p class="promt">

                        <span id="promt"><?= $img['promt']?></span>
                    </p>
                    <div style="margin-top: 30px;">
                        <button>Copy to buffer</button>
                    </div>
                    <div style="margin-top: 30px;" class="white-box-one d-flex justify-content-center">
                       <p>Created by <a href="https://midjourney.com/" target="_blank">Midjourney</a></p>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-md-3">
<!--            <div style="background: #2c3034; width: 100%; height: 800px;" class="d-flex justify-content-center align-items-center">-->
<!--                AD BLOCK-->
<!--            </div>-->
        </div>

        <div class="col-md-12">
            <div  class="d-flex row gallery" style="margin-top: 30px;">
                <div style="padding: 20px 0px">
                    <h2>Similar promts</h2>
                </div>
                <?
                foreach ($similar as $img){
                    ?>
                    <a href="/p/<?= $img['url']?>" class="col-md-2 col-6 gallery-item no-tilte" title="<?= $img['promt']?>" style="max-height: 700px;">

                        <img src="<?= $img['img']?>" alt="<?= $img['promt']?>" style="max-width: 100%; max-width: 100%;" loading="lazy">

                    </a>
                    <?
                }
                ?>
            </div>
        </div>
    </div>
</div>
</section>
</div>
<?php include ROOT.'/public/layouts/footer.php'; ?>
</body>
</html>