function loadSubCategory() {
	const id = $('#category').val();
	$.ajax({
		type: 'GET',
		url: '/admin/products/partials/subcategories?id=' + id,
		success: function(data) {
			$('#subcategory').html(data);
			loadBrand();
		},
		error: function() {
			console.log('Error');
		}
	});
}

function loadBrand() {
	const id = $('#subcategory').val();
	$.ajax({
		type: 'GET',
		url: '/admin/products/partials/brands?id=' + id,
		success: function(data) {
			$('#brand').html(data);
		},
		error: function() {
			console.log('Error');
		}
	});
}
$(document).ready(function() {
	// Load category if Exists
	if ($('#category').length) {
		loadSubCategory();
	}

	$('#category').on('change', () => {
		loadSubCategory();
	});

	$('#subcategory').on('change', () => {
		loadBrand();
	});
});
