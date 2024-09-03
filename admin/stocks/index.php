<div class="card card-outline card-danger">
	<div class="card-header">
		<h1>Stock List</h1>
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
                        <col width="20%">
                        <col width="20%">
                        <col width="40%">
                        <col width="15%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Seller</th>
                            <th>Description</th>
                            <th>Available Stocks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $qry = $conn->query("SELECT i.*,s.name as seller FROM `product` i inner join seller s on i.seller_id = s.id order by `name` desc");
                        while($row = $qry->fetch_assoc()):
                            $in = $conn->query("SELECT SUM(quantity) as total FROM stock_list where item_id = '{$row['id']}' and type = 1")->fetch_array()['total'];
                            $out = $conn->query("SELECT SUM(quantity) as total FROM stock_list where item_id = '{$row['id']}' and type = 2")->fetch_array()['total'];
                            $row['available'] = $in - $out;
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['seller'] ?></td>
                                <td><?php echo $row['description'] ?></td>
                                <td class="text-right"><?php echo number_format($row['available']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure you want to delete this received order?","delete_receiving",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Receiving Details","receiving/view_receiving.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_receiving($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_receiving",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>