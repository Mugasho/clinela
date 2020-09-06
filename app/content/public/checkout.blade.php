<?php
$db = new \clinela\database\DB();
$id = $this->getPageVars();
$doctor = $db->getUserMeta($id);
$patient_id=$_SESSION['id'];
$patient=$db->getUserMeta($patient_id);
$names = empty($doctor['first_name']) && empty($doctor['last_name']) ? $doctor['username'] : $doctor['first_name'] . ' ' . $doctor['last_name'];
$img = !empty($doctor['photo']) ? CONTENT_PATH . 'uploads/' . $doctor['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
$logo=!empty($db->getOptions('header_logo'))?CONTENT_PATH.'uploads/'.$db->getOptions('header_logo'):CONTENT_PATH.'public/img/clinela-logo-red.jpg';
$city = !empty($doctor['city']) ? $doctor['city'] . ', ' : '';
$state = !empty($doctor['state']) ? $doctor['state'] . ', ' : '';
$country = !empty($doctor['country']) ? $doctor['country'] : '';
$slot_id=$_GET['slot_id'];
$slot=$db->getSlotByID($id);
$service=$db->getServiceByID($_GET['service_id']);
$amount=$service['amount'];
$booking_fee=$db->getOptions('booking_fee');
$tax=($db->getOptions('tax')/100)*$amount;
$total=$amount+$booking_fee+$tax;
?>
<div class="container">

    <div class="row">
        <div class="col-md-7 col-lg-8">
            <div class="card">
                <div class="card-body">

                    <!-- Checkout Form -->
                    <form action="" method="post">
                        <input hidden name="book_date" value="<?php echo $_GET['book_date']?>">
                        <input hidden name="slot_id" value="<?php echo $_GET['slot_id']?>">
                        <input hidden name="service_id" value="<?php echo $_GET['service_id']?>">
                        <input hidden name="amount" value="<?php echo $amount?>">
                        <input hidden name="fee" value="<?php echo $booking_fee?>">
                        <input hidden name="tax" value="<?php echo $tax?>">
                        <input hidden name="total" value="<?php echo $total?>">
                        <div class="payment-widget">
                            <h4 class="card-title">Payment Method</h4>

                            <!-- Credit Card Payment -->
                            <div class="payment-list">
                                <label class="payment-radio credit-card-option">
                                    <input type="radio" name="credit" checked>
                                    <span class="checkmark"></span>
                                    Mobile Money
                                </label>

                                <form>
                                    <div class="terms-accept">
                                        <div class="custom-checkbox">
                                            <input type="checkbox" id="terms_accept" required="required">
                                            <label for="terms_accept">I have read and accept <a href="#">Terms &amp;
                                                    Conditions</a></label>
                                        </div>
                                    </div>
                                    <script src="https://checkout.flutterwave.com/v3.js"></script>
                                    <div class="submit-section mt-4">
                                    <button type="button"  class="btn btn-primary submit-btn" onClick="makePayment()">Confirm and Pay</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /Credit Card Payment -->

                            <!-- Paypal Payment -->
                           <!-- <div class="payment-list">
                                <label class="payment-radio paypal-option">
                                    <input type="radio" name="paypal" value="paypal">
                                    <span class="checkmark"></span>
                                    Paypal
                                </label>
                            </div>-->
                            <!-- /Paypal Payment -->

                            <!-- Terms Accept -->

                            <!-- /Terms Accept -->

                            <!-- Submit Section
                            <div class="submit-section mt-4">
                                <button type="submit" class="btn btn-primary submit-btn">Confirm and Pay</button>
                            </div> -->
                            <!-- /Submit Section -->

                        </div>
                    </form>
                    <!-- /Checkout Form -->

                </div>
            </div>

        </div>

        <div class="col-md-5 col-lg-4 theiaStickySidebar">

            <!-- Booking Summary -->
            <div class="card booking-card">
                <div class="card-header">
                    <h4 class="card-title">Booking Summary</h4>
                </div>
                <div class="card-body">

                    <!-- Booking Doctor Info -->
                    <div class="booking-doc-info">
                        <a href="doctor-profile.html" class="booking-doc-img">
                            <img src="<?php echo $img?>" alt="User Image">
                        </a>
                        <div class="booking-info">
                            <h4><a href="doctor-profile.html">Dr. <?php echo $names?></a></h4>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating">35</span>
                            </div>
                            <div class="clinic-details">
                                <p class="doc-location"><i class="fas fa-map-marker-alt"></i> <?php echo $city.$country?></p>
                            </div>
                        </div>
                    </div>
                    <!-- Booking Doctor Info -->

                    <div class="booking-summary">
                        <div class="booking-item-wrap">
                            <ul class="booking-date">
                                <li>Date <span><?php echo date("d M Y",strtotime($_GET['book_date']))?></span></li>
                                <li>Time <span><?php echo date("h:i A",strtotime($_GET['book_date'])).'-'.date("h:i A",strtotime($_GET['end_date']));?></span></li>
                            </ul>
                            <ul class="booking-fee">
                                <li><?php echo $service['services']?>  Fee <span>UGX<?php echo $amount?></span></li>
                                <li>Booking Fee <span>UGX <?php echo $booking_fee?></span></li>
                                <li>VAT(<?php echo $db->getOptions('tax')?>%)<span>UGX<?php echo $tax?></span></li>
                            </ul>
                            <div class="booking-total">
                                <ul class="booking-total-list">
                                    <li>
                                        <span>Total</span>
                                        <span class="total-cost">UGX <?php echo $total?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Booking Summary -->

        </div>
    </div>

</div>


<script>
    function makePayment() {
        FlutterwaveCheckout({
            public_key: "<?php echo $db->getOptions('flutterwave_public_key')?>",
            tx_ref: "hooli-tx-1920bbtyt",
            amount: <?php echo $total?>,
            currency: "UGX",
            payment_options: "card, mobilemoneyuganda, ussd",
            redirect_url: // specified redirect URL
                "<?php echo BASE_PATH?>payment/<?php echo $id.'/?slot_id='.$slot_id.'&book_date='
                    .$_GET['book_date'].'&service_id='.$_GET['service_id'].'&amount='.$amount.'&tax='
                    .$tax.'&credit=1&total='. $total.'&fee='.$booking_fee?>",
            meta: {
                consumer_id: <?php echo $patient_id?>,
                consumer_mac: "92a3-912ba-1192a",
            },
            customer: {
                email: "<?php echo $doctor['email']?>",
                phone_number: "<?php echo $patient['phone']?>",
                name: "<?php echo $patient['first_name'].' '.$patient['last_name']?>",
            },
            callback: function (data) {
                console.log(data);
            },
            onclose: function() {
                // close modal
            },
            customizations: {
                title: "Clinela Doctors",
                description: "Payment for items in cart",
                logo: "<?php echo $logo?>",
            },
        });
    }
</script>


