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