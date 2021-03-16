function showAlert(text) {
	$("#alert").html(text);
	$("#alert").slideDown();
	setTimeout(function() {
		$("#alert").slideUp();
	}, 3000);
}

$(':radio').change(function() {
	console.log('New star rating: ' + this.value);
  });

$("#newIngredient").click(function() {
	const html = $("#ingredientTemplate").html();

	$("#recipeIngredients ul em").remove();
	$("#recipeIngredients ul").append(html);
});

$("#newInstruction").click(function() {
	const html = $("#instructionTemplate").html();

	$("#recipeInstructions ol em").remove();
	$("#recipeInstructions ol").append(html);
	
});

$(document).delegate(".delete", "click", function() {
	const list = $(this).parent().parent();
	if (list.children().length === 1) {
		$(list).append("<em class='initial-text'>Nothing</em>");
	}
	$(this).parent().remove();
});

$("#submit").click(function() {
	if (!$("#recipeTitle").val()) {
		showAlert("Please include a title.");
		return;
	}
	if (!$("#recipeTagline").val()) {
		showAlert("Please include a tagline.");
		return;
	}
	if ($("#recipeIngredients li").length === 0) {
		showAlert("Please include an ingredients list.");
		return;
	}
	if ($("#recipeInstructions li").length === 0) {
		showAlert("Please include an instructions list.");
		return;
	}

	var valid = true,
		fields = "";

	$("#recipeIngredients li input:nth-child(3)").each(function(i) {
		if ($(this).val() === "") {
			valid = false;
		}
		else {
			
			fields += "<input name='ingredients[]' value='" + $(this).val() + "' style='display: none;'>";
		}
	});

	$("#recipeIngredients li select").each(function(i) {
		if ($(this).val() === "") {
			valid = false;
		}
		else {
			
			fields += "<input name='measure[]' value='" + $(this).val() + "' style='display: none;'>";
		}
	});

	$("#recipeIngredients li input:nth-child(1)").each(function(i) {
		if ($(this).val() === "") {
			valid = false;
		}
		else {
			
			fields += "<input name='amount[]' value='" + $(this).val() + "' style='display: none;'>";
		}
	});


	if (!valid) {
		showAlert("Please complete the ingredients list.")
		return;
	}

	$("#recipeInstructions li input").each(function(i) {
		if ($(this).val() === "") {
			valid = false;
		}
		else {
			fields += "<input name='instructions[]' value='" + $(this).val() + "' style='display: none;'>";
		}
	});

	if (valid) {
		$("form").append(fields);
	}
	else {
		showAlert("Please complete the instructions list.")
		return;
	}

	$("form").submit();
});