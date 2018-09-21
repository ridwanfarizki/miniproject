<?php include ('v_scripttop.php'); ?>
<script src="<?php echo base_url('assets/bootstrap//js/bootstrap.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
    <body>
        <div class="container-fluid">
            <div class="topnav">
                <a href="<?php echo site_url(); ?>">Home</a>
                <a class="active" href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
                <a href="<?php echo site_url('welcome/kota'); ?>">Daftar Kota</a>
            </div>
            <div class="row" style="padding-top:10px;">
                <div class="col-md-12">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kota</th>
                                <th>User Agent</th>
                                <th>Deskripsi</th>
                                <th>Created date</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Nama Kota</th>
                                <th>User Agent</th>
                                <th>Deskripsi</th>
                                <th>Detail</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
             <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <table class="table table-striped detail table-responsive" style="width:100%"></table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    $(document).ready(function() {
        table = $('#example').DataTable({ 

        "processing": true, 
        "serverSide": true, 
        "order": [], 
        
        "ajax": {
            "url": "<?php echo base_url('welcome/get_dashboard')?>",
            "type": "POST"
        },
        "columnDefs": [
        { 
            "width": "5%", "targets": 0,
            "orderable": true, 
        },
         { 
            "width": "10%", "targets": 1,
            "orderable": true, 
        },
        { 
            "width": "20%", "targets": 2,
            "orderable": true, 
        },
        { 
            "width": "50%", "targets": 3,
            "orderable": true, 
        },
        { 
            "width": "10%", "targets": 4,
            "orderable": true, 
        },
        ],
    } );
    });

    function reload_table()
    {
        table.ajax.reload(null,false); 
    }

    function detail(det)
    { 
        data_detail = det.split("|");
        $.ajax({
            url : "<?php echo base_url('welcome/detail_log/')?>/" + data_detail[0],
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                content ='<tr>'
                content +='    <th>weather state abbr</th>'
                content +='    <th>wind direction compass</th>'
                content +='    <th>created</th>'
                content +='    <th>weather state name</th>'
                content +='    <th>min temp</th>'
                content +='    <th>max temp</th>'
                content +='    <th>the temp</th>'
                content +='    <th>wind speed</th>'
                content +='    <th>wind direction</th>'
                content +='    <th>air pressure</th>'
                content +='    <th>humidity</th>'
                content +='    <th>visibility</th>'
                content +='    <th>predictability</th>'
                content +='</tr>';
                data.forEach(function(v,i){
                    content +='<tr>'
                    content +='    <th><img src="https://www.metaweather.com/static/img/weather/'+v.weather_state_abbr+'.svg" class="img-fluid"/></th>'
                    content +='    <th>'+v.wind_direction_compass+'</th>'
                    content +='    <th>'+v.created+'</th>'
                    content +='    <th>'+v.weather_state_name+'</th>'
                    content +='    <th>'+v.min_temp+'</th>'
                    content +='    <th>'+v.max_temp+'</th>'
                    content +='    <th>'+v.the_temp+'</th>'
                    content +='    <th>'+v.wind_speed+'</th>'
                    content +='    <th>'+v.wind_direction+'</th>'
                    content +='    <th>'+v.air_pressure+'</th>'
                    content +='    <th>'+v.humidity+'</th>'
                    content +='    <th>'+v.visibility+'</th>'
                    content +='    <th>'+v.predictability+'</th>'
                    content +='</tr>';
                });
                $('#modal_form').modal('show'); 
                $('.modal-title').text('Detail Data Search Kota '+data_detail[2]+' pada tanggal '+ moment(data_detail[1]).format('DD MM YYYY HH:mm:ss'));
                $('.detail').html(content); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }
    
</script>