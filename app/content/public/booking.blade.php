<?php
$db = new \clinela\database\DB();
$id = $this->getPageVars();
$doctor = $db->getUserMeta($id);
$show = false;
$prev = isset($_GET['prev']) ? $_GET['prev'] : 0;
$next = isset($_GET['next']) ? $_GET['next'] : 0;
$dir_text = '&next=' . $next;
$sv = isset($_GET['s']) ? $_GET['s'] : '';
$names = empty($doctor['first_name']) && empty($doctor['last_name']) ? 'Doctor' : $doctor['first_name'] . ' ' . $doctor['last_name'];
$img = !empty($doctor['photo']) ? CONTENT_PATH . 'uploads/' . $doctor['photo'] : CONTENT_PATH . 'public/img/patients/patient1.jpg';
$slot_select = isset($_GET['slot']) ? $_GET['slot'] : '';
$city = !empty($doctor['city']) ? $doctor['city'] . ', ' : '';
$state = !empty($doctor['state']) ? $doctor['state'] . ', ' : '';
$country = !empty($doctor['country']) ? $doctor['country'] : '';
$sls = $db->getUserSlots($id);
$events = array();
foreach ($sls as $sl) {
    $data = array();
    $dow = $sl['week_day'] != 7 ? $sl['week_day'] : 0;
    $data['title'] = date("h:i A", strtotime($sl['end_time']));
    $data['startTime'] = $sl['start_time'];
    $data['endTime'] = $sl['end_time'];
    $data['daysOfWeek'] = "['" . $dow . "']";
    $data['id'] = $sl['id'];
    //$data['url']='?slot='.$sl['id'].'&s='.$sv;
    $events[] = $data;
}
//echo json_encode($events);
if ($show) {
    $slotsMonday = $db->getUserSlotsByDay($id, 1);
    $slotsTuesday = $db->getUserSlotsByDay($id, 2);
    $slotsWednesday = $db->getUserSlotsByDay($id, 3);
    $slotsThursday = $db->getUserSlotsByDay($id, 4);
    $slotsFriday = $db->getUserSlotsByDay($id, 5);
    $slotsSaturday = $db->getUserSlotsByDay($id, 6);
    $slotsSunday = $db->getUserSlotsByDay($id, 7);
    $start_date = date('N') == 1 ? date('d M Y') : date('d M Y', strtotime('last monday'));
    $slot_select = isset($_GET['slot']) ? $_GET['slot'] : '';
    $dir_text = '';
    if (isset($_GET['next'])) {
        $dir_text = '&next=' . $_GET['next'];
        $start_date = date('d M Y', strtotime($start_date . ' + ' . ($next * 7) . ' days'));
    }
    if (isset($_GET['prev'])) {
        $dir_text = '&prev=' . $_GET['prev'];
        $start_date = date('d M Y', strtotime($start_date . ' - ' . ($prev * 7) . ' days'));
    }
}
$services = $db->getServices($id);
$book_date = '';
$prev++;
$next++;

?>
<style>

    #calendar {
        margin: 0 auto;
    }

    .fc-daygrid-event {
        background-color: #104593;
        color: #f8f9fa;
    }
    .fc-list-event {
        background-color: #104593;
        color: #f8f9fa;
    }
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="booking-doc-info">
                        <a href="<?php echo BASE_PATH . 'doctors' . '/' . $doctor['id'] . '/';?>"
                           class="booking-doc-img">
                            <img src="<?php echo $img;?>" alt="User Image">
                        </a>
                        <div class="booking-info">
                            <h4><a href="doctor-profile.html">Dr. <?php echo $names;?></a></h4>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating">35</span>
                            </div>
                            <p class="text-muted mb-0"><i
                                        class="fas fa-map-marker-alt"></i> <?php echo $city . ', ' . $country;?></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Select Services</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php foreach ($services as $service) {
                            $btn_select = $sv == $service['id'] ? 'info' : 'light';
                            echo '<li class="list-group-item">' . $service['services'] . '<a href="?slot=' . $slot_select . $dir_text . '&s=' . $service['id'] . '" class="btn btn-' . $btn_select . ' float-right")>
                                                           Select <i class="fa fa-check-circle"></i>
                                                        </a></li>
                                                    ';
                        } ?>
                    </ul>

                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div id="calendar"></div>
        </div>
        <?php if($show){?>
        <div class="col-12">


            <div class="row">
                <div class="row">
                    <div class="col-12 col-sm-4 col-md-6">
                        <h4 class="mb-1"><?php echo date('d F Y');?> </h4>
                        <p class="text-muted"><?php echo date('l');?></p>
                    </div>
                    <div class="col-12 col-sm-8 col-md-6 text-sm-right">
                        <div class="bookingrange btn btn-white btn-sm mb-3">
                            <i class="far fa-calendar-alt mr-2"></i>
                            <span></span>
                            <i class="fas fa-chevron-down ml-2"></i>
                        </div>
                    </div>
                </div>
                <!-- Schedule Widget -->
                <div class="card booking-schedule schedule-widget">

                    <!-- Schedule Header -->
                    <div class="schedule-header">
                        <div class="row">
                            <div class="col-md-12">

                                <!-- Day Slot -->
                                <div class="day-slot">
                                    <ul>
                                        <li class="left-arrow">
                                            <a href="<?php echo '?prev=' . $prev . '&slot=' . $slot_select;?>">
                                                <i class="fa fa-chevron-left"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <span>Mon</span>
                                            <span class="slot-date"><?php echo $start_date;?></span>
                                        </li>
                                        <li>
                                            <span>Tue</span>
                                            <span class="slot-date"><?php echo date('d M Y', strtotime($start_date . ' + 1 days'));?></span>
                                        </li>
                                        <li>
                                            <span>Wed</span>
                                            <span class="slot-date"><?php echo date('d M Y', strtotime($start_date . ' + 2 days'));?></span>
                                        </li>
                                        <li>
                                            <span>Thu</span>
                                            <span class="slot-date"><?php echo date('d M Y', strtotime($start_date . ' + 3 days'));?></span>
                                        </li>
                                        <li>
                                            <span>Fri</span>
                                            <span class="slot-date"><?php echo date('d M Y', strtotime($start_date . ' + 4 days'));?></span>
                                        </li>
                                        <li>
                                            <span>Sat</span>
                                            <span class="slot-date"><?php echo date('d M Y', strtotime($start_date . ' + 5 days'));?></span>
                                        </li>
                                        <li>
                                            <span>Sun</span>
                                            <span class="slot-date"><?php echo date('d M Y', strtotime($start_date . ' + 6 days'));?></span>
                                        </li>
                                        <li class="right-arrow">
                                            <a href="<?php echo '?next=' . $next . '&slot=' . $slot_select;?>">
                                                <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /Day Slot -->

                            </div>
                        </div>
                    </div>
                    <!-- /Schedule Header -->

                    <!-- Schedule Content -->
                    <div class="schedule-cont">
                        <div class="row">
                            <div class="col-md-12">

                                <!-- Time Slot -->
                                <div class="time-slot">
                                    <ul class="clearfix">
                                        <li>
                                            <?php if (!empty($slotsMonday)) {
                                                foreach ($slotsMonday as $slot) {
                                                    $slot_active = $slot_select == $slot['id'] ? 'selected' : '';
                                                    if (!empty($slot_active)) {
                                                        $book_date = date('d M Y');
                                                    }
                                                    $day = \clinela\utils\Utils::getDayOfWeek($slot['week_day']);
                                                    echo '<a class="timing ' . $slot_active . '" href="?slot=' . $slot['id'] . $dir_text . '">
                                                <span>' . date("h:i A", strtotime($slot['start_time'])) . '</span> - <span> ' . date("h:i A", strtotime($slot['end_time'])) . '</span>
                                                </a>';
                                                }
                                            }?>

                                        </li>
                                        <li>
                                            <?php if (!empty($slotsTuesday)) {
                                                foreach ($slotsTuesday as $slot) {
                                                    $slot_active = $slot_select == $slot['id'] ? 'selected' : '';
                                                    if (!empty($slot_active)) {
                                                        $book_date = date('d M Y', strtotime($start_date . ' + 1 days'));
                                                    }
                                                    $day = \clinela\utils\Utils::getDayOfWeek($slot['week_day']);
                                                    echo '<a class="timing ' . $slot_active . '" href="?slot=' . $slot['id'] . $dir_text . '">
                                                <span>' . date("h:i A", strtotime($slot['start_time'])) . '</span> - <span> ' . date("h:i A", strtotime($slot['end_time'])) . '</span>
                                                </a>';
                                                }
                                            }?>
                                        </li>
                                        <li>
                                            <?php if (!empty($slotsWednesday)) {
                                                foreach ($slotsWednesday as $slot) {
                                                    $slot_active = $slot_select == $slot['id'] ? 'selected' : '';
                                                    if (!empty($slot_active)) {
                                                        $book_date = date('d M Y', strtotime($start_date . ' + 2 days'));
                                                    }
                                                    $day = \clinela\utils\Utils::getDayOfWeek($slot['week_day']);
                                                    echo '<a class="timing ' . $slot_active . '" href="?slot=' . $slot['id'] . $dir_text . '">
                                                <span>' . date("h:i A", strtotime($slot['start_time'])) . '</span> - <span> ' . date("h:i A", strtotime($slot['end_time'])) . '</span>
                                                </a>';
                                                }
                                            }?>
                                        </li>
                                        <li>
                                            <?php if (!empty($slotsThursday)) {
                                                foreach ($slotsThursday as $slot) {
                                                    $slot_active = $slot_select == $slot['id'] ? 'selected' : '';
                                                    if (!empty($slot_active)) {
                                                        $book_date = date('d M Y', strtotime($start_date . ' + 3 days'));
                                                    }
                                                    $day = \clinela\utils\Utils::getDayOfWeek($slot['week_day']);
                                                    echo '<a class="timing ' . $slot_active . '" href="?slot=' . $slot['id'] . $dir_text . '">
                                                <span>' . date("h:i A", strtotime($slot['start_time'])) . '</span> - <span> ' . date("h:i A", strtotime($slot['end_time'])) . '</span>
                                                </a>';
                                                }
                                            }?>
                                        </li>
                                        <li>
                                            <?php if (!empty($slotsFriday)) {
                                                foreach ($slotsFriday as $slot) {
                                                    $slot_active = $slot_select == $slot['id'] ? 'selected' : '';
                                                    if (!empty($slot_active)) {
                                                        $book_date = date('d M Y', strtotime($start_date . ' + 4 days'));
                                                    }
                                                    $day = \clinela\utils\Utils::getDayOfWeek($slot['week_day']);
                                                    echo '<a class="timing ' . $slot_active . '" href="?slot=' . $slot['id'] . $dir_text . '">
                                                <span>' . date("h:i A", strtotime($slot['start_time'])) . '</span> - <span> ' . date("h:i A", strtotime($slot['end_time'])) . '</span>
                                                </a>';
                                                }
                                            }?>
                                        </li>
                                        <li>
                                            <?php if (!empty($slotsSaturday)) {
                                                foreach ($slotsSaturday as $slot) {
                                                    $slot_active = $slot_select == $slot['id'] ? 'selected' : '';
                                                    if (!empty($slot_active)) {
                                                        $book_date = date('d M Y', strtotime($start_date . ' + 5 days'));
                                                    }
                                                    $day = \clinela\utils\Utils::getDayOfWeek($slot['week_day']);
                                                    echo '<a class="timing ' . $slot_active . '" href="?slot=' . $slot['id'] . $dir_text . '">
                                                <span>' . date("h:i A", strtotime($slot['start_time'])) . '</span> - <span> ' . date("h:i A", strtotime($slot['end_time'])) . '</span>
                                                </a>';
                                                }
                                            }?>
                                        </li>
                                        <li>
                                            <?php if (!empty($slotsSunday)) {
                                                foreach ($slotsSunday as $slot) {
                                                    $slot_active = $slot_select == $slot['id'] ? 'selected' : '';
                                                    if (!empty($slot_active)) {
                                                        $book_date = date('d M Y', strtotime($start_date . ' + 6 days'));
                                                    }
                                                    $day = \clinela\utils\Utils::getDayOfWeek($slot['week_day']);
                                                    echo '<a class="timing ' . $slot_active . '" href="?slot=' . $slot['id'] . $dir_text . '">
                                                <span>' . date("h:i A", strtotime($slot['start_time'])) . '</span> - <span> ' . date("h:i A", strtotime($slot['end_time'])) . '</span>
                                                </a>';
                                                }
                                            }?>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /Time Slot -->

                            </div>
                        </div>
                    </div>
                    <!-- /Schedule Content -->

                </div>
                <!-- /Schedule Widget -->
                <div class="col-md-6">

                </div>


            </div>
        </div>
        <?php }?>
        <div class="col-lg-12 text-right mt-2">
            <form action="<?php echo BASE_PATH . 'checkout' . '/' . $id . '/';?>">
                <input hidden name="book_date" id="book_date" value="<?php echo $book_date?>">
                <input hidden name="end_date" id="end_date" value="<?php echo $book_date?>">
                <input hidden name="slot_id" id="slot_id" value="<?php echo $slot_select?>">
                <input hidden name="service_id" id="service_id" value="<?php echo $sv?>">
                <!-- Submit Section -->
                <div class="submit-section proceed-btn text-right">
                    <button style="display: none;" id="btn-pay" name="btn-pay" class="btn btn-primary submit-btn"
                            type="submit">Proceed to Pay
                    </button>
                </div>
                <!-- /Submit Section -->
            </form>
        </div>

    </div>
</div>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {

            editable: true,
            selectable: true,
            businessHours: true,
            dayMaxEvents: true, // allow "more" link when too many events
            events: <?php echo json_encode($events);?>,
            initialView: (function () {
                if ($(window).width() <= 768) {
                    return initialView = 'listMonth';
                } else {
                    return initialView = '';
                }
            })(),
            eventClick: function (info) {
                //alert('Event: ' + info.event.start.toUTCString());
                //alert(info.event.end);
                //console.log(info.event);

                document.getElementById('slot_id').value = info.event.id;
                document.getElementById('book_date').value = info.event.start.toLocaleString();
                document.getElementById('end_date').value = info.event.end.toLocaleString();
                if (document.getElementById('service_id').value) {
                    $('#btn-pay').show();
                }
            }
        });

        calendar.render();
    });


</script>