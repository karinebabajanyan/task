$("#update_data").click(function(){
    var id=$(this).val();
    let token = $('meta[name="csrf-token"]').attr('content')
        $.ajax({
            url: '/posts/'+id,
            type: "PATCH",
            cache: false,
            data:{
                _token:token,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            },
            success: function(dataResult){
                location.reload()
            }
        });
});
