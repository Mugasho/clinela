/*
Author       : Dreamguys
Template Name: Doccure - Bootstrap Template
Version      : 1.0
*/

(function($) {
    "use strict";
    let count=1;
    let xp=1;
    let aw=1;
    let mb=1;
    let rg=1;
	
	// Pricing Options Show
	
	$('#pricing_select input[name="rating_option"]').on('click', function() {
		if ($(this).val() == 'price_free') {
			$('#custom_price_cont').hide();
		}
		if ($(this).val() == 'custom_price') {
			$('#custom_price_cont').show();
		}
		else {
		}
	});
	
	// Education Add More
	
    $(".education-info").on('click','.trash', function () {
		$(this).closest('.education-cont').remove();
		let str=this.href;
		if(!str.endsWith('#')){
			window.location=str;
		}
		return false;
    });

    $(".add-education").on('click', function () {
		var educationcontent = '<div class="row form-row education-cont">' +
			'<div class="col-12 col-md-10 col-lg-11">' +
				'<div class="row form-row">' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>Degree</label>' +
							'<input type="text" class="form-control" name="education['+count+'][degree]" id="degree['+count+']">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>College/Institute</label>' +
							'<input type="text" class="form-control" name="education['+count+'][college]" id="college['+count+']">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>Year of Completion</label>' +
							'<input type="text" class="form-control" name="education['+count+'][completion]" id="completion['+count+']">' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
		'</div>';
		
        $(".education-info").append(educationcontent);
        count+= count++;
        return false;
    });
	
	// Experience Add More
	
    $(".experience-info").on('click','.trash', function () {
		$(this).closest('.experience-cont').remove();
		let str=this.href;
		if(!str.endsWith('#')){
			window.location=str;
		}
		return false;
    });

    $(".add-experience").on('click', function () {
		
		var experiencecontent = '<div class="row form-row experience-cont">' +
			'<div class="col-12 col-md-10 col-lg-11">' +
				'<div class="row form-row">' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>Hospital Name</label>' +
							'<input type="text" class="form-control" name="experience['+xp+'][hospital]" id="hospital['+xp+']">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>From</label>' +
							'<input type="text" class="form-control" name="experience['+xp+'][from]" id="from['+xp+']">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>To</label>' +
							'<input type="text" class="form-control" name="experience['+xp+'][to]" id="to['+xp+']">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-4">' +
						'<div class="form-group">' +
							'<label>Designation</label>' +
							'<input type="text" class="form-control" name="experience['+xp+'][designation]" id="designation['+xp+']">' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-1"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div>' +
		'</div>';
		
        $(".experience-info").append(experiencecontent);
		xp+= xp++;
        return false;
    });
	
	// Awards Add More
	
    $(".awards-info").on('click','.trash', function () {
		$(this).closest('.awards-cont').remove();
		let str=this.href;
		if(!str.endsWith('#')){
			window.location=str;
		}
		return false;
    });

    $(".add-award").on('click', function () {

        var regcontent = '<div class="row form-row awards-cont">' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Awards</label>' +
					'<input type="text" class="form-control" name="awards['+aw+'][award]" id="awards['+aw+']">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Year</label>' +
					'<input type="text" class="form-control" name="awards['+aw+'][award_date]" id="award_date['+aw+']">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2">' +
				'<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
				'<a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
			'</div>' +
		'</div>';
		
        $(".awards-info").append(regcontent);
		aw+= aw++;
        return false;
    });


	// Services Add More

	$(".services-info").on('click','.trash', function () {
		$(this).closest('.awards-cont').remove();
		let str=this.href;
		if(!str.endsWith('#')){
			window.location=str;
		}
		return false;
	});

	$(".add-services").on('click', function () {

		var regcontent = '<div class="row form-row services-cont">' +
			'<div class="col-12 col-md-5">' +
			'<div class="form-group">' +
			'<label>Services</label>' +
			'<input type="text" class="form-control" name="services['+aw+'][services]" id="services['+aw+']">' +
			'</div>' +
			'</div>' +
			'<div class="col-12 col-md-5">' +
			'<div class="form-group">' +
			'<label>Amount</label>' +
			'<input type="number" class="form-control" name="services['+aw+'][amount]" id="amount['+aw+']">' +
			'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2">' +
			'<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
			'<a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
			'</div>' +
			'</div>';

		$(".services-info").append(regcontent);
		aw+= aw++;
		return false;
	});


	//add prescription
	$(".add-prescription").on('click', function () {
		var prescriptioncontent='<div class="row form-row prescription-cont">\n' +
			'                            <div class="col-12 col-md-10 col-lg-10">\n' +
			'                                <div class="row" id="prescription-row">\n' +
			'                                    <div class="col-lg-6">\n' +
			'                                        <div class="form-group">\n' +
			'                                            <label>Drug Name</label>\n' +
			'                                            <input class="form-control" name="prescriptions['+aw+'][drug_name]">\n' +
			'                                        </div>\n' +
			'                                    </div>\n' +
			'                                    <div class="col-lg-3">\n' +
			'                                        <div class="form-group">\n' +
			'                                            <label>Frequency</label>\n' +
			'                                            <input class="form-control" name="prescriptions['+aw+'][frequency]">\n' +
			'                                        </div>\n' +
			'                                    </div>\n' +
			'                                    <div class="col-lg-3">\n' +
			'                                        <div class="form-group">\n' +
			'                                            <label>Period</label>\n' +
			'                                            <input class="form-control" name="prescriptions['+aw+'][days]" type="text">\n' +
			'                                        </div>\n' +
			'                                    </div>\n' +
			'                                    <div class="col-lg-6">\n' +
			'                                        <div class="form-group">\n' +
			'                                            <label>Total</label>\n' +
			'                                            <input class="form-control" name="prescriptions['+aw+'][total]" type="text">\n' +
			'                                        </div>\n' +
			'                                    </div>\n' +
			'                                    <div class="col-lg-6">\n' +
			'                                        <div class="form-group">\n' +
			'                                            <label>Advice</label>\n' +
			'                                            <input class="form-control" name="prescriptions['+aw+'][advice]" type="text">\n' +
			'                                        </div>\n' +
			'                                    </div>\n' +
			'                                </div>\n' +
			'                            </div>\n' +
			'                            <div class="col-12 col-md-2">\n' +
			'                                <label class="d-md-block d-sm-none d-none">&nbsp;</label>\n' +
			'                                <a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>\n' +
			'                            </div>\n' +
			'                        </div><hr>';
		$(".prescription-info").append(prescriptioncontent);
		aw+= aw++;
		return false;
	});

	$(".prescription-info").on('click','.trash', function () {
		$(this).closest('.prescription-cont').remove();
		let str=this.href;
		if(!str.endsWith('#')){
			window.location=str;
		}
		return false;
	});

	// Membership Add More
	
    $(".membership-info").on('click','.trash', function () {
		$(this).closest('.membership-cont').remove();
		let str=this.href;
		if(!str.endsWith('#')){
			window.location=str;
		}
		return false;
    });

    $(".add-membership").on('click', function () {

        var membershipcontent = '<div class="row form-row membership-cont">' +
			'<div class="col-12 col-md-10 col-lg-5">' +
				'<div class="form-group">' +
					'<label>Memberships</label>' +
					'<input type="text" class="form-control" name="memberships['+mb+'][membership]" id="membership['+mb+']">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-2">' +
				'<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
				'<a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
			'</div>' +
		'</div>';
		
        $(".membership-info").append(membershipcontent);
		mb+= mb++;
        return false;
    });
	
	// Registration Add More
	
    $(".registrations-info").on('click','.trash', function () {
		$(this).closest('.reg-cont').remove();
		let str=this.href;
		if(!str.endsWith('#')){
			window.location=str;
		}
		return false;
    });

    $(".add-reg").on('click', function () {

        var regcontent = '<div class="row form-row reg-cont">' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Registrations</label>' +
					'<input type="text" class="form-control" name="registrations['+rg+'][registration]" id="registration['+rg+']">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-5">' +
				'<div class="form-group">' +
					'<label>Year</label>' +
					'<input type="text" class="form-control" name="registrations['+rg+'][reg_date]" id="reg_date['+rg+']">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2">' +
				'<label class="d-md-block d-sm-none d-none">&nbsp;</label>' +
				'<a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a>' +
			'</div>' +
		'</div>';
		
        $(".registrations-info").append(regcontent);
		rg+= rg++;
        return false;
    });
	
})(jQuery);