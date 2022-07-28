<div class="container">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="toolbar hidden-print">
                        <div class="text-end">
                            <button type="button" class="btn btn-dark" onclick="printinvoice()" ><i class="fa fa-print"></i>Print</button>
                            <button type="button" class="btn btn-danger" id="download"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
                        </div>
                        <hr>
                    </div>
                    <style>
                        @media print{
                            body * {
                                visibility:hidden;
                            }
                            .invoice *{
                                visibility:visible;
                            }
                            
                        }
                    </style>
                    <div class="invoice overflow-auto" id="invoice">
                        <div style="min-width: 600px">
                            <header>
                                <div class="row">
                                    <div class="col">
                                        <a href="javascript:;">
                                                        <img src="AddProducts/picthumb.jpg" width="80" alt="">
                                                    </a>
                                    </div>
                                    <div class="col company-details">
                                        <h2 class="name">
                                            <a target="_blank" href="javascript:;">
                                        SHRI RAAM TEX
                                        </a>
                                        </h2>
                                        <div>2nd Cross Street, Colombo - 11, Sri Lanka</div>
                                        <div>(011)2 458 1247</div>
                                        <div>shriraamtex@gmail.com</div>
                                    </div>
                                </div>
                            </header>
                            <main>
                            <?php
                                if(isset($_GET['id'])){
                                    $id = $_GET['id'];
                                    include('../../database/dbconn.php');


                                $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id= $id");
                                $stmt->execute();
                                $res = $stmt->fetch();
                                $count = $stmt->rowCount();
                                }
                                    
                                ?>
                                <div class="row contacts">
                                    <div class="col invoice-to">
                                        <div class="text-gray-light">INVOICE TO:</div>
                                        <h2 class="to"><?php echo $res['first_Name'] ?> <?php echo $res['last_Name'] ?></h2>
                                        <div class="address"><?php echo $res['shipping_address'] ?></div>
                                        <div class="email"><?php echo $res['email'] ?>
                                        </div>
                                    </div>
                                    <div class="col invoice-details">
                                        <h1 class="invoice-id">INVOICE <?php echo $res['order_id'] ?></h1>
                                        <div class="date"><?php echo $res['created_at'] ?></div>
                                    </div>
                                </div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th class="text-left">Product Name</th>
                                            <th class="text-right">Price</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                            <?php
                                                $stmt2 = $conn->prepare("SELECT * FROM orderitems AS orditems INNER JOIN product as prod ON orditems.product_id= prod.product_id WHERE orders_id = $id");
                                                $stmt2->execute(); ?>
                                                
                                                <?php
                                                while($row = $stmt2->fetch()){ ?>
                                                <tr>

                                                    <td class="no"><?php echo $row['product_id'] ?></td>
                                                    <td class="text-left"><?php echo $row['product_name'] ?></td>
                                                    <td class="unit"><?php echo $row['product_price'] ?></td>
                                                    <td class="qty"><?php echo $row['quantity'] ?></td>
                                                    <td class="total"><?php echo $row['value']; ?></td>
                                                    </tr>
                                                <?php } 
                                                ?>
                                        
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">SUBTOTAL</td>
                                            <td><?php echo $res['total'] ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">Discounts(if applied)</td>
                                            <td>(-)<?php echo $res['coupon_Discount'] ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="2">GRAND TOTAL</td>
                                            <td><?php echo $res['sub_total'] ?>.00</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div class="thanks">Thank you!</div>
                                <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">Please print this invoice for any reference</div>
                                </div>
                            </main>
                            <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                        </div>
                        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="card-body text-center">
    Dispatch the order
    <br>
    <form action="" method="post">
    <input type="hidden" name="order_id" value="<?php echo $order_id?>">
    <input type="hidden" name="email" value="<?php echo $email?>">

    <button type="submit" class="btn btn-primary" name="Deliver">Dispatch</button>
</form>
</div>