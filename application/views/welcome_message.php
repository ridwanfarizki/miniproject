<?php include ('v_scripttop.php'); ?>

<body style="background:url(<?php echo base_url('assets/image/background.jpg'); ?>) no-repeat center center fixed; background-size: cover">
	<div class="container-fluid">
		<div class="topnav">
		    <a class="active" href="<?php echo site_url(); ?>">Home</a>
			<a href="<?php echo site_url('welcome/dashboard'); ?>">Dashboard</a>
			<a href="<?php echo site_url('welcome/reverse'); ?>">Reverse Geocoding</a>
			<div class="search-container">
			    <input type="text" placeholder="Search.." name="search" autocomplete="off">
			   	<button type="submit"><i class="fa fa-search"></i></button>
			   	<div id="result-list" class="autocomplete-items">
			       	
			    </div>
			</div>
		</div>
		<div class="row content">
			
		</div>
	</div>
</body>
<script type="text/javascript">
	$(document).ready(function() {
		var kode= 1047378;
		get_weather(kode);
	})
	function search(target){
		$.ajax({
			url : "<?php echo base_url('welcome/find'); ?>/"+target,
			type: "POST",
			dataType: "JSON",
			success : function(data){
				console.log(data);
				content_find ='';
					data.forEach(function(v,i){
						content_find +='<div class="list-kota" data-kode_kota="'+v.kode_woeid+'" data-name="'+v.name+'"><strong>'+v.name+'</strong></div>';
					})
				$('#result-list').html(content_find);
				$('.list-kota').on('click',function(){
					var kode = $(this).attr('data-kode_kota');
					var name = $(this).attr('data-name');
					get_weather(kode);
					$('input[name="search"]').val(name);
					$('#result-list').empty();
				})
			},
			error : function(jqXHR, textStatus, errorThrown){
				content_find ='<div><strong>Data Tidak Tersedia</strong></div>';
				$('#result-list').html(content_find);
			}
		})
	}

	$('input[name="search"]').on('keyup',function(){
		var target =$('input[name="search"]').val();
		if(target !== ''){
			search(target);	
		}else{
			$('#result-list').empty();
		}
	})


function get_weather(kode){
	$.ajax({
		crossOrigin: true,
        url : "https://www.metaweather.com/api/location/"+kode+"/",
        type: "get",
        crossDomain : true,
        dataType: 'json',
        success : function(data,status,xhr) {
        	obj= JSON.parse(data);
          	recs = obj.consolidated_weather;
          	var content ='';
          	var DateNow = moment().format('YYYY-MM-DD');
          	recs.forEach(function(v,i){
          		if(i == 0){
          			content +='<div class="col-md-12 col-sm-6 text-center hide-content">';
          			content +='<div class="row">';
					content +='<h1 class="col-md-12 text-center">Today</h1>';
					content +='<div class="col-md-5 text-right" style="margin-top:30px;"><p style="font-size:100px">'+Math.round(v.the_temp)+'&deg;</p><h1><span class="text-danger">'+Math.round(v.max_temp)+'&deg;</span>/<span class="text-info">'+Math.round(v.min_temp)+'&deg;</span></h1></div><div class="col-md-2"><img src="https://www.metaweather.com/static/img/weather/'+v.weather_state_abbr+'.svg" class="img-fluid"/></div><div class="col-md-4 text-left"><div style="background: rgba(151,224,170,0.5); width:100%; border-radius:20px;padding:10px;"><h1>'+obj.title+',<span style="font-size:20px;">'+obj.parent.title+'</span></h1><p>Time : '+moment(obj.time).format('DD MMM YYYY HH:mm:ss')+'</p> <p>Sunrise : '+moment(obj.sun_rise).format('HH:mm:ss')+'</p><p>Sunset : '+moment(obj.sun_set).format('HH:mm:ss')+'</p></div></div>';
					content +='</div>';
					content +='<div class="col-md-6"></div>';
					content +='</div>';
					content +='<div class="col-md-12 text-center hide-content"><h1 style="font-size:65px" class="text-info">'+v.weather_state_name+'</h1></div>';
					content +='<div class="col-md-12 hide-content"><i style="font-size:25px;" class="fa fa-asterisk text-light"></i> <span style="font-size:25px;" class="text-info">Wind Speed: <span class="text-light">'+Math.floor(v.wind_speed)+'mph. </span><i style="font-size:25px;" class="fa fa-tint text-light"></i><span style="font-size:25px;" class="text-info"> Air Pressure<span class="text-light">: '+Math.round(v.air_pressure)+'mb</span></div>';
					content +='<div class="col-md-2 col-sm-6 col-6 hide-list" style="margin-top:10px;">';
					content +='<div class="col-12 text-center alert alert-primary"><h5>Today</h5></div>';
					content +='<div class="row alert alert-light" style="margin:0px;"><div class="col-md-6 col-sm-6 text-right"><img src="https://www.metaweather.com/static/img/weather/'+v.weather_state_abbr+'.svg" class="img-fluid"/ style="width:100%"></div>';
					content +='<div class="col-md-6 col-sm-6" style="margin-top: 15px;"><div class="col-md-6"><h4 class="text-danger">'+Math.round(v.max_temp)+'&deg;</h4></div><div class="col-md-6"><h4 class="text-info">'+Math.round(v.min_temp)+'&deg;</h4></div></div>';
					content +='<div class="col-md-12">'+v.weather_state_name+'</div></div>';
					content +='</div>';
          		}else{
          			content +='<div class="col-md-2 col-sm-6 col-6" style="margin-top:10px;">';
					content +='<div class="col-12 text-center alert alert-primary"><h5>'+moment(v.applicable_date).format('dddd')+'</h5></div>';
					content +='<div class="row alert alert-light" style="margin:0px;"><div class="col-md-6 col-sm-6 text-right"><img src="https://www.metaweather.com/static/img/weather/'+v.weather_state_abbr+'.svg" class="img-fluid"/></div>';
					content +='<div class="col-md-6 col-sm-6" style="margin-top: 15px;"><div class="col-md-6"><h4 class="text-danger">'+Math.round(v.max_temp)+'&deg;</h4></div><div class="col-md-6"><h4 class="text-info">'+Math.round(v.min_temp)+'&deg;</h4></div></div>';
					content +='<div class="col-md-12">'+v.weather_state_name+'</div></div>';
					content +='</div>';
          		}
          	});
          	$('.content').html(content);
          	save_search(obj);
        },
        error: function (status, xhr,data) {
            alert('Error get data from ajax');
        }
    });
}

function save_search(resultdata){
	var formData={};
    formData.consolidated_weather= JSON.stringify(resultdata.consolidated_weather);
    formData.parent= JSON.stringify(resultdata.parent);
    formData.title= resultdata.title;
   	formData.woied= resultdata.woied;
   	formData.woied= resultdata.latt_long;
   	formData.time= resultdata.latt_long;
   	formData.sun_rise= resultdata.latt_long;
   	formData.sun_set= resultdata.latt_long;
	$.ajax({
		url : "<?php echo base_url('welcome/save_search'); ?>",
		type : "post",
		dataType : "JSON",
		data : formData,
		success : function(data){
		},
		error : function(jqXHR, textStatus, errorThrown){
			alert('Error save data from ajax');
		}
	})
}
</script>
</html>
