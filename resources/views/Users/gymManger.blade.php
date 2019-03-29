@extends('layouts.base')


@section('extra_css')

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

@endsection

@section('content')

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Table With Full Features</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Show</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>Ban </th>
                            
                        </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->



    <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you to delete this item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <div>
                        <div id="csrf_value"  hidden >@csrf</div>
                        {{--@method('DELETE')--}}
                        <button type="button" row_delete="" id="delete_item"  class="btn btn-primary" data-dismiss="modal">Yes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@role('cityManager')
<!-- City manager will have this permission also  -->
<a href="{{route('users.create')}}" class="btn btn-success">Add User</a>
@endrole




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
                url: '/gymMangers_table',
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
