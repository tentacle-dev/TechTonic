<?php
// This example sets up an endpoint using the Slim framework.
// Watch this video to get started: https://youtu.be/sGcNPFX1Ph4.

$amount = 1500000;


require 'vendor/stripe/stripe-php/init.php';

  \Stripe\Stripe::setApiKey('sk_test_51JRLgcKAow1Nk4KwLXCfMtsH5VhFKiKOBTcRyD4fOse1LWUZtubh1pUmG5uXulwMzx9rPtlbZ77Eple6mAB20VxA00B1OLrkyw');

  $session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
      'price_data' => [
        'currency' => 'usd',
        'product_data' => [
          'name' => 'SRT',
        ],
        'unit_amount' => $amount,
      ],
      'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'https://example.com/success',
    'cancel_url' => 'https://example.com/cancel',
  ]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    var stripe = Stripe('pk_test_51JRLgcKAow1Nk4KwEilbLtO6UOu0E4BoxON2c5LkGlGLZspg5fY1iFf6N8bykn17xtXsiapPJsr6r10T8sN1raMX0064ch9QhI');
    var session = "<?php echo $session['id'];?>";

    stripe.redirectToCheckout({sessionId:session})
</script>

</body>
</html>