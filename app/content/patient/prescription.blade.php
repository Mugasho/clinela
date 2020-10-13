<?php
$db=new \clinela\database\DB();
$id=$_SESSION['id'];
$patient=$db->getUserMeta($id);
$logo=!empty($db->getOptions('header_logo'))?CONTENT_PATH.'uploads/'.$db->getOptions('header_logo'):CONTENT_PATH.'public/img/clinela-logo-red.jpg';
$prescriptions=$db->getPrescriptions($id);
?>
<div class="container-fluid">

    <div class="row">
        <div class="col-lg-12 offset-lg-2 mb-2 d-print-none">
            <button class="btn btn-info" onclick="printInvoice()">Print Prescription</button>
        </div>

        <div class="col-lg-10 offset-lg-1">
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
                                <strong>Prescription:</strong> #<?php echo date('d/m/Y')?> <br>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Invoice Item -->
                <div class="invoice-item">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6">
                            <div class="invoice-info invoice-info2">
                                <strong class="customer-text">Prescribed To</strong>
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
                <div class="invoice-item invoice-table-wrap">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="invoice-table table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Date </th>
                                        <th>Name</th>
                                        <th>Frequency</th>
                                        <th>Period</th>
                                        <th>Total</th>
                                        <th>Advice</th>
                                        <th>Doctor</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($prescriptions)) {
                                        foreach ($prescriptions as $prescription) {
                                            $doctor=$db->getUserMeta($prescription['doctor_id']);
                                        echo '<tr>
                                                    <td class="text-center">'.date('d M Y',strtotime($prescription['created_at'])).'</td>
                                                    <td class="text-center">'.$prescription['drug_name'].'</td>
                                                    <td class="text-center">'.$prescription['frequency'].'</td>
                                                    <td class="text-center">'.$prescription['days'].'</td>
                                                    <td class="text-center">'.$prescription['total'].' </td>
                                                    <td class="text-center">'.$prescription['advice'].'</td>
                                                    <td class="text-center">'.$doctor['first_name'].' '.$doctor['last_name'].'</td>
                                            </tr>';
                                        }
                                    }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Invoice Item -->


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