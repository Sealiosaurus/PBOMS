<h1 class="">Welcome to <?php echo $_settings->info('name') ?>, <?php echo ucwords($_settings->userdata('firstname'))?>!</h1>
<hr>
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-red elevation-1"><i class="fas fa-truck-loading"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Sellers</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `seller` where `status` = 1")->num_rows;
                ?>
            </span>
            
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-orange elevation-1"><i class="fas fa-boxes"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Products</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `product` where `status` = 1")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-yellow elevation-1"><i class="fas fa-th-list"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Order Records</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `purchase_order_list`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-green elevation-1"><i class="fas fa-hands"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Received Order Records</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `receiving_list`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
</div>
<div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-exchange-alt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">BO Records</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `back_order_list`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-undo"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Return Records</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `return_list`")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
        <!-- /.info-box -->
    <?php if($_settings->userdata('type') == 1): ?>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-purple elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Users</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `users` where id != 1 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <?php endif; ?>
    
</div>

<div class="card card-outline card-red">
	<div class="card-header">
		<h1>Order List</h1>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="20%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Created</th>
                            <th>PO Code</th>
                            <th>Seller</th>
                            <th>Products</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $qry = $conn->query("SELECT p.*, s.name as seller FROM `purchase_order_list` p inner join seller s on p.seller_id = s.id order by p.`date_created` desc");
                        while($row = $qry->fetch_assoc()):
                            $row['items'] = $conn->query("SELECT count(item_id) as `items` FROM `po_items` where po_id = '{$row['id']}' ")->fetch_assoc()['items'];
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                                <td><?php echo $row['po_code'] ?></td>
                                <td><?php echo $row['seller'] ?></td>
                                <td class="text-right"><?php echo number_format($row['items']) ?></td>
                                <td class="text-center">
                                    <?php if($row['status'] == 0): ?>
                                        <span class="badge badge-primary rounded-pill">Pending</span>
                                    <?php elseif($row['status'] == 1): ?>
                                        <span class="badge badge-warning rounded-pill">Partially received</span>
                                        <?php elseif($row['status'] == 2): ?>
                                        <span class="badge badge-success rounded-pill">Received</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger rounded-pill">N/A</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
		</div>
		</div>
	</div>
</div>

<div class="card card-outline card-danger">
	<div class="card-header">
		<h1>Received Order List</h1>
        <!-- <div class="card-tools">
			<a href="<?php echo base_url ?>admin/?page=purchase_order/manage_po" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div> -->
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Received</th>
                            <th>PO Code</th>
                            <th>Products</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $qry = $conn->query("SELECT * FROM `receiving_list` order by `date_created` desc");
                        while($row = $qry->fetch_assoc()):
                            $row['items'] = explode(',',$row['stock_ids']);
                            if($row['from_order'] == 1){
                                $code = $conn->query("SELECT po_code from `purchase_order_list` where id='{$row['form_id']}' ")->fetch_assoc()['po_code'];
                            }
                            else{
                                $code = $conn->query("SELECT bo_code from `back_order_list` where id='{$row['form_id']}' ")->fetch_assoc()['bo_code'];
                            }
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                                <td><?php echo $code ?></td>
                                <td class="text-right"><?php echo number_format(count($row['items'])) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
		</div>
		</div>
	</div>
</div>

<div class="card card-outline card-red">
	<div class="card-header">
		<h1>Back Order List</h1>
        <!-- <div class="card-tools">
			<a href="<?php echo base_url ?>admin/?page=back_order/manage_bo" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div> -->
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-striped">
                    <colgroup>
                        <col width="5%">
                        <col width="15%">
                        <col width="20%">
                        <col width="20%">
                        <col width="10%">
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date Created</th>
                            <th>BO Code</th>
                            <th>Seller</th>
                            <th>Products</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $qry = $conn->query("SELECT p.*, s.name as seller FROM `back_order_list` p inner join seller s on p.seller_id = s.id order by p.`date_created` desc");
                        while($row = $qry->fetch_assoc()):
                            $row['items'] = $conn->query("SELECT count(item_id) as `items` FROM `bo_items` where bo_id = '{$row['id']}' ")->fetch_assoc()['items'];
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                                <td><?php echo $row['bo_code'] ?></td>
                                <td><?php echo $row['seller'] ?></td>
                                <td class="text-right"><?php echo number_format($row['items']) ?></td>
                                <td class="text-center">
                                    <?php if($row['status'] == 0): ?>
                                        <span class="badge badge-primary rounded-pill">Pending</span>
                                    <?php elseif($row['status'] == 1): ?>
                                        <span class="badge badge-warning rounded-pill">Partially received</span>
                                        <?php elseif($row['status'] == 2): ?>
                                        <span class="badge badge-success rounded-pill">Received</span>
                                    <?php else: ?>
                                        <span class="badge badge-danger rounded-pill">N/A</span>
                                    <?php endif; ?>
                                </td>
                                
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
		</div>
		</div>
	</div>
</div>

<div class="row">





</div>

<script>
	$(document).ready(function(){
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
</script>