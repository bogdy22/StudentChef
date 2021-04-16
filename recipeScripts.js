$('#recipeRating').change(function() {
    $('#recipeRatingLabel').html($('#recipeRating').val());
});

$('#recipeDifficulty').change(function() {
    $('#recipeDifficultyLabel').html($('#recipeDifficulty').val());
});

$('#recipeDuration').change(function() {
    $('#recipeDurationLabel').html($('#recipeDuration').val());
});

$('#feedback-submit').click(function() {
    $('#write-feedback-form').submit();
});

/*
$('#find-ingredients').click(function() {
	window.location.href = "location.php";
});
*/

function findIngredients(url) {
	window.location.href = "location.php?"+url;
}

