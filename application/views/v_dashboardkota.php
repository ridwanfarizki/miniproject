<?php include ('v_scripttop.php'); ?>
<script src="<?php echo base_url('assets/bootstrap//js/bootstrap.min.js'); ?>"></script>
    <body>
        <div class="container-fluid">
            <div class="topnav">
                <a href="<?php echo site_url(); ?>">Home</a>
                <a href="<?php echo site_url('welcome/dashboard'); ?>">Dashboard</a>
                <a class="active" href="<?php echo site_url('welcome/daftar_kota'); ?>">Daftar Kota</a>
            </div>
            <div style="margin-top:20px;">
                <div class="row">
                    <div class="col-md-12 text-right" style="margin-bottom: 20px;">
                        <button type="button" class="btn btn-primary" id="add">Tambah Kota</button>
                    </div>
                </div>
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Kode Woeid</th>
                            <th>Jumlah Pencarian</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Kode Woeid</th>
                            <th>Jumlah Pencarian</th>
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
            "url": "<?php echo base_url('welcome/dashboard_kota')?>",
            "type": "POST"
        },
        "columnDefs": [
        { 
            "width": "10%", "targets": 0,
            "orderable": true, 
        },
         { 
            "width": "40%", "targets": 1,
            "orderable": true, 
        },
        { 
            "width": "30%", "targets": 2,
            "orderable": true, 
        },
        ],
    } );
    });

    function reload_table()
    {
        table.ajax.reload(null,false); 
    }

    
</script>
