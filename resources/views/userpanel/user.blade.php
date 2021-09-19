@extends('layouts.userpanel.app')

@section('content')
    <!---------------------------------- Content ----------------------------------------->

 <!--state overview start-->
              <div class="row">
                <div class="col-sm-12">
              <section class="card">
              <header class="card-header">
                  Dynamic Table
             <span class="tools pull-right">
               <a href="#myModal" role="button" data-toggle="modal" class="btn btn-shadow btn-warning text-white">Add New</a>
             </span>


              </header>
              <div class="card-body">
              <div class="adv-table">
              <table  class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
              <tr>
                  <th>Sl No</th>
                  <th>Nick Name</th>
                  <th>Full Name</th>
                  <th>Type</th>
                  <th class="hidden-phone">Action</th>
              </tr>
              </thead>
              <tbody>

              <tr class="gradeX">
                  <td>1</td>
                  <td>Board 1</td>
                  <td>Board 1</td>
                  <td>Board 1</td>
                  <td>
                       <button class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
                       <button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button>
                       <button class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button>
                    </td>
              </tr>

              </tbody>
              <tfoot>
              <tr>
                  <th>Rendering engine</th>
                  <th>Browser</th>
                  <th>Platform(s)</th>
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
                                              <h5 class="modal-title">Add User</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>
                                          <div class="modal-body">

                                              <form role="form" action="/registerUser" method="POST">
                                                  <div class="form-group">
                                                      <label for="exampleInputEmail1">First Name</label>
                                                      <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Enter Your Firstname">
                                                  </div>
                                                  <div class="form-group">
                                                      <label for="exampleInputPassword1">Last Name</label>
                                                      <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Your Lastname">
                                                  </div>
                                                  <div class="form-group">
                                                    <label for="exampleInputPassword1">Phone</label>
                                                    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Your Mobile">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Confirm Password</label>
                                                    <input type="password" class="form-control" id="exampleInputPassword3" placeholder="Enter Confirm Password">
                                                </div>
                                                  <button type="submit" name="regSubmit" id="regSubmit" class="btn btn-danger">Submit</button>
                                              </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </div>

    <!----------------------------------- End Content ------------------------------------>
@endsection
