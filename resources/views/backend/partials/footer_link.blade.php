<script src="{{ asset('backend/scripts/siqtheme.js') }}"></script>
 <script src="{{ asset('backend/scripts/pages/jquery.min.js') }}"></script>
 <script src="{{ asset('backend/scripts/pages/dashboard1.js') }}"></script>
{{-- <script src="{{ asset('backend/scripts/pages/sweetalert.js') }}"></script>--}}

<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>


 <script src="{{ asset('backend/scripts/pages/tagsinput.js') }}"></script>

 <script src="{{ asset('backend/scripts/pages/bootstrap-tagsinput-angular.min.js') }}"></script>
  <script src="{{asset('backend/scripts/pages/tb_datatables.js')}}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<script src="{{ asset('backend/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<script>

    //  delete confirm message
    function deleteButton(url,id){
        console.log(id);
            swal({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                buttons: ["Cancel", "Yes!"],
            }).then(function(value) {
                // console.log(value);
                if(value){
                    $.ajax({
                        headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                        url: "{{url('/')}}/"+url+'/'+id,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {},
                        success:function(response) {
                            if(response.success){
                                $('#tr-'+id).fadeOut();
                                toastr.success("Deleted Successfully");
                            }else{
                                // toastr.success("Category Deleted Successfully");
                            }
                        }
                    });
                }
                
            });
    }



    @if(Session::has('messege'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('messege') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('messege') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('messege') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('messege') }}");
            break;
    }
    @endif
</script>

<script>
    CKEDITOR.replace( 'editor' );
</script>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image')
                    .attr('src', e.target.result)
                    .width(120)
                    .height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
