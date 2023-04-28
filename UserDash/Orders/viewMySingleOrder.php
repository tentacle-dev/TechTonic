
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVOICE</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <link rel="stylesheet" href="invoice.css">
    <link rel="stylesheet" href="../../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">


</head>

<body>
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
    												<img src="../../images/blacklogo.png" width="300" alt="">
												</a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a target="_blank" href="javascript:;">
									TECH TONIC
									</a>
                                    </h2>
                                    <div>2nd Cross Street, Colombo - 11, Sri Lanka</div>
                                    <div>(011)2 545 4545</div>
                                    <div>techtonic@gmail.com</div>
                                </div>
                            </div>
                        </header>
                        <main>
                        <?php
                            if(isset($_GET['order_id'])){
                                $id = $_GET['order_id'];
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
                                    
                                    <div class="status">Status : <?php echo $res['isDelivered'] ?>
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
                                                <td class="text-left"><a href="../../viewSingleProduct.php?prod_id=<?php echo $row['product_id'] ?>">
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
</body>
<script src="../../bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>
<script>
    function printinvoice(){
        window.print();
    }
</script>
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



</html>