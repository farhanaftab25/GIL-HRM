// Sales barcode reading
function getProduct(self) {
	const barcode = $(self).val();
	if (barcode) {
		$.ajax({
			type: 'GET',
			url: '/admin/products/partials/' + barcode,
			success: function(data) {
				let lookUp = [ 'name', 'sales_price', 'in_stock' ];
				let tr = $(self).closest('tr');

				for (const key in data) {
					if (data.hasOwnProperty(key) && lookUp.includes(key)) {
						const value = data[key];
						let input = tr.find('.' + key);
						input.prop('value', value);
					}
				}
			},
			error: function() {
				Swal.fire({
					title: 'Sorry!',
					text: 'Product not found',
					icon: 'error',
					confirmButtonText: 'ok'
				});
			}
		});
	}
	return false;
}

// Calculate total
function calculate(dis = 0) {
	let subTotal = 0;
	let netTotal = 0;
	let discount = dis;
	$('.total').each(function() {
		subTotal = subTotal + $(this).html() * 1;
	});
	console.log(subTotal);
	netTotal = subTotal;
	netTotal = netTotal - discount;
	$('#sub-total').prop('value', subTotal);
	$('#discount').prop('value', discount);
	$('#net-total').prop('value', netTotal);
}

$(document).ready(function() {
	let counter = 0;

	// Adding a new row of content
	$('#addRow').on('click', function() {
		let newRow = $('<tr>');
		let cols = '';
		cols +=
			'<td><input type="text" class="form-control barcode" name="product_barcode[]" onkeyup="if (event.keyCode == 13) getProduct(this) "/></td>';
		cols += '<td><input readonly type="text" class="form-control name" name="name[]"/></td>';
		cols += '<td><input readonly type="text" class="form-control sales_price" name="sales_price[]"/></td>';
		cols += '<input readonly type="hidden" class="form-control in_stock" name="in_stock[]"/>';
		cols +=
			'<td><input type="text" class="form-control qty" name="quantity[]" onkeyup="if (event.keyCode == 13) $(\'#addRow\').click()"/></td>';
		cols += '<td class="pt-3">Rs.<span class="total">0</span></td>';
		// cols +=
		// 	'<td><input type="text" class="form-control barcode" name="product_barcode' +
		// 	counter +
		// 	'" onkeyup="if (event.keyCode == 13) getProduct(this) "/></td>';
		// cols += '<td><input readonly type="text" class="form-control name" name="name' + counter + '"/></td>';
		// cols +=
		// 	'<td><input readonly type="text" class="form-control sales_price" name="sales_price' + counter + '"/></td>';
		// cols += '<input readonly type="hidden" class="form-control in_stock" name="in_stock' + counter + '"/>';
		// cols +=
		// 	'<td><input type="text" class="form-control qty" name="quantity' +
		// 	counter +
		// 	'" onkeyup="if (event.keyCode == 13) $(\'#addRow\').click()"/></td>';
		// cols += '<td class="pt-3">Rs.<span class="total">0</span></td>';

		newRow.append(cols);
		$('table.order-list').append(newRow);
		$('#invoice-item').children().last().find('.barcode').focus();
		counter++;
	});

	// Deleting a row
	$(document).keyup(function(event) {
		if (event.keyCode === 46) {
			$('#removeRow').click();
		}
	});

	$('#removeRow').click(function() {
		if ($('#invoice-item').children().length > 1) {
			$('#invoice-item').children().last().remove();
			counter -= 1;
			return false;
		}
	});

	$('#invoice-item').on('change paste keyup', '.qty', function(event) {
		const qty = $(this).val();
		const tr = $(this).closest('tr');
		if (isNaN(qty)) {
			swal('Please Enter a valid Quantity');
			$(this).val(1);
		} else {
			if (qty - 0 > tr.find('.in_stock').val() - 0) {
				Swal.fire({
					title: 'Sorry!',
					text: 'This much of quantity is not available',
					icon: 'error',
					confirmButtonText: 'ok'
				});
				$(this).val(0);
				tr.find('.total').val('');
			} else {
				tr.find('.total').html(qty * tr.find('.sales_price').val());
				calculate();
			}
		}
	});

	// Discount
	$('#discount').on('change paste keyup', function() {
		let discount = parseInt($(this).val()) || '';
		calculate(discount);
	});
});
