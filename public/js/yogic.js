/*
$(function(){
    $('.product-category').click(function(){
        if($(this).prop("checked") == true){
            alert("Checkbox is checked.");
            // console.log($(this).val());
        }
        else if($(this).prop("checked") == false){
            alert("Checkbox is unchecked.");
            // console.log($(this).val());
        }
    });
});
*/

// UI CONTROLLER
var UIController = (function() {
    
    var DOMstrings = {
        inputCheckbox: '.product-category',
        productDiv: '.products',
        categoryDiv: '.category'
    };
    
    return {
        getInput: function() {
            return {
                checkBoxes: document.querySelectorAll(DOMstrings.inputCheckbox)
            };
        },
        displayProducts:function(products, id){
            console.log(products)
            var html;
            html = '';
            html += '<ul>';
            html +='<div class="category" id="category_'+id+'">';
            products.forEach(function(product){
                html +='<li>';
                html += product;
                html +='</li>';
            });
            html +='</div>';
            html += '</ul>';
            document.querySelector(DOMstrings.productDiv).insertAdjacentHTML('beforeend', html);
        },
        clearDOM: function(id){
            var html='';
            document.querySelector('#category_'+id).innerHTML = '';
            console.log("DOM cleared");
        }
    };
    
})();

// GLOBAL APP CONTROLLER
var controller = (function(UICtrl) {
    var setupEventListeners = function() {
        var input, categoryId;
        input = UICtrl.getInput();
        input.checkBoxes.forEach(function(checkBox){
            checkBox.addEventListener( 'change', function() {
                if(this.checked) {
                    categoryId = $(this).val();
                    productByCategory(categoryId);
                } else {
                    categoryId = $(this).val();
                    UICtrl.clearDOM(categoryId);
                }
            });
        });   
    };

    var productByCategory = function(categoryId){
        var id = categoryId;
        $.ajax({
            type: 'POST',
            url: 'categories/filter',
            data: {category_id :id},
            // contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            success: function(products){
                UICtrl.displayProducts(products, id);
            }
        });
    };
    return {
        init: function() {
            console.log('Application has started.');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            setupEventListeners();
        }
    };
    
})(UIController);


controller.init();