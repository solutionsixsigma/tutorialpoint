@extends('layouts.userpanel.app')

@section('content')

    <!---------------------------------- Content ----------------------------------------->

 <!--state overview start-->
              <div class="row">
                <div class="col-sm-12">
              <section class="card">
              <header class="card-header">
                 <h5> List Of Classes </h5>
             <span class="tools pull-right">
                <a href="/userpanel/importclass" class="btn btn-sm btn-shadow btn-warning text-white">
                    Upload Bulk
                </a>
               <a href="#myModal" data-toggle="modal" class="btn btn-sm btn-shadow btn-success text-white">
                                 Add Classes
                              </a>
              <a href="#" data-toggle="modal" id="deleteAllSelectedRecord" class="btn btn-sm btn-shadow btn-danger text-white">
                                Delete Selected Record
                             </a>
             </span>


              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  <th><input type="checkbox" id="chkCheckAll"></th>
                  <th>Sl No</th>
                  <th>Classes Name</th>
                  <th class="hidden-phone">Action</th>
              </tr>
              </thead>
              <tbody>

        @foreach ($classes as $class)
              <tr class="gradeX" id="sid{{$class->id}}">
                  <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{$class->id}}"></td>
                  <td>{{ $no++ }}</td>
                  <td>{{ $class->class_name }}</td>
                  <td>
                       <button class="btn btn-success btn-sm" onclick="viewclass({{$class->id}})"><i class="fa fa-check"></i></button>
                       <button class="btn btn-primary btn-sm" onclick="editclass({{$class->id}})"><i class="fa fa-pencil"></i></button>
                       <button class="btn btn-danger btn-sm" onclick="deleteclass({{$class->id}})" ><i class="fa fa-trash-o "></i></button>
                    </td>
              </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                  <th colspan="3">&nbsp;</th>
              </tr>
              </tfoot>
              </table>
              </div>
              </div>
              </section>
              </div>
              </div>


<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title">Add class</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" method="POST" action="">
                                                @csrf
                                                <input type="hidden" class="form-control" id="id" name="id">
                                                  <div class="form-group">
                                                      <label for="exampleInputEmail1">class Name <span id="classname"></span></label>
                                                      <input type="text" class="form-control" id="class_name" required name="class_name" placeholder="Enter class / Book Name">
                                                  </div>
                                                  <button type="button" class="btn btn-primary btn-submit">Submit</button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </div>



<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="excelModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Upload Bulk class</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        <form role="form" method="POST" name="frmExl" id="frmExl" action="/storeCsv" enctype="multipart/form-data">
                                          @csrf
                                          <div class="form-group">
                                                <label for="exampleInputEmail1">Download Template File <i class="fa fa-file-excel-o" ></i></label>

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Upload CSV File</label>
                                                <input type="file" class="form-control" id="file" name="file">
                                            </div>
                                            <button type="submit" name="subexl" id="subexl" class="btn btn-primary btn-submit">Upload CSV</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

    <!----------------------------------- End Content ------------------------------------>

    <script>

        $(document).ready(function() {
            $(".btn-submit").click(function(e){
                e.preventDefault();

                var _token = $("input[name='_token']").val();
                var id = $("input[name='id']").val();
                var class_name = $("input[name='class_name']").val();

                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                })

                if(id=="") {

                    $.ajax({
                    url: "{{ route('subClasses') }}",
                    type:'POST',
                    data: {_token:_token, class_name:class_name },
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            alert(data.success);
                            $('#myModal').modal('hide');
                            location.reload();
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                    });

                } else {
                    alert(id);

                    $.ajax({
                    url: "{{ route('classes.update') }}",
                    type:'POST',
                    data: {
                        _token:_token,
                        class_name:class_name,
                        id:id
                        },
                    success: function(data) {
                        if($.isEmptyObject(data.error)){
                            alert(data.success);
                            $('#myModal').modal('hide');
                            location.reload();
                        }else{
                            printErrorMsg(data.error);
                        }
                    }
                    });
                }

            });

           function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
            }

            $('#myModal').on('hidden.bs.modal.close', function () {
                location.reload();
            });
        });

    function editclass(id) {
        $(".modal-title").html("Edit class");
        $('#myModal').modal('toggle');
        $.ajax({
                url: "/edit/"+id,
                type:'GET',
                success: function(response) {
                    if(response.status == 404) {
                        $('#suceesmessage').html("");
                    } else {
                        $("#id").val(response.classes.id);
                        $('#class_name').val(response.classes.class_name);
                    }
                }
            });
    }

    function viewclass(id) {
        $(".modal-title").html("View class");
        $('#myModal').modal('toggle');
        $.ajax({
                url: "/view/"+id,
                type:'GET',
                success: function(response) {
                    if(response.status == 404) {
                        $('#suceesmessage').html("");
                    } else {
                        $('#class_name').hide();
                        $('.btn-submit').hide();
                        $('#classname').html('<strong> :' + response.class.class_name + '</strong>');
                    }
                }
            });
    }

    function deleteclass(id)
    {
        if(confirm("Do you really want to delete this record?"))
        {
            $.ajax({
                type: "DELETE",
                url: "/delete/"+id,
                data: {
                    _token: $("input[name=_token]").val()
                },
                success:function(response){
                    $("#sid"+id).remove();
                }
            });
        }
    }

    $(function(e) {
        $("#chkCheckAll").click(function() {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        })

        $("#deleteAllSelectedRecord").click(function(e) {
            e.preventDefault();
            var allids = [];

            $("input:checkbox[name=ids]:checked").each(function(){
                allids.push($(this).val());
            })

            if(confirm("Do you really want to delete all record?"))
            {

            $.ajax({
                type: "DELETE",
                url: "{{ route('classes.deleteclass') }}",
                data: {
                    _token: $("input[name=_token]").val(),
                    ids:allids
                },
                success:function(response){
                    $.each(allids,function(key,val) {
                     $("#sid"+val).remove();
                    });
                }
            });
            } // end confirmation
        });
    });
    </script>
@endsection
