$('#category_create').validate({
    rules : {
        name: {
            required: true,
            maxlength: 64,

        }
    },
    messages : {
        name: {
            required: 'Please write the category nme',
            maxlenght: 'The name cannot be more than 64 characters long'
        }
    }  
});