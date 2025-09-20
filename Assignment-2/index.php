<?php
$free = 0;
$proprice = 22;
$premiumprice = 32;

$proText = ($baseprice <= 30 && $baseprice > 20) ? "Pro" : "";
$premiumText = ($premiumprice > 30) ? "Premium" : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $css = 'assets/css/style.css'; ?>
    <link rel="stylesheet" href="<?= $css ?>?v=<?= file_exists($css) ? filemtime($css) : time() ?>">

    <title>Document</title>
</head>

<body>
    <div class="plans">
        <div class="plan">
            <p class="title">Free</p>
            <p class="price"><?php echo ($free == 0) ? "Free" : $free; ?></p>
            <ul class="features">
                <li>Easy to use</li>
                <li>Use 30 days without charge</li>
                <li>1 Free Email</li>
                <li>Free trial</li>
            </ul>
            <button>Free trail</button>
        </div>

        <div class="plan">
            <p class="title-one">Pro </p>
            <p class="price"><?php echo ($proprice == 0) ? "Free" : "$" . $proprice; ?> / month</p>
            <ul class="features">
                <li>All Free features</li>
                <li>Priority support</li>
                <li>Unlimited Emails</li>
                <li>Custom domain</li>
            </ul>
            <button>Buy this</button>
        </div>

        <div class="plan">
            <p class="title">Premium </p>
            <p class="price"><?php echo ($premiumprice==0)? "Free": "$". $premiumprice;?> / month</p>
            <ul class="features">
                <li>All Pro features</li>
                <li>Dedicated account manager</li>
                <li>Custom integrations</li>
                <li>24/7 Support</li>
            </ul>
            <button>Buy this</button>
        </div>
    </div>
</body>

</html>