$("#newIngredient").click(function() {
	const html = $("#ingredientTemplate").html();

	$("#recipeIngredients ul em").remove();
	$("#recipeIngredients ul").append(html);
});

$(document).delegate(".delete", "click", function() {
	const list = $(this).parent().parent();
	if (list.children().length === 1) {
		$(list).append("<em class='initial-text' style='text-align: center;'>empty</em>");
	}
	$(this).parent().remove();
});

$("#submit").click(function() {
    var valid = true,
		fields = "";

	$("#recipeIngredients li input:nth-child(1)").each(function(i) {
		if ($(this).val() === "") {
			valid = false;
		}
		else {
			
			fields += "<input name='ingredients[]' value='" + $(this).val() + "' style='display: none;'>";
		}
	});

    $("#recipeIngredients li input:nth-child(2)").each(function(i) {
		if ($(this).val() === "") {
			valid = false;
		}
		else {
			
			fields += "<input name='excess[]' value='" + $(this).val() + "' style='display: none;'>";
		}
	});

    if (valid) {
		$("form").append(fields);
	}

	
});