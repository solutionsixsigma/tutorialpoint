@extends('layouts.userpanel.app')

@section('content')

{{ session()->put('page', 'Topics') }}
    <!---------------------------------- Content ----------------------------------------->

 <!--state overview start-->
 <div class="row">
    <div class="col-sm-12">
  <section class="card">
    <header class="card-header">
        <h5> List Of Topics </h5>
    <span class="tools pull-right">
       <a href="/userpanel/importclass" class="btn btn-sm btn-shadow btn-warning text-white">
           Upload Bulk
       </a>
      <a href="#myModal" data-toggle="modal" class="btn btn-sm btn-shadow btn-success text-white">
                        Add Topics
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
      <th>Sl No</th>
      <th>Topics</th>
      <th>Subject</th>
      <th class="hidden-phone">Action</th>
  </tr>
  </thead>
  <tbody>

    @foreach ($topics as $topic)
    <tr class="gradeX" id="sid{{$topic->id}}">
        <td><input type="checkbox" name="ids" class="checkBoxClass" value="{{$topic->id}}"></td>
        <td>{{ $no++ }}</td>
        <td>{{ $topic->board_name }}</td>
        <td>{{ $topic->board_type }}</td>
        <td>
             <button class="btn btn-success btn-sm" onclick="viewBoard({{$topic->id}})"><i class="fa fa-check"></i></button>
             <button class="btn btn-primary btn-sm" onclick="editBoard({{$topic->id}})"><i class="fa fa-pencil"></i></button>
             <button class="btn btn-danger btn-sm" onclick="deleteBoard({{$topic->id}})" ><i class="fa fa-trash-o "></i></button>
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
                                  <h5 class="modal-title">Add Topics</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">

                                  <form role="form">
                                      <div class="form-group">
                                          <label for="exampleInputEmail1">Name</label>
                                          <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Enter email">
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputPassword1">Type</label>
                                          <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Password">
                                      </div>
                                      <div class="form-group">
                                          <label for="exampleInputPassword1">Nick Name</label>
                                          <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Password">
                                      </div>
                                      <div class="checkbox">
                                          <label>
                                              <input type="checkbox"> Check me out
                                          </label>
                                      </div>
                                      <button type="submit" class="btn btn-default">Submit</button>
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
            var board_name = $("input[name='board_name']").val();
            var board_type = $("#board_type").val();
            var board_nick = $("input[name='board_nick']").val();

            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            })

            if(id=="") {

                $.ajax({
                url: "{{ route('subBoard') }}",
                type:'POST',
                data: {_token:_token, board_name:board_name, board_type:board_type, board_nick:board_nick},
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
                url: "{{ route('board.update') }}",
                type:'POST',
                data: {
                    _token:_token,
                    board_name:board_name,
                    board_type:board_type,
                    board_nick:board_nick,
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

function editBoard(id) {
    $(".modal-title").html("Edit Board");
    $('#myModal').modal('toggle');
    $.ajax({
            url: "/edit/"+id,
            type:'GET',
            success: function(response) {
                if(response.status == 404) {
                    $('#suceesmessage').html("");
                } else {
                    $("#id").val(response.board.id);
                    $('#board_name').val(response.board.board_name);
                    $('#board_type').val(response.board.board_type);
                    $('#board_nick').val(response.board.board_nick);
                }
            }
        });
}

function viewBoard(id) {
    $(".modal-title").html("View Board");
    $('#myModal').modal('toggle');
    $.ajax({
            url: "/view/"+id,
            type:'GET',
            success: function(response) {
                if(response.status == 404) {
                    $('#suceesmessage').html("");
                } else {
                    $('#board_name').hide();
                    $('#board_type').hide();
                    $('#board_nick').hide();
                    $('.btn-submit').hide();
                    $('#boardname').html('<strong> :' + response.board.board_name + '</strong>');
                    $('#boardtype').html('<strong> :' + response.board.board_type + '</strong>');
                    $('#boardnick').html('<strong> :' + response.board.board_nick + '</strong>');
                }
            }
        });
}

function deleteBoard(id)
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
            url: "{{ route('board.deleteSelected') }}",
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

