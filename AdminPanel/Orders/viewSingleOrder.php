<?php 
require 'phpmailer/include/PHPMailer.php';
require 'phpmailer/include/SMTP.php';
require 'phpmailer/include/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


include('../../database/orderDbconfig.php');


$errors = array("code"=>'',"value"=>'',"name"=>'',"status"=>'');

if(isset($_GET['id'])){
		
    // escape sql chars
    try{
    $order_id =  $_GET['id'];        
    $res = getOrderByid($order_id);
    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }       
}
if(isset($_POST['Deliver'])){


    $id = $_POST['order_id'];
    $email = $_POST['email'];

    $result = deliverOrder($id); 
    if($result){
            $mail = new PHPMailer();

            $mail->isSMTP();

            $mail->Host = "smtp.gmail.com";

            $mail->SMTPAuth = "true";

            $mail->SMTPSecure = "tls";

            $mail->Port = 587;

            $mail->Username = "texshriraam@gmail.com";

            $mail->Password = 'xmtbxtrpvwrjwadh';

            $mail->Subject = "Order Dispatched";

            $mail->isHTML(true);

            $mail->setFrom('texshriraam@gmail.com');

            $mail->Body ="<h1>Your order has been arranged and being dispatched</h1><br><a href='http://localhost/SRT/UserDash/Orders/viewMySingleOrder.php?order_id=$order_id'>View your order</a><p>You will recieve the products at any moment. Make sure you place a review and tell the others on how you feel.</p></div>";

            $mail->addAddress($email);

            if($mail->Send()){
                echo"sent";
            } else {
                echo "Error";
            }

            $mail->smtpClose();
    }
}

if(isset($_POST['prepare'])){


    $id = $_POST['order_id'];
    $email = $_POST['email'];

    $result = prepareOrder($id); 
    if($result){
            $mail = new PHPMailer();

            $mail->isSMTP();

            $mail->Host = "smtp.gmail.com";

            $mail->SMTPAuth = "true";

            $mail->SMTPSecure = "tls";

            $mail->Port = 587;

            $mail->Username = "texshriraam@gmail.com";

            $mail->Password = 'shriraamtex';

            $mail->Subject = "Order Confirmation";

            $mail->isHTML(true);

            $mail->setFrom('texshriraam@gmail.com');

            $mail->Body ="<h1>Your order is been prepared by us. Will be ready to dispatch any time soon.</h1><br><a href='http://localhost/SRT/UserDash/Orders/viewMySingleOrder.php?order_id=$order_id'>View your order</a><p>You will recieve the products at any moment. Make sure you place a review and tell the others on how you feel.</p></div>";

            $mail->addAddress($email);

            if($mail->Send()){
                echo"sent";
            } else {
                echo "Error";
            }

            $mail->smtpClose();
    }
}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>View Single Order</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="../Admin/css/styles.css" rel="stylesheet" />
      <link rel="shortcut icon" type="image/x-icon" href="../../styles/assets/images/Settings.svg" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

        
        <link href="invoice.css" rel="stylesheet" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
          <?php include('../Admin/templates/navbar.php') ?>

        
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
           <?php include('../Admin/templates/sidebar.php') ?>

            </div>
            <div id="layoutSidenav_content">

           
             <div class="container">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="toolbar hidden-print">
                        <div class="text-end">
                            <button type="button" class="btn btn-dark" onclick="window.print()" ><i class="fa fa-print"></i>Print</button>
                            <button type="button" class="btn btn-danger" id="download"><i class="fa fa-file-pdf"></i> Export as PDF</button>
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
                                            <img src="../../styles/assets/images/logo/SRTlogo.png" width="200" alt="">
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
                                            <h2 class="to"><?php echo htmlspecialchars($res['first_Name']) ?> <?php echo htmlspecialchars($res['last_Name']) ?></h2>
                                            <div class="address"><?php echo htmlspecialchars($res['shipping_address']) ?>
                                        </div>
                                            <?php
                                                $email = htmlspecialchars($res['email']);
                                            ?>
                                        <div class="email"><?php echo htmlspecialchars($res['email']) ?><br> Status :
                                        <?php echo htmlspecialchars($res['isDelivered']) ?>
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
                                            <th>SKU</th>
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
                                                while($row = $stmt2->fetch()){ 
                                                ?>

                                                <tr>


                                                    <td class="no"><?php echo $row['product_id'] ?></td>
                                                    <td class="unit"><?php echo $row['product_sku'] ?></td>
                                                    <td class="text-left">
                                                    <a href="../Products/viewSingleProduct.php?id=<?php echo $row['product_id'] ?>">
                                                    <?php echo $row['product_name'] ?>
                                                    </a>
                                                    </td>
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
                                <div class="notices">
                                    <div>NOTICE:</div>
                                    <div class="notice">Please print this invoice for any reference</div>
                                </div>
                            </main>
                            <footer>Invoice was created on a computer and is valid without the signature and seal.</footer>
                        </div>
                        
                        <div></div>
                    </div>
                </div>
            </div>
        <div class="card-body text-center">
            <br>
            <form action="" method="post">
            <input type="hidden" name="order_id" value="<?php echo $order_id?>">
            <input type="hidden" name="email" value="<?php echo $email?>">
            <?php
            $status = $res['isDelivered'];
            
            if($status =='Processing'){  ?>

            <button type="submit" class="btn btn-primary" name="Deliver">Dispatch</button>

            <?php    } elseif($status == 'Delivered'){  ?>

            <?php    }else { ?>

            <button type="submit" class="btn btn-primary" name="prepare">Prepare</button>

            <?php } ?>

        </form>
        </div>
    </div>
    </div>




         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="../Admin/js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script>
            window.onload = function () {
            document.getElementById("download")
                .addEventListener("click", () => {
                    const invoice = this.document.getElementById("invoice");
                    console.log(invoice);
                    console.log(window);
                    var opt = {
                        margin: 1,
                        filename: 'myfile.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2 },
                        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                    };
                    html2pdf().from(invoice).set(opt).save();
                })
        }
        </script>
    </body>
</html>

</html>
