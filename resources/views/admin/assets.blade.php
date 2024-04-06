@include('admin.layout')

<style>
    .form-group {
        margin-bottom: 50px; /* You can adjust the value as needed */
    }
    
    .formtype .col-md-3 {
        margin-bottom: 15px; /* Add margin if needed */
    }
</style>

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Assets</h4> <a href="add-asset.html" class="btn btn-primary float-right veiwbutton">Add Assests</a> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form>
                    <div class="row formtype">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Employee Name</label>
                                <select class="form-control" id="sel1" name="sellist1">
                                    <option>Select Name</option>
                                   
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>From</label>
                                <div class="box">
           
            <input type="date" class="input" name="to">
         </div>

     

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>To</label>
                                <div class="box">
           
         <div class="box">
          
            <input type="date" class="input" name="from">
         </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Search</label> <a href="#" class="btn btn-success btn-block mt-0 search_button"> Search </a> </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="datatable table table-stripped">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Purchased From</th>
                                        <th>Purchased Date</th>
                                        <th>Amount</th>
                                        <th>Paid By</th>
                                        <th>Status</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete_asset" class="modal fade delete-modal" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center"> <img src="assets/img/sent.png" alt="" width="50" height="46">
                        <h3 class="delete_class">Are you sure want to delete this Asset?</h3>
                        <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@include('admin.endlayout')