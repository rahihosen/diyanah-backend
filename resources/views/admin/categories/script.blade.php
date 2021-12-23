<script>
    $(document).ready(function(){
        $('#category_name').change(function(){
            var category_name = $(this).val();
            if(category_name != '')
            {
                $.ajax({
                    url:'/search',
                    method:"POST",
                    data:{category_name:category_name},
                    success:function(data){
                        console.log(data);
                        $('#category_name_result').html(data);
                    }
                });
            }
        });
    });

</script>



