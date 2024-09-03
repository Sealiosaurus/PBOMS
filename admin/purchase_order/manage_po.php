<?php 
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT p.*,s.name as seller FROM purchase_order_list p inner join seller s on p.seller_id = s.id  where p.id = '{$_GET['id']}'");
    if($qry->num_rows >0){
        foreach($qry->fetch_array() as $k => $v){
            $$k = $v;
        }
    }
}
?>
<style>
    select[readonly].select2-hidden-accessible + .select2-container {
        pointer-events: none;
        touch-action: none;
        background: #eee;
        box-shadow: none;
    }

    select[readonly].select2-hidden-accessible + .select2-container .select2-selection {
        background: #eee;
        box-shadow: none;
    }
</style>
<div class="card card-outline card-danger">
    <div class="card-header">
        <h1><?php echo isset($id) ? "Purchase Order Details - ".$po_code : 'Create New Purchase Order' ?></h1>
    </div>
    <div class="card-body">
        <form action="" id="po-form">
            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label text-info">OR Code</label>
                        <input type="text" class="form-control form-control-sm rounded-0" value="<?php echo isset($po_code) ? $po_code : '' ?>" readonly>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="seller_id" class="control-label text-info">Seller</label>
                            <select name="seller_id" id="seller_id" class="custom-select select2">
                            <option <?php echo !isset($seller_id) ? 'selected' : '' ?> disabled></option>
                            <?php 
                            $seller = $conn->query("SELECT * FROM `seller` where status = 1 order by `name` asc");
                            while($row=$seller->fetch_assoc()):
                            ?>
                            <option value="<?php echo $row['id'] ?>" <?php echo isset($seller_id) && $seller_id == $row['id'] ? "selected" : "" ?> ><?php echo $row['name'] ?></option>
                            <?php endwhile; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <fieldset>
                    <legend class="text-info">Product Form</legend>
                    <div class="row justify-content-center align-items-end">
                            <?php 
                                $item_arr = array();
                                $cost_arr = array();
                                $item = $conn->query("SELECT * FROM `product` where status = 1 order by `name` asc");
                                while($row=$item->fetch_assoc()):
                                    $item_arr[$row['seller_id']][$row['id']] = $row;
                                    $cost_arr[$row['id']] = $row['cost'];
                                endwhile;
                            ?>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="item_id" class="control-label">Product</label>
                                <select  id="item_id" class="custom-select ">
                                    <option disabled selected></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="unit" class="control-label">Unit</label>
                                <input type="text" class="form-control rounded-0" id="unit">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="qty" class="control-label">Qty</label>
                                <input type="number" step="any" class="form-control rounded-0" id="qty">
                            </div>
                        </div>
                        <div class="col-md-2 text-center">
                            <div class="form-group">
                                <button type="button" class="btn btn-flat btn-sm btn-danger" id="add_to_list">Add to List</button>
                            </div>
                        </div>
                </fieldset>
                <hr>
                <table class="table table-striped table-bordered" id="list">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="10%">
                        <col width="25%">
                        <col width="25%">
                        <col width="25%">
                    </colgroup>
                    <thead>
                        <tr class="text-light bg-navy">
                            <th class="text-center py-1 px-2"></th>
                            <th class="text-center py-1 px-2">Qty</th>
                            <th class="text-center py-1 px-2">Unit</th>
                            <th class="text-center py-1 px-2">Product</th>
                            <th class="text-center py-1 px-2">Cost (₱)</th>
                            <th class="text-center py-1 px-2">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;
                        if(isset($id)):
                        $qry = $conn->query("SELECT p.*,i.name,i.description FROM `po_items` p inner join product i on p.item_id = i.id where p.po_id = '{$id}'");
                        while($row = $qry->fetch_assoc()):
                            $total += $row['total']
                        ?>
                        <tr>
                            <td class="py-1 px-2 text-center">
                                <button class="btn btn-outline-danger btn-sm rem_row" type="button"><i class="fa fa-times"></i></button>
                            </td>
                            <td class="py-1 px-2 text-center qty">
                                <span class="visible"><?php echo number_format($row['quantity']); ?></span>
                                <input type="hidden" name="item_id[]" value="<?php echo $row['item_id']; ?>">
                                <input type="hidden" name="unit[]" value="<?php echo $row['unit']; ?>">
                                <input type="hidden" name="qty[]" value="<?php echo $row['quantity']; ?>">
                                <input type="hidden" name="price[]" value="<?php echo $row['price']; ?>">
                                <input type="hidden" name="total[]" value="<?php echo $row['total']; ?>">
                            </td>
                            <td class="py-1 px-2 text-center unit">
                            <?php echo $row['unit']; ?>
                            </td>
                            <td class="py-1 px-2 item">
                            <?php echo $row['name']; ?> <br>
                            <?php echo $row['description']; ?>
                            </td>
                            <td class="py-1 px-2 text-right cost">
                            <?php echo number_format($row['price']); ?>
                            </td>
                            <td class="py-1 px-2 text-right total">
                            <?php echo number_format($row['total']); ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Subtotal</th>
                            <th class="text-right py-1 px-2 sub-total">0</th>
                        </tr>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Discount <input style="width:40px !important" name="discount_perc" class='' type="number" min="0" max="100" value="<?php echo isset($discount_perc) ? $discount_perc : 0 ?>">%
                                <input type="hidden" name="discount" value="<?php echo isset($discount) ? $discount : 0 ?>">
                            </th>
                            <th class="text-right py-1 px-2 discount"><?php echo isset($discount) ? number_format($discount) : 0 ?></th>
                        </tr>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Tax <input style="width:40px !important" name="tax_perc" class='' type="number" min="0" max="100" value="<?php echo isset($tax_perc) ? $tax_perc : 0 ?>">%
                                <input type="hidden" name="tax" value="<?php echo isset($discount) ? $discount : 0 ?>">
                            </th>
                            <th class="text-right py-1 px-2 tax"><?php echo isset($tax) ? number_format($tax) : 0 ?></th>
                        </tr>
                        <tr>
                            <th class="text-right py-1 px-2" colspan="5">Total
                                <input type="hidden" name="amount" value="<?php echo isset($discount) ? $discount : 0 ?>">
                            </th>
                            <th class="text-right py-1 px-2 grand-total">0</th>
                        </tr>
                    </tfoot>
                </table>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="remarks" class="text-info control-label">Remarks</label>
                            <textarea name="remarks" id="remarks" rows="3" class="form-control rounded-0"><?php echo isset($remarks) ? $remarks : '' ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer py-1 text-center">
        <button class="btn btn-flat btn-danger" type="submit" form="po-form">Save</button>
        <a class="btn btn-flat btn-dark" href="<?php echo base_url.'/admin?page=purchase_order' ?>">Cancel</a>
    </div>
</div>
<table id="clone_list" class="d-none">
    <tr>
        <td class="py-1 px-2 text-center">
            <button class="btn btn-outline-danger btn-sm rem_row" type="button"><i class="fa fa-times"></i></button>
        </td>
        <td class="py-1 px-2 text-center qty">
            <span class="visible"></span>
            <input type="hidden" name="item_id[]">
            <input type="hidden" name="unit[]">
            <input type="hidden" name="qty[]">
            <input type="hidden" name="price[]">
            <input type="hidden" name="total[]">
        </td>
        <td class="py-1 px-2 text-center unit">
        </td>
        <td class="py-1 px-2 item">
        </td>
        <td class="py-1 px-2 text-right cost">
        </td>
        <td class="py-1 px-2 text-right total">
        </td>
    </tr>
</table>
<script>
    var items = $.parseJSON('<?php echo json_encode($item_arr) ?>')
    var costs = $.parseJSON('<?php echo json_encode($cost_arr) ?>')
    
    $(function(){
        $('.select2').select2({
            placeholder:"Please select here",
            width:'resolve',
        })
        $('#item_id').select2({
            placeholder:"Please select seller first",
            width:'resolve',
        })

        $('#seller_id').change(function(){
            var seller_id = $(this).val()
            $('#item_id').select2('destroy')
            if(!!items[seller_id]){
                $('#item_id').html('')
                var list_item = new Promise(resolve=>{
                    Object.keys(items[seller_id]).map(function(k){
                        var row = items[seller_id][k]
                        var opt = $('<option>')
                            opt.attr('value',row.id)
                            opt.text(row.name)
                        $('#item_id').append(opt)
                    })
                    resolve()
                })
                list_item.then(function(){
                    $('#item_id').select2({
                        placeholder:"Please select item here",
                        width:'resolve',
                    })
                })
            }else{
                list_item.then(function(){
                    $('#item_id').select2({
                        placeholder:"No Items Listed yet",
                        width:'resolve',
                    })
                })
            }

        })

        $('#add_to_list').click(function(){
            var seller = $('#seller_id').val()
            var item = $('#item_id').val()
            var qty = $('#qty').val() > 0 ? $('#qty').val() : 0;
            var unit = $('#unit').val()
            var price = costs[item] || 0
            var total = parseFloat(qty) *parseFloat(price)
            // console.log(seller,item)
            var item_name = items[seller][item].name || 'N/A';
            var item_description = items[seller][item].description || 'N/A';
            var tr = $('#clone_list tr').clone()
            if(item == '' || qty == '' || unit == '' ){
                alert_toast('Form Item textfields are required.','warning');
                return false;
            }
            if($('table#list tbody').find('tr[data-id="'+item+'"]').length > 0){
                alert_toast('Item is already exists on the list.','error');
                return false;
            }
            tr.find('[name="item_id[]"]').val(item)
            tr.find('[name="unit[]"]').val(unit)
            tr.find('[name="qty[]"]').val(qty)
            tr.find('[name="price[]"]').val(price)
            tr.find('[name="total[]"]').val(total)
            tr.attr('data-id',item)
            tr.find('.qty .visible').text(qty)
            tr.find('.unit').text(unit)
            tr.find('.item').html(item_name+'<br/>'+item_description)
            tr.find('.cost').text(parseFloat(price).toLocaleString('en-US'))
            tr.find('.total').text(parseFloat(total).toLocaleString('en-US'))
            $('table#list tbody').append(tr)
            calc()
            $('#item_id').val('').trigger('change')
            $('#qty').val('')
            $('#unit').val('')
            tr.find('.rem_row').click(function(){
                rem($(this))
            })
            
            $('[name="discount_perc"],[name="tax_perc"]').on('input',function(){
                calc()
            })
            $('#seller_id').attr('readonly','readonly')
        })
        $('#po-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_po",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(resp.status == 'success'){
						location.replace(_base_url_+"admin/?page=purchase_order/view_po&id="+resp.id);
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
                    $('html,body').animate({scrollTop:0},'fast')
				}
			})
		})

        if('<?php echo isset($id) && $id > 0 ?>' == 1){
            calc()
            $('#seller_id').trigger('change')
            $('#seller_id').attr('readonly','readonly')
            $('table#list tbody tr .rem_row').click(function(){
                rem($(this))
            })
        }
    })
    function rem(_this){
        _this.closest('tr').remove()
        calc()
        if($('table#list tbody tr').length <= 0)
            $('#seller_id').removeAttr('readonly')

    }
    function calc(){
        var sub_total = 0;
        var grand_total = 0;
        var discount = 0;
        var tax = 0;
        $('table#list tbody input[name="total[]"]').each(function(){
            sub_total += parseFloat($(this).val())
            
        })
        $('table#list tfoot .sub-total').text(parseFloat(sub_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        var discount =   sub_total * (parseFloat($('[name="discount_perc"]').val()) /100)
        sub_total = sub_total - discount;
        var tax =   sub_total * (parseFloat($('[name="tax_perc"]').val()) /100)
        grand_total = sub_total + tax
        $('.discount').text(parseFloat(discount).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="discount"]').val(parseFloat(discount))
        $('.tax').text(parseFloat(tax).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="tax"]').val(parseFloat(tax))
        $('table#list tfoot .grand-total').text(parseFloat(grand_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigit:2}))
        $('[name="amount"]').val(parseFloat(grand_total))

    }
</script>