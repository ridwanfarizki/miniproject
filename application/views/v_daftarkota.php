<?php include ('v_scripttop.php'); ?>
<script src="<?php echo base_url('assets/bootstrap//js/bootstrap.min.js'); ?>"></script>
    <body>
        <div class="container-fluid">
            <div class="topnav">
                <a href="<?php echo site_url(); ?>">Home</a>
                <a class="active" href="<?php echo site_url('welcome/daftar_kota'); ?>">Daftar Kota</a>
            </div>
            <div style="margin-top:20px;">
                <div class="row">
                    <div class="col-md-6" style="margin-bottom: 20px;">
                        <h2>Data Master Kota</h2>
                    </div>
                    <div class="col-md-6 text-right" style="margin-bottom: 20px;">
                        <button type="button" class="btn btn-primary" id="add">Tambah Kota</button>
                    </div>
                </div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Kode Woeid</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Kode Woeid</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modal_form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <?php echo form_open('#','id="form" class="form-horizontal"'); ?>
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nama Kota</label>
                            <div class="col-md-9">
                                <input name="name" placeholder="Nama Kota" class="form-control" type="text">
                               
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Kode Kota</label>
                            <div class="col-md-9">
                                <input name="kode_woeid" placeholder="Kode Kota" class="form-control" type="number">
                                
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
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
            "url": "<?php echo base_url('welcome/list_kota')?>",
            "type": "POST"
        },
        "columnDefs": [
        { 
            "width": "50%", "targets": 0,
            "orderable": true, 
        },
        ],
    } );
    });

    $('#add').on('click',function(){
        save_method = 'add';
        $('#form')[0].reset(); 
        $('#modal_form').modal('show'); 
        $('.modal-title').text('Tambah Kota'); 
    })

    function edit_kota(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); 
        $.ajax({
            url : "<?php echo base_url('welcome/edit_kota/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('[name="id"]').val(data.id);
                $('[name="name"]').val(data.name);
                $('[name="kode_woeid"]').val(data.kode_woeid);
                $('#modal_form').modal('show'); 
                $('.modal-title').text('Edit Kota'); 
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });
    }

    function reload_table()
    {
        table.ajax.reload(null,false); 
    }

    $('#btnSave').on('click',function(){
        $('#btnSave').text('saving...'); 
        $('#btnSave').attr('disabled',true); 
        var url;

        if(save_method == 'add') {
            url = "<?php echo base_url('welcome/add_kota')?>";
        } else {
            url = "<?php echo base_url('welcome/update_kota')?>";
        }

        
        $.ajax({
            url : url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data)
            {
                if(data.status) 
                {
                    $('#modal_form').modal('hide');  
                    reload_table();
                }

                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false); 


            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data');
                $('#btnSave').text('save'); 
                $('#btnSave').attr('disabled',false);

            }
        });
    })

    function delete_kota(id)
    {
        if(confirm('Are you sure delete this data?'))
        {
            $.ajax({
                url : "<?php echo base_url('welcome/delete_kota')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {                
                    $('#modal_form').modal('hide');
                    reload_table();
                   
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }
</script>