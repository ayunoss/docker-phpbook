$(document).ready(function(){
    $("#form").on('submit', function(event){
        event.preventDefault();
        let formData = new FormData();
        let form = $(this);
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            processData: false,
            contentType: false,
            cache:false,
            dataType : 'text',
            data: formData,
            success: function(data){
                data = JSON.parse(data);
                if (data.status === 'error') {
                    $.each(data.errors, function(key, value) {
                        var errorMessage = '<p class="error" style="color: red">' + value + '</p>';
                        if (key == "invalid_file") {
                            $(errorMessage).insertAfter(".error");
                        }
                        setTimeout(function() { $('.error')[0].remove();}, 4000);
                    });
                }
            }
        });
    });
});