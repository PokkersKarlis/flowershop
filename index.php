<?php

require_once 'vendor/autoload.php';

use App\Shop;
use App\Order;
use App\Supliers\FlowerBase;
use App\Supliers\LatvianShop;


$shop = new Shop();
$shop->addSupplier(new FlowerBase);
$shop->addSupplier(new LatvianShop());
$order = new Order();

?>
    <html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
              crossorigin="anonymous">

        <style>
            img {
                height: 200px;
            }
        </style>
    </head>
    <table class="table table-dark">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>

        <?php
        foreach ($shop->products()->all() as ['product' => $product, 'amount' => $amount]) {
            ?>
            <tr>
                <th>
                    <?= $product->sellable()->name() ?>
                </th>
                <th>
                    <?= $product->price() ?>
                </th>
                <th>
                    <?= $amount ?>
                </th>
                <?php $order->addProductData($product->sellable()->name(), $amount, $product->price()); ?>
            </tr>
            <?php
        }
        ?>
    </table>

    <form action="/" method="get">
        <label for="cars">Enter your gender:</label>

        <select name="gender">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>

        <label for="cars">Select Flowers:</label>

        <select name="flower">
            <?php foreach ($shop->products()->all() as ['product' => $product, 'amount' => $amount]) { ?>
                <option value="<?= $product->sellable()->name() ?>"><?= $product->sellable()->name() ?></option>
            <?php } ?>
        </select>

        <label for="fname">Select amount:</label>
        <input type="number" name="amount"><br><br>
        <input type="submit" name="submit">
    </form>
<?php
if (isset($_GET['submit'])) {
    $order->setPerson($_GET['gender']);
    $order->setProductNames();


    $order->setSelectedProduct($_GET['flower']);

    if ($_GET['amount'] > $order->getProductData()[$order->getSelectedProduct()][0]) {
        ?>

        <div class="alert alert-danger" role="alert">
            Invalid amount!
        </div>

        <?php
    } else {
        $order->setAmount($_GET['amount']);
    }
    ?>

    <div class="col-12">
        <div class="card flex-md-row mb-4 box-shadow h-md-250">
            <div class="card-body d-flex flex-column align-items-start">
                <strong class="d-inline-block mb-2 text-success">Order Approved</strong>
                <div class="mb-1 text-muted">You ordered:</div>
                <h3 class="mb-0">
                    <a class="text-dark" href="#"><?= $order->getSelectedProduct() ?></a>
                </h3>
                <div class="mb-1 text-muted">Order amount: <?= $order->getAmount() ?></div>
                <p class="card-text mb-auto">With a total price of
                    <?php
                    if ($order->getPerson() === 'female') {
                        echo ($order->getProductData()[$order->getSelectedProduct()][1] * $order->getAmount()) * 0.8 . PHP_EOL;
                    } else {
                        echo $order->getProductData()[$order->getSelectedProduct()][1] * $order->getAmount() . PHP_EOL;
                    }
                    ?>
                </p>
            </div>
            <img class="card-img-right flex-auto d-none d-md-block"
                 src="https://images.ctfassets.net/ucgi79tscdcj/6OeqvTmMzDcxEQtpFnO3b0/8fd453ffa4c38b9fc9c0951a569d3f20/roses-business-gifting.jpg?w=600&fm=webp"
                 alt="Card image cap">
        </div>
    </div>

    <div class="alert alert-primary" role="alert">
        Left in the shop:
    </div>
    <table class="table table-dark">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>

        <?php
        foreach ($shop->products()->all() as ['product' => $product, 'amount' => $amount]) {
            ?>
            <tr>
                <th>
                    <?= $product->sellable()->name() ?>
                </th>
                <th>
                    <?= $product->price() ?>
                </th>
                <th>
                    <?php
                    if ($product->sellable()->name() === $order->getSelectedProduct()) {
                        echo $amount - $order->getAmount();
                    } else {
                        echo $amount;
                    } ?>
                </th>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
?>