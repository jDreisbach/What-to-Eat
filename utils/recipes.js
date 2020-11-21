$(document).ready(function addRecipe() {
    $('#add').on('click', function(event) {
        event.preventDefault();
        let ingredient = 'ingredient';
            $('#ingredients').prepend("<div class='col-4'><input placeholder='Amount' type='text' name='amount[]' class='form-control mb-2'/></div><div class='col-4'> <input placeholder='Measure' type='text' name='measure[]' class='form-control mb-2'/></div><div class='col-4'> <input placeholder='Ingredient' type='text' name='ingredient[]' class='form-control mb-2' /></div> <br/><br/>" );      
    });
});