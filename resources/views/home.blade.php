@extends('layouts.base')


@section('extra_css')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

@endsection

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="text-center callout callout-info">

                <h2>Welcome to GMS</h2>
            </div>
        </div>
    </div>
</section>
@endsection


@section('extra_scripts')

    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

<script>

        $('#example').DataTable( {
            serverSide: true,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/data_source',
                dataType : 'json',
                type: 'post',
                // processData: false,
                // contentType: false,

                // success:function(response) {
                //
                //     console.log(response.data);
                // },
                // error: function (response) {
                //     alert(' Cant Save This Documents !');
                //     console.log(response);
                // }
            },

            columns: [
                // response.data,
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                
               
               
                   
                /* Show */ {
                    mRender: function (data, type, row) {
                        
                        return '<a class="btn btn-info" href="/users/'+row.id+'/show" class="table-delete" data-id="' + row.id + '">Show</a>'
                    }
                },
               
                /* EDIT */ {
                    mRender: function (data, type, row) {
                        return '<a class="btn btn-warning" href="/users/'+row.id+'/edit " class="table-edit" data-id="' + row.id + '">EDIT</a>'
                    }
                },

                /* DELETE */ {
                    mRender: function (data, type, row) {
                        return '<a class="btn btn-danger" href="/users/'+row.id+'/delete" class="table-delete" row_id="' + row.id + '" data-toggle="modal" data-target="#DeleteModal" id="delete_toggle">DELETE</a>'
                    }

                    
                },
                
                /*Banned*/
                {
                    mRender: function (data, type, row) {
                        if(row.banned_at==null)
                        return '<a  class="label label-danger" href="/users/'+row.id+'/ban"  row_id="' + row.id + '">Ban</a>'
                        else
                        return '<a class="label label-warning" href="/users/'+row.id+'/unban" row_id="' + row.id + '" >Unban</a>'
                        
                    }
                },
               
            ],
            'paging'      : true,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
        } );



    // delete item script

        $(document).on('click','#delete_toggle',function () {
            var delete_id = $(this).attr('row_id');
            $('#delete_item').attr('row_delete',delete_id);

        });

        $(document).on('click','#delete_item',function () {
            var user_id = $(this).attr('row_delete');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/users/'+user_id,
                type: 'Delete',
                success: function (data) {
                    console.log('success');
                    console.log(data);
                    var table = $('#example').DataTable();
                    table.ajax.reload();
                },
                error: function (response) {
                    alert(' error');
                    console.log(response);
                }
            });
        });

    </script>}


    <script>
            //Initialize Select2 Elements
            $('.select2').select2();
    </script>
@endsection
