let counter = 1;

function calculate() {
	let subTotal = 0;
	let netTotal = 0;
	$('.total').each(function() {
		subTotal = subTotal + $(this).html() * 1;
	});
	// console.log(subTotal);
	netTotal = subTotal.toFixed(2);
	netTotal = parseFloat(netTotal).toFixed(2);
	// netTotal = netTotal.toFixed(2);
	$('#sub-total').prop('value', subTotal);
	$('#net-total').prop('value', netTotal);
}

// Purchase barcode reading
function getProduct(self) {
	const barcode = $(self).val();
	if (barcode) {
		$.ajax({
			type: 'GET',
			url: '/admin/products/partials/' + barcode,
			success: function(data) {
				let lookUp = [ 'name', 'sales_price', 'in_stock', 'purchase_price' ];
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

// Helpers
function get(self, data) {
	return {
		[data]: $(self).val(),
		tr: $(self).closest('tr')
	};
}

function total(price, qty, discountRate) {
	const totalPrice = price * qty;
	const discount = discountRate / 100 * totalPrice; // Flat value is coming
	const finalPrice = totalPrice - discount;
	return {
		totalPrice: finalPrice,
		flatDiscount: discount
	};
}

function convertToPercentage(price, flatDiscount, qty = 1) {
	const totalPrice = price * qty;
	const discountPercentage = flatDiscount / totalPrice * 100; // Flat value is coming
	const finalPrice = totalPrice - flatDiscount;
	return {
		totalPrice: finalPrice,
		percentage: discountPercentage
	};
}

function displayTotal(total, tr) {
	tr.find('.total').html(total.toFixed(2));
	calculate();
}
function displayItemPrice(tr, qty, totalPrice) {
	// Individaul Item price
	if (qty) {
		let itemPrice = totalPrice / Number(qty);
		tr.find('.price-with-tax').prop('value', itemPrice.toFixed(2));
	}
}

// Add a new row
function addNewRow() {
	let newRow = $('<tr>');
	let cols = '';

	cols = `<td> ${counter} </td>;
			<td>
				<input type="text" style="width: 140px;" class="form-control barcode" name="product_barcode[]" 
					onkeyup="if (event.keyCode == 13) getProduct(this) "/>
			</td>
			<td>
				<input readonly type="text" style="width: 140px;" class="form-control name" name="name[]"/>
			</td> 
			<td>
				<input type="number" style="width: 140px;" class="form-control qty" name="quantity[]"/>
			</td>
			<td>
				<input type="number" style="width: 140px;" class="form-control free-qty" name="free-quantity[]"/>
			</td> 
			<td>
				<div class="input-group mb-3 flex-nowrap">	
					<input type="number" style="width: 80px;" class="form-control discount" name="discount[]"/>
					<div class="input-group-append">
						<span class="input-group-text">%</span>
					</div>
				</div>
			</td>
			<td>
				<input type="number" style="width: 140px;" class="form-control flat-discount" name="flat-discount[]"/>
			</td>
			<td>
				<input type="number" style="width: 140px;" class="form-control purchase_price" name="purchase_price[]"/>
			</td>
			<td>
				<div class="input-group mb-3 flex-nowrap">
					<input type="number" style="width: 80px;" class="form-control tax" name="tax[]" aria-label=""/>
					<div class="input-group-append">
						<span class="input-group-text">%</span>
					</div>
				</div>
			</td>
			<td>
				<input type="number" style="width: 140px;" class="form-control flat-tax" name="flat-tax[]"/>
			</td>
			<td>
				<input readonly type="number" style="width: 140px;" class="form-control price-with-tax" name="product-price-tax[]">
			</td>
			<td>
				<input type="number" style="width: 140px;" class="form-control sales_price" name="sales_price[]" onkeyup="if (event.keyCode == 13) $('#add-purchase-row').click()">
			</td>
			<td>
				<input readonly type="number" style="width: 140px;" class="form-control profit" name="profit[]">
			</td> 
			<input readonly type="hidden" class="form-control in_stock" name="in_stock[]"/> 
			<td class="pt-3">Rs.<span class="total">0</span></td>`;

	newRow.append(cols);
	$('table.order-list').append(newRow);
	$('#purchase-invoice-item').children().last().find('.barcode').focus();
	counter++;
}

$(document).ready(function() {
	// Adding a new row of content
	addNewRow();

	// ONClick add a new row
	$('#add-purchase-row').on('click', function() {
		addNewRow();
	});

	// Deleting a row
	$(document).keyup(function(event) {
		if (event.keyCode === 46) {
			$('#remove-purchase-row').click();
		}
		if (event.keyCode === 113) {
			$('#create-product').get(0).click();
		}
	});

	$('#remove-purchase-row').click(function() {
		if ($('#purchase-invoice-item').children().length > 1) {
			$('#purchase-invoice-item').children().last().remove();
			$('#purchase-invoice-item').children().last().find('.sales_price').focus();
			counter -= 1;
			return false;
		}
	});

	/**********************
		Calculations
	***********/

	// Any change in the discount field
	$('#purchase-invoice-item').on('change paste keyup', '.discount', function(event) {
		const { discountRate, tr } = get(this, (data = 'discountRate'));

		if (isNaN(discountRate)) {
			alert('Please Enter a valid discount Rate');
			$(this).val(0);
		} else {
			const qty = tr.find('.qty').val();
			const price = tr.find('.purchase_price').val();
			const tax = tr.find('.tax').val() || 0;
			let { totalPrice, flatDiscount } = total(price, qty, discountRate);
			tr.find('.flat-discount').prop('value', flatDiscount.toFixed(2));

			const flatTax = tax / 100 * totalPrice;
			totalPrice = flatTax + totalPrice;

			// Individaul Item price
			if (qty) {
				let itemPrice = totalPrice / Number(qty);
				tr.find('.price-with-tax').prop('value', itemPrice.toFixed(2));
			}

			displayTotal(totalPrice, tr);
		}
	});

	// flat discount
	$('#purchase-invoice-item').on('change paste keyup', '.flat-discount', function(event) {
		const { flatDiscount, tr } = get(this, (data = 'flatDiscount'));

		if (isNaN(flatDiscount)) {
			alert('Please Enter a valid discount Rate');
			$(this).val(0);
		} else {
			const qty = tr.find('.qty').val();
			const price = tr.find('.purchase_price').val();
			const tax = tr.find('.tax').val() || 0;
			let { totalPrice, percentage } = convertToPercentage(price, flatDiscount, qty);

			tr.find('.discount').prop('value', percentage);

			const flatTax = tax / 100 * totalPrice;
			totalPrice = flatTax + totalPrice;

			displayItemPrice(tr, qty, totalPrice);

			displayTotal(totalPrice, tr);
		}
	});

	// Any change in the quantity
	$('#purchase-invoice-item').on('change paste keyup', '.qty', function(event) {
		const { qty, tr } = get(this, (data = 'qty'));

		if (isNaN(qty)) {
			alert('Please Enter a valid Quantity');
			$(this).val(0);
		} else {
			const tax = tr.find('.tax').val() || 0;
			const discountRate = tr.find('.discount').val() || 0;
			const price = tr.find('.purchase_price').val() || 0;

			let { totalPrice, flatDiscount } = total(price, qty, discountRate);

			const flatTax = tax / 100 * totalPrice;

			tr.find('.flat-discount').prop('value', flatDiscount.toFixed(2));

			tr.find('.flat-tax').prop('value', flatTax.toFixed(2));

			totalPrice = flatTax + totalPrice;

			// Individaul Item price
			if (qty) {
				let itemPrice = totalPrice / Number(qty);
				tr.find('.price-with-tax').prop('value', itemPrice.toFixed(2));
			}

			displayTotal(totalPrice, tr);
		}
	});

	// Any change in the purchase price
	$('#purchase-invoice-item').on('change paste keyup', '.purchase_price', function(event) {
		const { price, tr } = get(this, (data = 'price'));

		if (isNaN(price)) {
			alert('Please Enter a valid price');
			$(this).val(0);
		} else {
			const qty = tr.find('.qty').val();
			const discountRate = tr.find('.discount').val();
			const tax = tr.find('.tax').val() || 0;
			let { totalPrice, flatDiscount } = total(price, qty, discountRate);

			const flatTax = tax / 100 * totalPrice;

			tr.find('.flat-discount').prop('value', flatDiscount.toFixed(2));

			tr.find('.flat-tax').prop('value', flatTax.toFixed(2));

			totalPrice = flatTax + totalPrice;
			displayTotal(totalPrice, tr);
		}
	});

	//Any change in the purchase price
	$('#purchase-invoice-item').on('change paste keyup', '.tax', function(event) {
		const { tax, tr } = get(this, (data = 'tax'));
		if (isNaN(tax)) {
			alert('Please Enter a valid value');
			$(this).val(0);
		} else {
			const qty = tr.find('.qty').val();
			const discountRate = tr.find('.discount').val();
			const price = tr.find('.purchase_price').val();
			let { totalPrice, flatDiscount } = total(price, qty, discountRate);
			const flatTax = tax / 100 * totalPrice;
			tr.find('.flat-tax').prop('value', flatTax.toFixed(2));
			totalPrice = flatTax + totalPrice;
			displayTotal(totalPrice, tr);
		}
	});

	//Calculating falt tax value
	$('#purchase-invoice-item').on('change paste keyup', '.flat-tax', function(event) {
		const { flatTax, tr } = get(this, (data = 'flatTax'));
		if (isNaN(flatTax)) {
			alert('Please Enter a valid value');
			$(this).val(0);
		} else {
			const qty = tr.find('.qty').val();
			const discountRate = tr.find('.discount').val();
			const price = tr.find('.purchase_price').val();
			let { totalPrice, flatDiscount } = total(price, qty, discountRate);
			let { p, percentage } = convertToPercentage(totalPrice, flatTax);
			tr.find('.tax').prop('value', percentage);
			totalPrice = Number(flatTax) + totalPrice;
			tr.find('.price-with-tax').prop('value', totalPrice / qty);
			displayTotal(totalPrice, tr);
		}
	});

	$('#purchase-invoice-item').on('change paste keyup', '.sales_price', function(event) {
		const { salesPrice, tr } = get(this, (data = 'salesPrice'));
		if (isNaN(salesPrice)) {
			alert('Please Enter a valid value');
			$(this).val(0);
		} else {
			const price = tr.find('.price-with-tax').val();
			let profit = salesPrice - price;
			const profitMargin = profit / salesPrice * 100;
			tr.find('.profit').prop('value', profitMargin.toFixed(2));
		}
	});

	$('#total-discount').on('change paste keyup', function(event) {
		console.log('y');
	});
});
