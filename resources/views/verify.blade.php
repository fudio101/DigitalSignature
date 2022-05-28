<?php
/**
 * @author Fudio101
 * Date: 18/04/2022
 * Time: 10:23
 */
?>
<?php
/**
 * @author Fudio101
 * Date: 18/04/2022
 * Time: 10:23
 */
?>

@extends('main')
@section('verify')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">VERIFY</h1>
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content h-100">
            <div class="card card-primary card-outline shadow-lg p-3 mb-5 bg-body rounded">
                <div class="card-header">
                    <h4>Please Enter Text</h4>
                </div>
                <!-- /.card-header -->
                <form action="">
                    <div class="card-body">
                        <div class="form-group h-25">
                            <textarea id="compose-textarea" class="form-control"></textarea>
                        </div>
                        <div class="form-group m-0">
                            <label>Signature</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control"
                                       aria-describedby="button-addon2">
                            </div>
                        </div>
                        <div class="form-group m-0">
                            <label>Public key</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control"
                                       aria-describedby="button-addon2">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer border">
                        <button name="sign-btn" type="button" class="btn btn-block btn-secondary btn-lg width-full"><i
                                class="fas fa-lock"></i>
                            SIGN
                        </button>
                    </div>
                </form>
                <!-- /.card-footer -->
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    @include('layouts._js')
@endsection

