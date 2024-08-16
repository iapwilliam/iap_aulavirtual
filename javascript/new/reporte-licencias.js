$("#licenciatura").change(function(){
    if ($(this).val() != "") {
        $.ajax({
            type: "POST",
            url: $(this).data('url'),
            data: { posgrado: $(this).val(), option: 'grupos' }
        }).done(function (response) {
            console.log(response); 
            response = JSON.parse(response); 
            $("#grupo").html("<option value='0'>--TODOS--</option>");
            $.each(response, function(index, value){
                $("#grupo").append("<option value='"+value.courseId+"'>"+value.group+"</option>");
            })
        });
    }else{
        $("#grupo").html("<option value='0'>--TODOS--</option>");
    } 
});