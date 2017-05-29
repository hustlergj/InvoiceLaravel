<!DOCTYPE html>
@extends('layouts.master')

@section('content')
<h1><b>New Invoice</b></h1><br>

<form method="post" action="<?= URL::to('create') ?>">

	{{ csrf_field() }}

	{{ method_field('PUT') }}

	<div class="field is-grouped">

	<label class="label">Invoice Name</label> &nbsp;
		<p class="control">
			<input class="input" type="text" name="inv_name" placeholder="Invoice Name">
		</p>

	</div>

	<table class="table is-striped">
		<thead>
			<tr>
				<th>Item Name</th>
				<th># of Items</th>
				<th>Price</th>
				<th>Total</th>
				<th>Action</th>
			</tr>
		</thead>  

		<tbody class="my_table" id="my_table">
			<tr class="my_row">
				<td><input type="text" id="name" name="name[]" class="input"></td>
				<td><input type="text" id="item" name="item[]" class="item input"></td>
				<td><input type="text" id="price" name="price[]" class="price input"></td>
				<td><input type="text" id="total" name="total[]" class="total input" readonly="true"></td>
				<td><input type="button" name="delete" class="input" value="Delete" onclick="deleteRow(this)"></td>
			</tr>
		</tbody>
	 </table>

	<button name="add" id="add" class="button is-primary" title="Add new item">+ Add Item</button>

	<div class="field" style="margin-left:1090px;">

		Sub Total <input  type="text" class="sub_total input" name="sub_total" id="sub_total" readonly="true"><br>

		Tax <input  type="text" class="tax input" name="tax" id="tax"><br>

	 	Total <input  type="text" class="tax_total input" name="tax_total" readonly="true">

	</div>

	<button name="create" id="create" class="button is-primary">Create</button>

	<a href={{URL::to('/')}} type="button" class="button is-primary">Back</a> 

</form> <br>

@include('layouts.errors')
	
<script type="text/javascript">
	jQuery(function(){
		var counter = 1;
		jQuery('#add').click(function(event){
			event.preventDefault();
			var newRow = jQuery('<tr class="my_row"><td><input type="text" id="name" class="input" name="name[]' +
					counter + '"/></td><td><input type="text" id="item" class="input" name="item[]' +
					counter + '"/></td><td><input type="text" id="price" class="input" name="price[]' +
					counter + '"/></td><td><input type="text" id="total" class="total input" readonly="true" name="total[]' +
					counter + '"/></td><td><input type="button" class="input" name="delete" value="Delete" onclick = "deleteRow(this)"' +
					counter + '"/></td></tr>');
					counter++;
			jQuery('.my_table').append(newRow);
		});
	});

	function deleteRow(btn) {
		var row = btn.parentNode.parentNode;
		row.parentNode.removeChild(row);
		subTotal();
	}

	function subTotal(){
		var sub_t = 0;
		$(".total").each(function(k, v){
			var subt= +$(this).val()-0;
			sub_t+=subt; 
		});
		$(".sub_total").val(sub_t);	
	}

	function tax(){
		$(document).ready(function(){
			$(".tax").on("change",function(){
				var a =parseInt($("#tax").val());
				var b =parseInt($("#sub_total").val());
				var sum = ((b/100)*a)+b;
				$(".tax_total").val(sum);
			});	
		});
	}
	
	$('body').delegate('#item,#price,#total','keyup',function(){

		var tr=$(this).parent().parent();
		var num=tr.find('#item').val();
		var price=tr.find('#price').val();
		amount=num*price;
		tr.find('#total').val(amount);
		subTotal();
	});
	$('body').delegate('#tax','keyup',function(){
		tax();
	});	
</script>
@endsection