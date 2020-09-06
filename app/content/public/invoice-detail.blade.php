<?php
$id=$this->getPageVars();
$db=new \clinela\database\DB();
$appointment=$db->getAppointmentByID($id);
$patient=$db->getUserMeta($appointment['user_id']);
$doctor=$db->getUserMeta($appointment['doctor_id']);
$logo=!empty($db->getOptions('header_logo'))?CONTENT_PATH.'uploads/'.$db->getOptions('header_logo'):CONTENT_PATH.'public/img/clinela-logo-red.jpg';
$service=$db->getServiceByID($appointment['service_id']);
$slot=$db->getSlotByID($appointment['slot_id']);
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12 offset-lg-2 mb-2 d-print-none">
            <button class="btn btn-info" onclick="printInvoice()">Print Invoice</button>
        </div>

        <div class="col-lg-8 offset-lg-2">
            <div class="invoice-content">
                <div class="invoice-item">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="invoice-logo">
                                <img src="<?php echo $logo?>" alt="logo">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p class="invoice-details">
                                <strong>Order:</strong> #<?php echo $appointment['tx_id']?> <br>
                                <strong>Issued:</strong> <?php echo date('d/m/Y',strtotime($appointment['created_at']))?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Invoice Item -->
                <div class="invoice-item">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="invoice-info">
                                <strong class="customer-text">Invoice From</strong>
                                <p class="invoice-details invoice-details-two">
                                    Dr. <?php echo $doctor['first_name'].' '.$doctor['last_name']?><br>
                                    <?php echo $doctor['address'].' '.$doctor['state']?>,<br>
                                    <?php echo $doctor['city'].', '.$doctor['country']?> <br>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="invoice-info invoice-info2">
                                <strong class="customer-text">Invoice To</strong>
                                <p class="invoice-details">
                                    <?php echo $patient['first_name'].' '.$patient['last_name']?> <br>
                                    <?php echo $patient['address'].' '.$patient['state']?>, <br>
                                    <?php echo $patient['city'].', '.$patient['country']?><br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice Item -->

                <!-- Invoice Item -->
                <div class="invoice-item">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="invoice-info">
                                <strong class="customer-text">Payment Method</strong>
                                <p class="invoice-details invoice-details-two">
                                    Mobile Money <br>
                                    <?php echo $patient['phone']?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice Item -->

                <!-- Invoice Item -->
                <div class="invoice-item invoice-table-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="invoice-table table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">VAT</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?php echo !empty($service)?$service['services']:'Booking service'; ?></td>
                                        <td class="text-center">1</td>
                                        <td class="text-center">UGX<?php echo $appointment['tax']?></td>
                                        <td class="text-right">UGX<?php echo $appointment['amount']?></td>
                                    </tr>
                                    <tr>
                                        <td>Booking Fee</td>
                                        <td class="text-center">1</td>
                                        <td class="text-center">0</td>
                                        <td class="text-right">UGX<?php echo $appointment['fee']?></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl-4 ml-auto">
                            <div class="table-responsive">
                                <table class="invoice-table-two table">
                                    <tbody>
                                    <tr>
                                        <th>Subtotal:</th>
                                        <td><span>UGX<?php echo $appointment['amount']?></span></td>
                                    </tr>
                                    <tr>
                                        <th>Total Amount:</th>
                                        <td><span>UGX<?php echo $appointment['total']?></span></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice Item -->

                <!-- Invoice Information -->
                <div class="other-info">
                    <h4>Booking Time</h4>
                    <p class="text-muted mb-0"> <?php echo date("h:i A",strtotime($slot['start_time']))?> - <?php echo date("h:i A",strtotime($slot['end_time']))?></p>
                    <p class="text-muted mb-0"><?php echo $appointment['details']?></p>
                </div>
                <!-- /Invoice Information -->

            </div>
        </div>
    </div>

</div>


<script>
    <?php if (isset($_GET['print'])){
        echo 'window.print();';
    }?>
    function printInvoice(){
        window.print();
    }
</script>